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
define( 'DB_NAME', 'wp_myroom' );

/** MySQL database username */
define( 'DB_USER', 'myroom' );

/** MySQL database password */
define( 'DB_PASSWORD', '7EqJudIThoLzw7iz' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'B?FL{enPf|)>{O2&tO|G)f(T>}tB-ETm;6#2fe*?Ak4/U+KBOb;fW(.(2?SOf#3@' );
define( 'SECURE_AUTH_KEY',  'Qus&T<zD 3+Wy}X]ybB2D^yvcaNUi#4Vr%CDh7L&JiL#A _mp#}Rstl~#T9$lOA%' );
define( 'LOGGED_IN_KEY',    'w<f9Fe1g)S=EOzVTxt:Z6>302{K+T;^;1FT9KEeIf(to(l!ah_>25<L3{7pN`X!o' );
define( 'NONCE_KEY',        'M^^X{.^Ck6d3Q+7?vv_-w_lw3]at:a)=tvWyHk4f*;Y|@e33k</ALE.%J[IkAUFr' );
define( 'AUTH_SALT',        'Z,bRYR!U)#I4GJj[U~stwuwtT7?WS*_qsz@Ik`V`.Cu5X>0 %?!}vSpM~]BJ*CWb' );
define( 'SECURE_AUTH_SALT', 'G8p>j3JLmY5UhDt-Su^;xKjM$TL@UGOIyx&Eu2H.1 r3pXE<{jfAT~B9ss>hX03Z' );
define( 'LOGGED_IN_SALT',   '1;mg>rVA()+i9yJZMbxb-r$,)HSKTd(W7};=A3ynr07I>()sRwu_bTFQCw0Qy`//' );
define( 'NONCE_SALT',       '4,iThw:K;E-fO>JAPz1.]g^/Uf2PT3Qk [2CqN`d,qYzUk?1dhd(2OZE{bJD)j9r' );

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );

/**
 * Disable automatic update
 */
define( 'AUTOMATIC_UPDATER_DISABLED', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
