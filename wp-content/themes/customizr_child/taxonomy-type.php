<?php
/**
 * Fichier où se trouve la page d'accueil
 *
 * @package Customizr
 * @since Giildo
 */

//Génération du type de Taxonomy pour récupérer dans les différents éléments
$taxonomy = strip_tags(get_the_term_list($post->ID, 'type'));

//Récupération de tous les chalets
$taxo = new WP_query(array(
   'post_type' => 'chalets',
   'tax_query' => array(
      array(
         'taxonomy' => 'type',
         'field' => 'slug',
         'terms' => strtolower($taxonomy)
   )),
   'posts_per_page' => -1
));

//Tableau qui regroupe les ACF qu'on souhaite afficher
$acf = array('surface', 'chambre', 'capacite');

//Compteur pour savoir si on est colonne 1 ou 2
$colonne = 1;

//Paramètre pour savoir la taille de la photo qu'on affiche
$tailleImage = array(500, 500);

//Récupération de la description tronquée
function troncage(string $description) {
   if(strlen($description) > 100) {
      return $description_courte = substr($description, 0, 81) . '... <span class="italique">+ Lire la suite</span>';
   } else {
      return $description;
   }
}

get_header();
?>
<div class="container-fluid">
   <div class="row taxonomy_header">
      <h1 data-taxonomy="<?= $taxonomy; ?>"><?= $taxonomy; ?></h1>
   </div>

   <?php
   if ($taxo->have_posts()) {
      while ($taxo->have_posts()) {
         $taxo->the_post();

         if (has_post_thumbnail()) {
            //Test pour savoir si on est colonne 1 ou 2
            if ($colonne == 1) {
               echo '<div class="row accueil_ligne grid">';
               echo '<div class="col-md-offset-1 col-md-4 accueil_vignette">';
            } else {
               echo '<div class="col-md-4 col-md-offset-2 accueil_vignette">';
            }?>

            <!-- Affichage du Thumbnail -->
            <div id="accueil_img">
               <a href="<?php the_permalink(); ?>">
                  <span class="img_index"><?php the_post_thumbnail($tailleImage); ?></span>
               </a>
            </div>

            <!-- Texte de description qui se trouve dans les ACF -->
            <div class="accueil_description">
               <?= troncage($taxo->post->post_content); ?>
            </div>

            <!-- Titre du Custom PostTye -->
            <h3>
               <a href="<?php the_permalink(); ?>" rel="bookmark"><?= str_replace('é','e',get_the_title()); ?></a>
            </h3>

            <!-- Affichage du cadre des ACF -->
            <div class="row accueil_acf">
               <p>
                  <span class="glyphicon glyphicon-fullscreen"></span>
                  <?= get_post_meta($taxo->post->ID, 'jojotique_surface', true); ?>m²
               </p>
               <p>
                  <span class="glyphicon glyphicon-bed"></span>
                  <?= get_post_meta($taxo->post->ID, 'jojotique_nbChambre', true); ?>
               </p>
               <p>
                  <span class="glyphicon glyphicon-user"></span>
                  <?= get_post_meta($taxo->post->ID, 'jojotique_nbPersonne', true); ?>
               </p>
               <p class="hidden-sm-down">
                  <span class="glyphicon glyphicon-euro"></span><?= get_post_meta($taxo->post->ID, 'jojotique_prix', true); ?>
                  <?php
                  if (strip_tags(get_the_term_list($taxo->post->ID, 'type')) == 'Location') {
                     echo '€/jour';
                  } else {
                     echo '€';
                  }
                  ?>
               </p>
            </div>

            <!-- Idem pour la fin -->
            <?php
            if ($colonne == 1) {
               echo '</div>';
               $colonne = 2;
            } else {
               echo '</div></div>';
               $colonne = 1;
            }
         }
      }
   }



   wp_reset_query();
   ?>

   <div class="clear"></div>
</div>
<?php
get_footer();
