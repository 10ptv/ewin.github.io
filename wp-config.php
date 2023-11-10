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
define( 'DB_NAME', 'ewin.github.io' );

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
define( 'AUTH_KEY',         'r:NDpPFa0->sGHd /[8Q+Fx,jC=oxXY>8]L6S+7iVt)`Ow/@sda>^[;~]3A*C={r' );
define( 'SECURE_AUTH_KEY',  'Z]:;nve5~$vP u`yPT/`.5AvC26vuvkG*L2s*Bv)95WQKW|sUujzoRHOph,optt3' );
define( 'LOGGED_IN_KEY',    'GQWD OGoSmZ1{~&7v&%1W.F?&xPr8,s712@T0u}}7YghlJaLW#3K7rozr6?^k#Qn' );
define( 'NONCE_KEY',        'D!@MVuYXlw&~E^+pX t4~J5q`5-&C-lf~CfqD1P<o(Wb9[M3tr g2]oS!wv^;:8)' );
define( 'AUTH_SALT',        'K :|5;eU8(%,CVt5;/8OKx7?LtC+,Z=5$`5{[*-jEo2nD_G,@=RV[jGOIb5#Yt%_' );
define( 'SECURE_AUTH_SALT', 'w1)X=9MtrXMCM&9iy@mMj,f`K!~N!;44Ys%gq9ryBBnpk)I]YW*61H3F?C}Mq%0y' );
define( 'LOGGED_IN_SALT',   'q06wG.N=cS)0p^-l?$OApwHi9Vmf;hDq+8ACThY8Nr2Q0H9NtS<]j5]({gp2j~5H' );
define( 'NONCE_SALT',       ')^u-LElim1]J@b7x~&|qoWREN8dO_xm:_|{SH?WWyBd$n$Kz|x}Zl}1*.`CXa3fa' );

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
