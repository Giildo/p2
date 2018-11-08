<?php get_header(); ?>

<?php
if (have_posts()) :
	while (have_posts()) :
		the_post();?>
		<div class="post">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small'); ?></a>
			<a href="<?php the_permalink(); ?>" class="more-link">En savoir plus</a>
			<div class="clear"></div>
		</div>
		<?php
	endwhile;
else :?>

	<p><?php _e('Désolé, aucun chalet n\'a été trouvé'); ?></p>

<?php
endif;
?>

<?php get_footer(); ?>
