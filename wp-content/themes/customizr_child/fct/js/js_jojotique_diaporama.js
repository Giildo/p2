jQuery(document).ready(function($) {
	$('.post_diaporama img').click(function(e){
		e.preventDefault();
		var $this = $(this);
		var adresse = $this.data('adresse');
		$('#img_principale').attr('src', adresse);
	});
})
