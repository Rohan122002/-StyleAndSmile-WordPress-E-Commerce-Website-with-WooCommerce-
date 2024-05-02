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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'style' );

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
define( 'AUTH_KEY',         'cN#$wd^_Yhylq&thal^/y2MTfJ-_6uT5Z=,e19ubgt,4N|ByGvGr;tHyP%Ouy{5W' );
define( 'SECURE_AUTH_KEY',  'JU%1`iQ;cdTv@!z.#6^HlR|X|5VWjnN[|0Ife=]1awk,vr`/iLMa4z$cw=y%B<w]' );
define( 'LOGGED_IN_KEY',    '~~UaO>YBpRN9!t=RJo bm@ama=+9|vw$pQ]q]LJ4S?cC1I=TI2FEs=:z2 4{N$(H' );
define( 'NONCE_KEY',        ' jMte?TZ03/-z~bWETh=WdI.v!F0#=giHCW]Pih1tVoH|D?/!!.@kssUxU0F9mia' );
define( 'AUTH_SALT',        'jSt4$e[I Z4l  [a~MlLlVK6/()ege>cl:;zFG3UW|k4%5R7K~BC]p.iZ{^YBw6r' );
define( 'SECURE_AUTH_SALT', '?rm!:$k`!e;Puk:<!/lKCX&>fp/2G$7r:F&4${ axye!w% iVVcMr;JtJ@Zt/ch|' );
define( 'LOGGED_IN_SALT',   'atoRE+O@3q-ZM%wZ=PBD3*gl6Xbr&w>hO_8Fso$;!WDxTZd4[;_-so+YYZL/eg<g' );
define( 'NONCE_SALT',       ')hg9|$`_3_:1SSf,XBqwE-BlH2mRV<nc/3yAfx6FO(nr:oDT8OvPm/g~S|a61=%9' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
