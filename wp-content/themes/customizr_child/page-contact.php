<?php
/**
 * Fichier où se trouve la page d'accueil
 * Template Name: Example Template
 * @package Customizr
 * @since Giildo
 */

get_header();
?>
<div class="row contact_formulaire">
   <form action="" method="post" class="col-md-offset-2 col-md-8">
      <legend>Formulaire de contact</legend>

      <div class="form-group">
         <label for="nom">Nom</label>
         <input id="nom" name="nom" type="text" class="form-control" />
      </div>

      <div class="form-group">
         <label for="mail">Email</label>
         <input id="mail" name="mail" type="mail" class="form-control" />
      </div>

      <div class="form-group">
         <label for="phone">Téléphone</label>
         <input id="phone" name="phone" type="phone" class="form-control" />
      </div>

      <div class="form-group">
         <label for="message">Votre message</label>
         <textarea id="message" name="message" class="form-control" rows="15"></textarea>
      </div>

      <div class="g-recaptcha" data-sitekey="6Lc3QTYUAAAAALd3lC7IsrQVR3k0UIw-f5VS0Cim"></div>
      <input type="submit" class="btn btn-default">
   </form>
</div>
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
   $message =
   'Nom : ' . $_POST['nom'] . '<br />' .
   'Adresse mail : ' . $_POST['mail']    . '<br />' .
   'Adresse mail : ' . $_POST['phone'] . '<br />' .
   'Message : <br />' . $_POST['message'];
   wp_mail('giildo.jm@gmail.com', 'Message reçu depuis Chalets et Caviars', $message, array('Content-Type: text/html; charset=UTF-8'));
}

get_footer();
