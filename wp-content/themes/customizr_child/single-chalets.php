<?php
/**
* Affichage d'une page simple d'un chalet
* Récupération de :
* - la photo "mise en avant"
* - la description
* - aside avec les ACF
*
* @author Giildo
* @version 1.0
*/

if (strip_tags(get_the_term_list($post->ID, 'type')) == 'Location') {
	$type = 'Prix de la location';
	$suffixe = '€/jour/personne';
} else {
	$type = 'Prix d\'achat';
	$suffixe = '€ frais d\'agence inclus';
}

//Comptage pour récupération de l'adresse de la première photo
$i = 1;

get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		?>

		<div class="row post_titre">
			<?php the_post_thumbnail('full');  ?>
			<h1><?php the_title(); ?></h1>
		</div>

		<div class="row post_contenu">
			<article class="col-md-6">
				<h2>Description</h2>
				<?php the_content(); ?>
			</article>
			<aside class="col-md-offset-1 col-md-5">
				<h2>Les infos essentielles :</h2>
				<?php
				Jojotique_Metabox::ACFAffichage($post->ID, 'jojotique_surface', 'Surface', 'm²');
				Jojotique_Metabox::ACFAffichage($post->ID, 'jojotique_nbChambre', 'Nombre de chambres', '');
				Jojotique_Metabox::ACFAffichage($post->ID, 'jojotique_nbPersonne', 'Capacité maximale', ' personnes');
				Jojotique_Metabox::ACFAffichage($post->ID, 'jojotique_prix', $type, $suffixe);
				?>
				<img src="<?= get_template_directory_uri() . '/../customizr_child/img/fleche.png' ?>" alt="Fleche pour former une info-bulle" class="hidden-sm-down" />
			</aside>
		</div>
		<?php
		if ($photos = Jojotique_Metabox::diaporama($post->ID)) :?>
		<aside class="row post_diaporama">
			<h2 class="col-xs-12">Intérieur</h2>
			<?php foreach ($photos as $photo) : ?>
				<img src="<?= $photo; ?>" class="col-md-2" alt="Photos du diaporama" data-adresse="<?= Jojotique_Metabox::adressePrincipale($photo); ?>"/>
			<?php
			if ($i == 1) {
				$adresseGrandePhoto = Jojotique_Metabox::adressePrincipale($photo);
			}
			$i++;
			endforeach; ?>
			<img src="<?= $adresseGrandePhoto; ?>" alt="Photo principale" class="col-md-12 hidden-sm-down" id="img_principale" />
		</aside>
		<?php endif; ?>

		<div class="clear"></div>
		<?php
	}
} else {
	echo '<p>' . _e('Désolé, aucun chalet n\'a été trouvé') . '</p>';
}

get_footer();
