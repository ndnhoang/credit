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
define('DB_NAME', 'credit');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '12345');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'v~POi5LMXmd:XI|LP[sBElvZ}uvZcOZHLi{phuT<5-*B^H5N_sjy]x2*]_a3yH+b');
define('SECURE_AUTH_KEY',  'oKQvw{O^)53(#j>c4q!!bGc[;OYiKZarj>O*ClR(M(NGy~;xGl;oRO_7hh(S@YvL');
define('LOGGED_IN_KEY',    '4Z?ItdxYLsl)Z~(Yp%v-8ul0X!>>`&^+S6G|c2*}kMrPdm92*>$-4Xs4ia:=~ Nc');
define('NONCE_KEY',        '1t@eI,{=UMAsHPD>9%;!,9N5eKkKDk~+W.0tQxez,N)2YJm|;~emL=-*GY}AM=qx');
define('AUTH_SALT',        '$7bB-=l*!J|`L~Byu&Wp@imfK3H2F~o=-xc-aT;K WoB|<N6kCsvY|[Atu.YL-D]');
define('SECURE_AUTH_SALT', 'FX_H@I*9?Y*.9&_H7aX;U9[B:MP@mtN@=w`m_6^sXU`f~Wa*&9;k#E[0lu.rjvC,');
define('LOGGED_IN_SALT',   'qZX[X}&djn?+gp]6cAV_;4@#K-D*rw+ZYwj_W/V52Jkma9aJT!8J`3<0J[7Ym0e~');
define('NONCE_SALT',       '[BQWU>q`{~*rYG<)Xr@6b%*I;M~&X/5vZ.TFU/Wn_@gev~U[Bs$#!j>gQs69UQ!N');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
