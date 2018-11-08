<?php
add_action('init', 'register_chalet');

function register_chalet() {
	$labels = array(
		'name'               => 'Chalets',
		'singular_name'      => 'Chalet',
		'menu_name'          => 'Chalets',
		'name_admin_bar'     => 'Chalet',
		'add_new'            => 'Ajouter un chalet',
		'add_new_item'       => 'Ajouter un nouveau chalet',
		'new_item'           => 'Nouveau chalet',
		'edit_item'          => 'Modifier un chalet',
		'view_item'          => 'Voir un chalet',
		'all_items'          => 'Tous les chalets',
		'search_items'       => 'Chercher un chalet',
		'parent_item_colon'  => 'Item suivant',
		'not_found'          => 'Chalet non trouvé',
		'not_found_in_trash' => 'Chalet non trouvé dans la corbeille'
	);

	$args = array(
		'labels'             => $labels,
		'description'        => 'Description',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'chalets'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail')
	);

	register_post_type('chalets', $args);

	$labels = array(
		'name'                       => 'Types d\'échange',
		'singular_name'              => 'Type d\'échange',
		'search_items'               => 'Recherche un type d\'échange',
		'popular_items'              => 'Type d\'échange prévalent',
		'all_items'                  => 'Tous les types d\'échange',
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => 'Modifier les types d\'échange',
		'update_item'                => 'Mettre à jour les types d\'échange',
		'add_new_item'               => 'Ajouter un type d\'échange',
		'new_item_name'              => 'Ajouter un nom de type d\'échange',
		'separate_items_with_commas' => 'Séparer avec les types d\'échange avec une virgule',
		'add_or_remove_items'        => 'Ajouter ou supprimer un type d\'échange',
		'not_found'                  => 'Aucun type d\'échange trouvé',
		'menu_name'                  => 'Types d\'échange',
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'type' ),
	);

	$postType = array(
		'chalets'
	);

	register_taxonomy('type', $postType, $args);

	/*if (
		(isset($_REQUEST['post_id']) && get_post_type($_REQUEST['post_id']) == 'chalets') ||
		(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')
	) {*/
		set_post_thumbnail_size(500, 500, true);
	//}
}
