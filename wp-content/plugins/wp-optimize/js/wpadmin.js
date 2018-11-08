/**
 * Send an action via admin-ajax.php
 * 
 * @param {string} action - the action to send
 * @param * data - data to send
 * @param Callback [callback] - will be called with the results
 * @param {boolean} [json_parse=true] - JSON parse the results
 */
var wp_optimize_send_command_admin_ajax = function(action, data, callback, json_parse) {
	
	json_parse = ('undefined' === typeof json_parse) ? true : json_parse;
	
	var ajax_data = {
		action: 'wp_optimize_ajax',
		subaction: action,
		nonce: wp_optimize_ajax_nonce,
		data: data
	};
	
	jQuery.post(ajaxurl, ajax_data, function(response) {
		
		if (json_parse) {
			try {
				var resp = JSON.parse(response);
			} catch (e) {
				console.log(e);
				console.log(response);
				alert(wpoptimize.error_unexpected_response);
				return;
			}
			if ('undefined' !== typeof callback) callback(resp);
		} else {
			if ('undefined' !== typeof callback) callback(response);
		}
		
	});
	
}

jQuery(document).ready(function($) {
	WP_Optimize = WP_Optimize(wp_optimize_send_command_admin_ajax);
});

/**
 * Function for sending communications
 * 
 * @callable sendcommandCallable
 * @param {string} action - the action to send
 * @param * data - data to send
 * @param Callback [callback] - will be called with the results
 * @param {boolean} [json_parse=true] - JSON parse the results
 */

/**
 * Main WP_Optimize
 * 
 * @param {sendcommandCallable} send_command - function for sending remote communications via
 */
var WP_Optimize = function(send_command) {
	
	var $ = jQuery;
	var debug_level = 0;
	var queue = new Updraft_Queue();
	
	/**
	 * Either display normally, or grey-out, the scheduling options, depending on whether any schedule has been selected
	 */
	function enable_or_disable_schedule_options() {
		var schedule_enabled = $('#enable-schedule').is(':checked');
		if (schedule_enabled) {
			$('#wp-optimize-auto-options').css('opacity', '1');
			//.find('input').prop('disabled', false);
		} else {
			$('#wp-optimize-auto-options').css('opacity', '0.5')
			//.find('input').prop('disabled', true);
		}
	}
	
	enable_or_disable_schedule_options();
	
	$('#enable-schedule').change(function() { enable_or_disable_schedule_options(); });
	
	/**
	 * Temporarily show a dashboard notice, and then remove it. The HTML will be prepended to the .wrap.wp-optimize-wrap element.
	 * 
	 * @param {string} html_contents - HTML to display
	 * @param {string} where - CSS selector of where to prepend the HTML to 
	 * @param {number} [delay=15] - the number of seconds to wait before removing the message
	 */
	function temporarily_display_notice(html_contents, where, delay) {
		where = ('undefined' === typeof where) ? '#wp-optimize-wrap' : where;
		delay = ('undefined' === typeof delay) ? 15 : delay;
		$(html_contents).hide().prependTo(where).slideDown('slow').delay(delay*1000).slideUp('slow', function() {
			$(this).remove();
		});;
	}
	
	/**
	 * Send a request to disable or enable comments or trackbacks
	 * 
	 * @param (string) type - either "comments" or "trackbacks"
	 * @param (boolean) enable - whether to enable, or, to disable
	 */
	function enable_or_disable_feature(type, enable) {
		
		var data = {
			type: type,
			enable: enable ? 1 : 0
		};

		$('#'+type+'_spinner').show();
		
		send_command('enable_or_disable_feature', data, function(resp) {
			
			$('#'+type+'_spinner').hide();
			
			if (resp && resp.hasOwnProperty('output')) {
				for (var i = 0, len = resp.output.length; i < len; i++) {
					var new_html = '<div class="updated">'+resp.output[i]+'</div>';
					temporarily_display_notice(new_html, '#actions-results-area');
				}
			}
			
		});
	}
	
	$('#wp-optimize-disable-enable-trackbacks-enable').click(function() {
		enable_or_disable_feature('trackbacks', true);
	});
	
	$('#wp-optimize-disable-enable-trackbacks-disable').click(function() {
		enable_or_disable_feature('trackbacks', false);
	});
	
	$('#wp-optimize-disable-enable-comments-enable').click(function() {
		enable_or_disable_feature('comments', true);
	});
	
	$('#wp-optimize-disable-enable-comments-disable').click(function() {
		enable_or_disable_feature('comments', false);
	});
	
	$('#wp-optimize-nav-tab-wrapper .nav-tab').click(function(e) {
		
		var clicked_tab_id = $(this).attr('id');
		if (!clicked_tab_id) { return; }
		if ('wp-optimize-nav-tab-' != clicked_tab_id.substring(0, 20)) { return; }
		
		var clicked_tab_id = clicked_tab_id.substring(20);
		
		e.preventDefault();
		
		$('#wp-optimize-nav-tab-wrapper .nav-tab:not(#wp-optimize-nav-tab-'+clicked_tab_id+')').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active');
		
		$('#wp-optimize-wrap .wp-optimize-nav-tab-contents:not(#wp-optimize-nav-tab-contents-'+clicked_tab_id+')').hide();
		$('#wp-optimize-nav-tab-contents-'+clicked_tab_id).show();
		
	});
	
	/**
	 * Gathers the settings from the settings tab
	 * 
	 * @returns (string) - serialized settings
	 */
	function gather_settings() {
		// Excluding the unnecessary 'action' input avoids triggering a very mis-conceived mod_security rule seen on one user's site
		var form_data = $("#wp-optimize-nav-tab-contents-settings form input[name!='action'], #wp-optimize-nav-tab-contents-settings form textarea, #wp-optimize-nav-tab-contents-settings form select").serialize();
		
		//include unchecked checkboxes. user filter to only include unchecked boxes.
		$.each($('#wp-optimize-nav-tab-contents-settings form input[type=checkbox]')
		.filter(function(idx){
			return $(this).prop('checked') == false
		}),
		 function(idx, el){
			 //attach matched element names to the form_data with chosen value.
			 var empty_val = '0';
			 form_data += '&' + $(el).attr('name') + '=' + empty_val;
		 }
		);
		
		return form_data;
	}
	
	/**
	 * Proceses the queue
	 */
	function process_queue() {
		
		if (!queue.get_lock()) {
			if (debug_level > 0) {
				console.log("WP-Optimize: process_queue(): queue is currently locked - exiting");
			}
			return;
		}
		
		if (debug_level > 0) {
			console.log("WP-Optimize: process_queue(): got queue lock");
		}
		
		var id = queue.peek();

		//check to see if an object has been returned
		if (typeof id == 'object') {
			data = id;
			id = id.optimization_id;
		} else {
			data = {};
		}
		
		if ('undefined' === typeof id) {
			if (debug_level > 0) console.log("WP-Optimize: process_queue(): queue is apparently empty - exiting");
			queue.unlock();
			return;
		}
		
		if (debug_level > 0) console.log("WP-Optimize: process_queue(): processing item: "+id);
			   
		queue.dequeue();
		
		send_command('do_optimization', { optimization_id: id, data: data }, function(response) {

			$('#optimization_spinner_'+id).hide();
			$('#optimization_checkbox_'+id).show();
			$('.optimization_button_'+id).prop('disabled', false);

			if (response) {
				var total_output = '';
				for (var i = 0, len = response.errors.length; i < len; i++) {
					total_output += '<span class="error">'+response.errors[i]+'</span><br>';
				}
				for (var i = 0, len = response.messages.length; i < len; i++) {
					total_output += response.errors[i]+'<br>';
				}
				for (var i = 0, len = response.result.output.length; i < len; i++) {
					total_output += response.result.output[i]+'<br>';
				}
				$('#optimization_info_'+id).html(total_output);
				if (response.hasOwnProperty('status_box_contents')) {
					$('#wp_optimize_status_box').css('opacity', '1').find('.inside').html(response.status_box_contents);
				}
				if (response.hasOwnProperty('table_list')) {
					$('#wpoptimize_table_list tbody').replaceWith(response.table_list);
				}
				if (response.hasOwnProperty('total_size')) {
					$('#optimize_current_db_size').html(response.total_size);
				}

				//Status check if optimizing tables
				if (id == 'optimizetables' && data.optimization_table) {
					if(queue.is_empty()){
						$('#optimization_spinner_'+id).hide();
						$('#optimization_checkbox_'+id).show();
						$('.optimization_button_'+id).prop('disabled', false);
						$('#optimization_info_'+id).html(wpoptimize.optimization_complete);
					} else {
						$('#optimization_checkbox_'+id).hide();
						$('#optimization_spinner_'+id).show();
						$('.optimization_button_'+id).prop('disabled', true);
					}
				}
			}
			setTimeout(function() { queue.unlock(); process_queue(); }, 10);
		});
	}
	
	/**
	 * Runs a specified optimization, displaying the progress and results in the optimization's row
	 * 
	 * @param {string} id - The optimization ID
	 */
	function do_optimization(id) {
		var $optimization_row = $('#wp-optimize-nav-tab-contents-optimize .wp-optimize-settings-'+id);
		if (!$optimization_row) {
			console.log("do_optimization: row corresponding to this optimization ("+id+") not found");
		}
		$('#optimization_checkbox_'+id).hide();
		$('#optimization_spinner_'+id).show();
		$('.optimization_button_'+id).prop('disabled', true);

		$('#optimization_info_'+id).html('...');
		
		//check if it is DB optimize
		if ('optimizetables' == id) {
			var optimization_tables = $('#wpoptimize_table_list #the-list tr');

			//check if there are any tables to be optimized
			$(optimization_tables).each(function(index) {
				//get information from each td
				var $table_information = $(this).find('td');

				//get table type information
				table_type = $table_information.eq(5).text();
				table = $table_information.eq(1).text();
				optimizable = $table_information.eq(5).data('optimizable');

				//make sure the table isnt blank
				if ('' != table){
					//check if table is InnboDB as we do not want to optimize it
					if ('1' == optimizable){
						var data = {
							optimization_id: id,
							optimization_table: $table_information.eq(1).text(),
							optimization_table_type: table_type,
						};
						queue.enqueue(data);
					}
				}
			});
		} else {
			//for all other options
			queue.enqueue(id);
		}
		process_queue();
	}
	
	$('#wp-optimize-nav-tab-contents-optimize').on('click', 'b