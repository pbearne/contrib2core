<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress_develop');

/** MySQL database username */
define('DB_USER', 'wp');

/** MySQL database password */
define('DB_PASSWORD', 'wp');

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
define('AUTH_KEY',         ';_JbRvrki4y(^wws7:*idoC5F{V:@,B>%mH>HN`<,74J(lwRF]GKVE`?0f*U:a1D');
define('SECURE_AUTH_KEY',  'S<OePs:h#$eg/X>m^-Q+r;Yw8a/>xwgN(g;l{>la5N>Wpi?k#j[J;<};wu@hkEY/');
define('LOGGED_IN_KEY',    '6B=n-Oj+Xxrjzy=B|R6[@JitY%z+siHOc+QS98@#!<]S<}J_R^VnYvk/&5p{yTC]');
define('NONCE_KEY',        'H$&CeQz>``q4C9mSF2+^S;yM$FG T~eN@qx0 G4ImWOs=izX_8.DpW}K@8</|Yf+');
define('AUTH_SALT',        'N==!T$V2QxB&t~5S@1<(djHO{a%ZBEE51Y+S`vn|/ya: 81N=.iZF|*&f+iBV/U~');
define('SECURE_AUTH_SALT', 'OwZ8zjrFS7u01jg{3 mpqE/DIsk1$$B(g>yQ==vm})clqqjb|IOrf  HV0ao{EKB');
define('LOGGED_IN_SALT',   'T~i+<a Jj+_l|-Y8ATy/SACxFy/4 oVz5N8+0@Ce?xiCQ9LhJ^(&@)23/|(mz|9I');
define('NONCE_SALT',       'Npgq)F`Nu?}o~Jnv:D=t^;0xn6@E@/Kh#a<mn+s^7K9q8{E,>Olt|yMl{#YA[o0u');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
