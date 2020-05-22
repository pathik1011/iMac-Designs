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
define( 'DB_NAME', 'imac_designs' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',         '8DgXvg)HBMH%?K{z|JhMSB,+T4}okhB 8?^H+fLQKSRIL=f7BbyU}f;YMa^W7n7I' );
define( 'SECURE_AUTH_KEY',  'LQ ae3/<rC@b~ycnnXdH?-MCObb7D!MCF^m}R?rL[Yf =>,[aO>e?~mXA]&b`?Ld' );
define( 'LOGGED_IN_KEY',    'C&{O^=I{27eJhX7sd/#=n}Apk=LU4;vLj{@dK[}e4u_5j2Z+`j/.}IAwgk![FD}:' );
define( 'NONCE_KEY',        '-{vI]BPHGp(*u>Ix3fZ].i53e)o7NC(dH[.}tN#},T9xM)*7#`c-EjnGat2.;7#.' );
define( 'AUTH_SALT',        '?@:3x5v5-#eL]~5v%{jPgl-I( V^Ev]_BkPN[y#rG}$PqmRmadTUHd5QUoQycd}7' );
define( 'SECURE_AUTH_SALT', 'z>ORb%+GyK3Z-_]T(C=L-W)<O7uP&%m[494n!spNVi*Yk}sOK`kS_-qe,y1rFOHn' );
define( 'LOGGED_IN_SALT',   ')v<qoj0yp.dTg;&rVJ@%wcVM$TQ,wA}8@t$53B|RMT!1%juPAJpZ+N`44@!j>~{a' );
define( 'NONCE_SALT',       'rv[BzMYRAippD_O)Zgs|>3s#p]]./K[E(|<?/II{:;X;xz`p(iLC@.;vIW8SX>UU' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
