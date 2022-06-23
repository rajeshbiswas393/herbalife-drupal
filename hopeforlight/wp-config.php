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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hope_for_light' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'X,`L<TmLwmy:5&~!g:6,C6o4R[)/8W8A2;2&B*?e11|{-L3>R8NOWC3Y-t]lFa7X' );
define( 'SECURE_AUTH_KEY',  'Nw`=^u.A;:3YM/qVHW4v7?G`^5DE6ZYT!8J?Ca$<t4k37IIZ>{D{6Z|5e%Zb5^0#' );
define( 'LOGGED_IN_KEY',    'nZOdv=ZCYy7#b%^NX;v.fE=wY#`lXPef1QY;/2w]uNfZ@k`we|;dVh.s:Xp3|Xc,' );
define( 'NONCE_KEY',        '#7dtcJXE6OAhutT%pHyIgWcs6([*~=^Oem]eV nh6G!ro#0^(6p&6DZp{dd6`F!j' );
define( 'AUTH_SALT',        '*XI6L3v~s|p$)jzhao)OM4ta;r&]8>3h6XK)9k;8nl,I,doaMRK<C~NtApU*DF:P' );
define( 'SECURE_AUTH_SALT', '*N6(VRSUFH]U:c)VLE>8$kOnd{R,pu5E`ab}Tq,c.2=SO+f^vr-vf+g!;gqIPi&d' );
define( 'LOGGED_IN_SALT',   '}k4{rNOr.>:g~7,I5 ol_ UXh,S/~@UIu_d_=!#e+kXa6+$SO?3NPn`>ev_Eq{m+' );
define( 'NONCE_SALT',       '5!Vz!TK<y&!o*Lcok:SHvE1)c9$pV51u:OS]1LPzLP=b7J.?%{|5&yYE},h+Vien' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
