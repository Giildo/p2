<?php
//Clé secrète donnée par Google
$secret = '6Lc3QTYUAAAAAH6t8tQV8eAu6axxChbWmwsTLoOe';

//Données récupérées depuis le formulaire
if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] != '') {
	$response = $_POST['g-recaptcha-response'];
}

//Adresse IP du client récupérée dans les données SERVER
$remoteip = $_SERVER['REMOTE_ADDR'];

//Site où l'on récupère la vérification
$api_url = 'https://www.google.com/recaptcha/api/siteverify?secret='
	. $secret
	. '&response=' . $response
	. '&remoteip=' . $remoteip;

//Décodage JSON des données
$decode = json_decode(file_get_contents($api_url), true);

if ($decode['success'] == true) {
	wp_mail('giildo.jm@gmail.com', 'Message reçu depuis Chalets et Caviars', $_POST['message']);
}
