<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'BKrz2_0kA7DA=IT^7xP0.4{_n{|Le2B7:FQfVTh8R9x.|TSj~MknBfacgp/a|D8x' );
define( 'SECURE_AUTH_KEY',   '1&^W6Usx$Sd,<Qc.MUw(<*Q`^EPjS$I0 od<PEli4rnAi UTR0).gOo*)ZTA^yD%' );
define( 'LOGGED_IN_KEY',     'm `M.TDwrv[^l4tjc5wx`YJ#OT+k>y<j|BdHGI/:Xj>Iy`EQiXrH:NNV#Ug9w-N/' );
define( 'NONCE_KEY',         'Xa8!G59r8]x*gXt!s9Q_CJpt-e-as4LX/ MbEB=_5(ch2Vnk#Q!QZiQzF17^XQPf' );
define( 'AUTH_SALT',         'N>-wY GTSNp`t.KK-6/NRb7[,FRR[e+wh)U2}dsWrWHMa%4cS7DKe~HM<(DiSzwh' );
define( 'SECURE_AUTH_SALT',  '!^sSnX)MgezG)ec]z `FCR6nQvNQ?/UE?!t:gWL`cw{A-ibxVqaJT@{6{kqeu7Ed' );
define( 'LOGGED_IN_SALT',    ',F5>kzQXc0)nWrj8+LRcQS2@A:m,IVIc 2%A56Q.EuHd?w+=LCq>N+tn>`7a2t16' );
define( 'NONCE_SALT',        '@nE d-~4+EPaUFGjQ93-I=WHpA4IuEXACBjb/nV/vnU{8)14o_m=~|s7g%v0,98H' );
define( 'WP_CACHE_KEY_SALT', 'yfYB><*tL61Smfla0.75cpih9t}w/y]N4ZArZaV`sMw;dj31@z>`R5jrU^*&|8&;' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
