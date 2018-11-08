<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'jojotiquac7961');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'jojotiquac7961');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'jOn79613226');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'jojotiquac7961.mysql.db');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '`&XM%/z2piJ[esPvr:wsTul60.HrwnlXXD5g}h-R.C:UY<(0j+fw9A@OhHXH<%H7');
define('SECURE_AUTH_KEY',  '@h.m.O9s8Pl#9w`HHrG@{{Q:R5)Na~Oa0eK^#;,N8jFMq$}3JG&U_/#8{}&E>*>R');
define('LOGGED_IN_KEY',    ',E#d,Kz:g,#M@U_~$7yFrpb6T@7B6O;Ctd|khSvO:8GlmwBWh67;vjny`GPb<k#.');
define('NONCE_KEY',        'Xy98:qNE}T6FcjDN?!l9<^T[Sm/Kb.S*WG$O-sTd^l!A|]2Ttt@i?%WGJz&KAR4=');
define('AUTH_SALT',        ')?jk}(IGg<![Z*A:;0-(/;LY<AWK_$&3aSno9}!N[uH#Eg}-)}R.@]hj0W$~zQwH');
define('SECURE_AUTH_SALT', '3<~ J?rd|MLxU/+1g?JQCzFw$E^9t TDkP|fq$`cZ/cx^b) ouM%&;Oa6s7R;&rs');
define('LOGGED_IN_SALT',   'c=]1#Q*^:x3%QckjWQ`NfN7|Y/@Bm_9Knpd5<q,$}4o`cS2;pKfd=fPMDr<y.I]|');
define('NONCE_SALT',       '(3^}8Jua~w5v(5HU~|&<|jh9+]B(5o+g{a6H[qMS:x;np?,*9r+XQnSM[S%-JBUj');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'oc_wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');