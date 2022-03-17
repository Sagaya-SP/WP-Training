<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'training' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'rVZzwme29stzk#p#Ow]z*C5ultbTilx;`:a;gC5@,;]TU}y%!cK[&QnR!**#y(o-' );
define( 'SECURE_AUTH_KEY',  'N(?q9i?PxQec>~0K(GuO15F^icF|-)Od&P=8`fW%W1eXvKfyCv]xDK@sln4X;lJq' );
define( 'LOGGED_IN_KEY',    'EvQnFCv%}T#/Jr4P8AJC*6u7d(=?crccEg2$uGR$S_4/^r cs^IkLJ}dN+%-W%^)' );
define( 'NONCE_KEY',        'jf%x8Ca|!,]u:;5>Co2L%w<gtf{5q#u7C t6l|MIc]WIE}1<A=RxuwNCd=8^693l' );
define( 'AUTH_SALT',        'd5Zgxjr)nbk^<T=[ES[,]kcLG%9#>=^r+G!Af!DtiTUBP T?V[$dvyK o-t}XS8F' );
define( 'SECURE_AUTH_SALT', 'WHc,E=9K:0wK58-(2TgRr?(H(&U0#4Y/*y[%Pc[]01M1DOI8j%VRl6[[4F_k&oO]' );
define( 'LOGGED_IN_SALT',   'rjB,*NQhX=$Hsd]cC%<iS&eX~T~9XXa1yP+%*WTx89+(bm`4lAiks:F|D!EnEvqg' );
define( 'NONCE_SALT',       ' i_{7yOV:/krTjM{ppJL@L_[Rg4zBxDR>[;z2QX,AGZi)=w7R8%N.WP4a86^5Hjy' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'tr_';

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
