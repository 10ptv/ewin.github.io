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
define( 'AUTH_KEY',         'pbxw`1=]f:XS~-z:HivH?;yLnqJ&B!1SY[B}qFQtfq+p[313{bIh kG*])pY4Y_|' );
define( 'SECURE_AUTH_KEY',  ' d#O9pPv8F4tr./<F?G5Es[q%^*VuOavs3goPT4ZF5&7YG@udcZo}/_>Muc/bJ<}' );
define( 'LOGGED_IN_KEY',    '[18u>bQbk0;tx|Xv c8knl77-K]gFe[fW}yzJU`d59E5!WTQgJn&/CD<yG6NJ9|>' );
define( 'NONCE_KEY',        '];w6&$MUTS|fwzmo2i<:YXQ,g=9@]|Jaiv0(5wPR^&FoOpj**%gS1aayq?(?pa8U' );
define( 'AUTH_SALT',        'nz~xAHY#Oa!zKA2]%0:IMJ9S)-OY;!/v<~|Jn-h4.#q|CT8J|}+yakH(OqBOx(NK' );
define( 'SECURE_AUTH_SALT', '38+~.Vajp*,%FMK@IW#;gzh=)CkG7zMxR`sFv@ HAe6l<f1B]m1An+XD+i%EP=BO' );
define( 'LOGGED_IN_SALT',   '`%d j#JiD:%]K#8n/%G V($3)D_c%T@>V+CE|A=K=z0{*wO15[xQsfZ}/GiNY8 [' );
define( 'NONCE_SALT',       'c{6!#xXi~t|Z_+tvHqEZTNm6^yeG$6#Tlm|+UDB$IJx^RP=6#]:V%VO+t@Iq[d0)' );

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
