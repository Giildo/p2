<?php
 /**
 * Affichage du haut du HTML
 * @version 1.0
 * @author Giildo
 */
?>

<!DOCTYPE html>
<html lang="Fr">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
	<?php if ( ! function_exists( '_wp_render_title_tag' ) ) :?>
		<title><?php wp_title( '|' , true, 'right' ); ?></title>
	<?php endif ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- Installation de Bootstrap -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Utilisation de recaptCha -->
	<script src='https://www.google.com/recaptcha/api.js'></script>

	<!-- Installation de GoogleFonts -->
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet" />

	<!-- Installation de JQuery -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

	<!-- scripts for IE8 and less  -->
	<!--[if lt IE 9]>
		<script src="<?php echo CZR_FRONT_ASSETS_URL ?>js/vendors/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body>

	<?php include_once 'templates/nav.php'; ?>
