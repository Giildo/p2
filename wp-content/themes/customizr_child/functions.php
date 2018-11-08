<?php
require_once(ABSPATH . 'wp-content/themes/customizr_child/fct/metabox/Jojotique_Metabox.php');


/* Hériter du thème parent */
function wpm_enqueue_styles(){
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'wpm_enqueue_styles');

/* Autoriser les fichiers SVG */
require_once(ABSPATH . 'wp-content/themes/customizr_child/fct/img/img.php');

/* Mise en place de Custom Post Type */
require_once(ABSPATH . 'wp-content/themes/customizr_child/fct/custom_postType/chalets/register_chalets.php');

/* Fonctionnement du diaporama */
add_action('wp_enqueue_scripts', function(){
   wp_enqueue_script('jjt_diaporamaJS', get_template_directory_uri() . '/../customizr_child/fct/js/js_jojotique_diaporama.js', array(), '1.0.0');
});

/* Faire en sorte que la barre d'admin ne s'affiche pas pour éviter de bouger les images */
add_filter( 'show_admin_bar', '__return_false' );

/* Mise en place de Advanced Custom Fields */
$info_chalet = new Jojotique_Metabox(array(
	'id' => 'info_chalet',
	'titre' => 'Informations sur le chalet',
	'postTypeAssocie' => 'chalets'
));

Jojotique_Metabox::JSInsertMedia();

$info_chalet->ajoutChamp(array(
	'id' => 'jojotique_surface',
	'label' => 'Surface',
	'valeurExemple' => '3m²',
   'valeurParDefaut' => '',
   'elementAssocie' => 'm²',
   'tailleMax' => false
))->ajoutChamp(array(
   'id' => 'jojotique_nbChambre',
   'label' => 'Nombre de chambre',
   'valeurExemple' => '6',
   'valeurParDefaut' => '',
   'elementAssocie' => 'chambre(s)',
   'tailleMax' => false
))->ajoutChamp(array(
   'id' => 'jojotique_nbPersonne',
   'label' => 'Capacité maximale',
   'valeurExemple' => '100',
   'valeurParDefaut' => '',
   'elementAssocie' => 'personne(s)',
   'tailleMax' => false
))->ajoutChamp(array(
   'id' => 'jojotique_prix',
   'label' => 'Prix',
   'valeurExemple' => '1500',
   'valeurParDefaut' => '',
   'elementAssocie' => '€',
   'tailleMax' => false
))->ajoutChamp(array(
   'id' => 'jojotique_photos',
   'label' => 'Photos',
   'type' => 'uploader',
   'valeurExemple' => '',
   'valeurParDefaut' => '',
   'elementAssocie' => '',
   'tailleMax' => true
));
