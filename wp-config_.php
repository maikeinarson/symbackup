<?php
/** 
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', false); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '' ); //Added by WP-Cache Manager
define('DB_NAME', 'symbackup');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 *
 * @since 2.6.0
 */
define('AUTH_KEY',       '7B%mGzp)gu4DEGfiPrKfXw4uc)JVY#fbC@G@DTF@71lZHF6LJahmGox7k8d^OvIM');
define('SECURE_AUTH_KEY',       'a@ZfQnQ(U13O2SOv(YEvcYyiTYCfXjjoi6gvYAyc@DLO(1JLDF7AvGwpQQ#6DcEV');
define('LOGGED_IN_KEY',       'WlDAeKj5IWMlxu8qPwFQTFHntsA%ed(%f4eLS76hm2njti17FNcAmm8^%ToX6gFW');
define('NONCE_KEY',       'R@HHX#Jarg4FJtRTy1tCH2%0D02ZHB*me7S(@V&6Ep(CC1yaDGuIyY9blT@%H*jo');
define('AUTH_SALT',       '*SNg%ROmYGhZ8*vSCEHRRySPbtOaZOgJwaXD1VLe*xaSO*Q@*67VGl@2hZdyFCz9');
define('SECURE_AUTH_SALT',       'XAOUiTDA&o&KD!N3BBzI2t3Xif)qbVCXU3rUXFE^g4xVIbu(aBDavdJC*07!j2ZJ');
define('LOGGED_IN_SALT',       'Q26^yLgJPqw8@iR@3rfKZf@%2T%7pglA6IG)0nKTwa6MQ@YgNvM39cT4(cUouu0y');
define('NONCE_SALT',       'V2vn0ZAJuMYar)lK!pv7nYg0EDP8kiT9aa2MJaa)RSSJDJkaXpz4*qyxPHcrUy@z');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'de_DE');

define ('FS_METHOD', 'direct');

define('WP_DEBUG', false);

define('MULTISITE', false);

/* That's all, stop editing! Happy blogging. */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

//--- disable auto upgrade
define( 'AUTOMATIC_UPDATER_DISABLED', true );



?>
