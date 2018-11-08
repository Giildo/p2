<?php
/**
 * Menu de navigation
 *
 * @version 1.0.0
 * @author Giildo
 */
?>

<header>
   <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#jojotique_menu">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a href="http://www.jojotique.fr/OC_projet1_WordPress/" class="navbar-brand">
               <img src="<?= get_template_directory_uri() . '/../customizr_child/img/logo_couleur.png' ?>" alt="Logo du site">
            </a>
         </div>
         <div class="collapse navbar-collapse" id="jojotique_menu">
            <ul class="nav navbar-nav navbar-right">
               <li><a href="http://www.jojotique.fr/OC_projet1_WordPress/">Accueil</a></li>
               <li><a href="http://www.jojotique.fr/OC_projet1_WordPress/type/location">Location</a></li>
               <li><a href="http://www.jojotique.fr/OC_projet1_WordPress/type/vente">Vente</a></li>
               <li><a href="http://www.jojotique.fr/OC_projet1_WordPress/contact">Contact</a></li>
            </ul>
         </div>
      </div>
   </nav>
</header>
