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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'base_react_api');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');
// Default passord = Tq(@c!See8yOg0h^CS

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'vqkqbed|,lTjS(+?f$Rg[B8)6F.F$/c{,LqbK2`Vf1Ctl$wJbRz|s&$dBstvo yp');
define('SECURE_AUTH_KEY',  'Dn|M3O^{+[B8elpfC[5(Wu<N=}iypxL_Mk4;)=IiDj.KWJsl&KNA`+5|TYq jlPj');
define('LOGGED_IN_KEY',    'o7LQW{7f8^2bZGnv9#fW&<vB]mi5}0eJeGb~)[MS4E%DA8 DDDEA7LQ]B=)WjFb&');
define('NONCE_KEY',        '5JO`HjOvrhy!][)=Va%%Vs3Kx4BJYo8[4{|/kt+o7V^,m^Um9Gpp1$48P(+NhDAw');
define('AUTH_SALT',        'U;C0hQ<%tlU?`LlQvN[FEg4nvJ02Ti2ZsLvGH(1kYK:g;aVlS$&$z|nDxtym9J4N');
define('SECURE_AUTH_SALT', 'bLYcn`C,ybaAZg0`h3_huu{_Ku7LJv$_8w!!?JaNTg01yc-dGgXB94Bhk:{iGg.%');
define('LOGGED_IN_SALT',   'oR_Y$.3AUIP*]Rm0@&?CUDijag!19m6=Q1<9Fj}9JSqu^N6]m8s1KO:VHHV^@- 5');
define('NONCE_SALT',       'nqr&TnK*w9zzQkI~mx[` |y!E(=X;=FYdx8Pn&5U=93+*RvUmlA,1;(HEWd^k18G');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'bra_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
