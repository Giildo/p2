<?php
add_action('admin_init', 'jojotique_init_meta'); //Initialise que si on est dans un menu administrateur
add_action('save_post', 'jojotique_save_meta'); //Initialise la fonction de sauvegarde quand on sauvegarde l'article

function jojotique_init_meta() {
	if (function_exists('add_meta_box')) {
		add_meta_box('elementsImmo', 'Éléments immobilers', 'jojotique_custom_fields', 'chalets'); //Ajout de la fenêtre dans chalets avec ID = "elementsImmo"
	}
}

function jojotique_custom_fields() {
	global $post;
	$value = get_post_meta($post->ID, 'jojotique_couchage', true);
?>

<div class="meta-box-item-title">
	Nombre de couchage :
</div>
<div class="meta-box-item-content">
	<input type="text" name="jojotique_couchage" id="jojotique_couchage" placeholder="Nombre de couchage" value="<?= $value ?>" style="width: 100%;" />
</div>

<?php
}

function jojotique_save_meta($post_id) {
	$value = $_POST['jojotique_couchage'];
	$meta = 'jojotique_couchage';

	if (get_post_meta($post_id, $meta)) {
		update_post_meta($post_id, $meta, $value);
	} else if ($value === '') {
		delete_post_meta($post_id, $meta);
	} else {
		add_post_meta($post_id, $meta, $value);
	}
}