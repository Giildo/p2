<?php
/**
 * Fichier où se trouve la page d'accueil
 *
 * @package Customizr
 * @since Giildo
 */

//Récupération de tous les chalets
$chalet = new WP_query(array(
	'post_type' => 'chalets',
	'posts_per_page' => 4
));

//Tableau qui regroupe les ACF qu'on souhaite afficher
$acf = array('surface', 'chambre', 'capacite');

//Compteurs : pour savoir si on est colonne 1 ou 2 et pour le nombre de post
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
	<div class="row accueil_header">
		<img src="<?= get_template_directory_uri() . '/../customizr_child/img/chalet_accueil.jpg'; ?>" alt="Image de fond de la page d'accueil représentant le salon luxueux d'un chalet en bois"/>
		<h1>Chalets et Caviars</h1>
		<img src="<?= get_template_directory_uri() . '/../customizr_child/img/logo_mini.png'; ?>" alt="Image tiré du logo de l'entreprise représentant un A surmonté d'un flocon de neige" />
	</div>

	<div class="row accueil_titre">
		<h2 class="col-xs-12">Nos dernières acquisitions</h2>
	</div>
	<?php
	if ($chalet->have_posts()) {
		while ($chalet->have_posts()) {
			$chalet->the_post();

			if (has_post_thumbnail()) {
							//Test pour savoir si on est colonne 1 ou 2
				if ($colonne == 1) {
					echo '<div class="row accueil_ligne grid">';
					echo '<div class="col-lg-offset-1 col-lg-4 accueil_vignette">';
				} else {
					echo '<div class="col-lg-4 col-lg-offset-2 accueil_vignette">';
				}?>

				<!-- Affichage du Thumbnail -->
				<div id="accueil_img">
					<a href="<?php the_permalink(); ?>">
						<span class="img_index"><?php the_post_thumbnail($tailleImage); ?></span>
					</a>
				</div>

            <!-- Texte de description qui se trouve dans les ACF -->
            <div class="accueil_description">
               <?= troncage($chalet->post->post_content); ?>
            </div>

				<!-- Titre du Custom PostTye -->
				<h3>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?= str_replace('é','e',get_the_title()); ?></a>
				</h3>

				<!-- Affichage du cadre des ACF -->
				<div class="row accueil_acf">
					<p>
						<span class="glyphicon glyphicon-fullscreen"></span>
						<?= get_post_meta($chalet->post->ID, 'jojotique_surface', true); ?>m²
					</p>
					<p>
						<span class="glyphicon glyphicon-bed"></span>
						<?= get_post_meta($chalet->post->ID, 'jojotique_nbChambre', true); ?>
					</p>
					<p>
						<span class="glyphicon glyphicon-user"></span>
						<?= get_post_meta($chalet->post->ID, 'jojotique_nbPersonne', true); ?>
					</p>
					<p class="hidden-sm-down">
						<span class="glyphicon glyphicon-euro"></span><?= get_post_meta($chalet->post->ID, 'jojotique_prix', true); ?>
						<?php
						if (strip_tags(get_the_term_list($chalet->post->ID, 'type')) == 'Location') {
							echo '€/jour';
						} else {
							echo '€';
						}
						?>
					</p>
				</div>

				<!-- Affichage de la taxonomie 'type' => Location || Ventes -->
				<div class="row accueil_type">
					<p><?= get_the_term_list($chalet->post->ID, 'type'); ?></p>
				</div>
				<div class="clear"></div>

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
