jQuery(document).ready(function($) {
	$('.js_jojotique_insert_media').click(function(e){
		e.preventDefault();
		var $this = $(this);
		var multiple = $this.data('multiple');
		var uploader = wp.media({
			title: 'Choisissez un fichier',
			button: {
				text: 'Sélectionner un fichier'
			},
			multiple: multiple
		});

		uploader.on('select', function() {
			var selection = uploader.state().get('selection');
			var urls = selection.map(function(item) {
				return item.toJSON().url;
			});
			$('#' + $this.data('id')).val(urls.join(','))
		});

		uploader.open();
	});
})
