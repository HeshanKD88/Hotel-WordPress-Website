<?php

//Begin Really Simple Security session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple Security cookie settings
//Begin Really Simple Security key
define('RSSSL_KEY', 'Z8ye0CNfqfD0g8i0tbDAfUUygiRyV8uU4nWtoaloIVP4UuEh1MnILl45w50UFDOT');
//END Really Simple Security key
define( 'WP_CACHE', true );

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
define( 'DB_NAME', 'zXUFTQK6OK81RD' );

/** Database username */
define( 'DB_USER', 'zXUFTQK6OK81RD' );

/** Database password */
define( 'DB_PASSWORD', '8Hp1sbKDQ1KHJG' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

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
define( 'AUTH_KEY',          'Tvu~2yQ.k? SH[gBB;%}|z7#/7&k3y2/I:K_n|,C6/:>Y T><3<b_/BZY6D9SYb/' );
define( 'SECURE_AUTH_KEY',   '@0rj+?koQByBHO$U|pjq^=v$ap4gI%W?kM ~U^0kOULMz>J.#d|WC j,+}h=[vKT' );
define( 'LOGGED_IN_KEY',     '(3&hS<0GL9B{o)^014csG_Su?rnt9RNs6lB h9ocVVT{-~mZLFXReIPF GhbSs.P' );
define( 'NONCE_KEY',         'P4#sa@00@>xnIv:,)gEa=^Q+zz*Vboy:_AG)0gH?zt8{30-kO;Y|KRWD{*Yq_hfA' );
define( 'AUTH_SALT',         'x-olS+CDC(IzjZ6zsS-gP^YR0qPr7Q.vYeOn-Hi(kE`AZm@s~A_=UG;*fgty2,,r' );
define( 'SECURE_AUTH_SALT',  'Z[lE|lSZ98$OTt4wQ#M->z&&&L*.INyw2wh`!S#YXno|RN`1s:sGOw;eT%ZP1;6T' );
define( 'LOGGED_IN_SALT',    '[!r&~0Tr5BQ+:y45|=H<k~6i}SJz(I[Y<Ff]NLh:<Y&/KlbY>OYgO^+5]x!$~XI1' );
define( 'NONCE_SALT',        '(j.623K0[EgV>=]2E5^:viq!(O5H?FkP,k6!mVy-SO{6_ }B0T}^>L52r[o$Thd8' );
define( 'WP_CACHE_KEY_SALT', '^/8XcvIX8B%-[(b|f>(z|qC{0$Z%WKtdm89H`Oj2LnhZ0|F&=C^NkZg8[.w~~8Rg' );


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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
