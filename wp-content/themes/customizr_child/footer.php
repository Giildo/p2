<?php
/**
* Affichage du footer
* Récupération des widgets et du colophon qui affiche les crédits
*/
?>

<div class="container-fluid">
<footer class="row">
   <div class="col-md-3 col-md-offset-1">
      <h2>Nous rencontrer</h2>
      <address>
         <p>Rue de l'Église<br />
         73120 Saint-Bon-Tarentaise</p>
      </address>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2424.130013258806!2d6.635081747695676!3d45.414881376596675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478978ac3bd03ed3%3A0xfe5d5054e6ffe970!2sRue+de+l&#39;%C3%89glise%2C+73120+Saint-Bon-Tarentaise!5e0!3m2!1sfr!2sfr!4v1512150836473" frameborder="0" style="border:0" class="hidden-sm-down footer_googlemaps" allowfullscreen></iframe>
   </div>
   <div class="col-md-7">
      <div class="row">
         <div class="col-md-6 footer_central">
            <h2>Nous contacter</h2>
            <p>
               <span class="souligne">Mail</span> :<br />
               <a href="mailto:giildo.jm@gmail.com">chalets_caviar@gmail.com</a>
            </p>
            <p>
               <span class="souligne">Téléphone</span> :<br />
               06 06 06 06 06
            </p>
         </div>
         <div class="col-md-6">
            <h2>Nous connaître</h2>
            <div class="footer_images">
               <a href="https://www.facebook.com/chaletscaviar/" target="_blank"><img src="<?= get_template_directory_uri() . '/../customizr_child/img/facebook.png' ?>" alt="Logo Facebook"></a>
            </div>
            <div class="footer_images">
               <a href="https://twitter.com/chaletscaviar" target="_blank"><img src="<?= get_template_directory_uri() . '/../customizr_child/img/twitter.png' ?>" alt="Logo Twitter"></a>
            </div>
         </div>
      </div>
      <div class="row footer_credits">
         <p class="col-xs-12">&copy;<?= date('Y'); ?> <a href="<?= bloginfo('url'); ?>" title="<?= bloginfo('title'); ?>"><?= bloginfo('title'); ?></a> - Tous droits réservés.</p>
         <p class="col-xs-12">Propulsé par <a href="https://wordpress.org" title="WordPress" target="_blank"><i class="fa fa-wordpress"></i></a> - Design créé par <a href="https://www.jojotique.fr" title="Jojotique.fr">&copy;Jojotique.fr</a> et inspiré de <a href="https://presscustomizr.com/customizr" title="Customizr">"The Customizr Theme"</a>.</p>
      </div>
   </div>
</footer>

</div>
