<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** Enable W3TC PRO for Synthesis */
define('W3TC_PRO', true); // Added by Synthesis

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ubuntucocom');

/** MySQL database username */
define('DB_USER', 'ubuntucocom');

/** MySQL database password */
define('DB_PASSWORD', '8oRoQnsptQK');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '94JacmmqSv9NPs4xh9smoSgqcEHA874oYKVta0tUtqS3CzH6MwfNoNm1LjShAxh4');
define('SECURE_AUTH_KEY',  'RwQH9Gj6pPr8PuLJpSbgLiK1DGDAUXDgfKgYM2rOeVJYJaLNhHmjW6OM3UmKyfS4');
define('LOGGED_IN_KEY',    'hLNdsnD3sB0DhO3d0XcSKM4uYugvB9aQh4OjxKy2sZbdSr2dQbocUIcXTmGGEWfk');
define('NONCE_KEY',        'R81pF54rfZFNP5yQa7laXks7Vm6ZMz5184o2cJgI83KnfXsAWRncOLPqTt97EKa0');
define('AUTH_SALT',        'RwJvvFzPUjptPbBph88XRbGJwnf8AzLxlV7QujmrBck7Pnpl8kZtUpqe3sQfOlAM');
define('SECURE_AUTH_SALT', '9vY0sV1VqM7h1D3tTDMcJl4UkMQbSM31udT8rt0mGQVNFe6Xh9jLJbV44Z3lTtf3');
define('LOGGED_IN_SALT',   'c6feOLCsrd07dAXITD3vMHh6J0JqZfh10lVWpL61i8TE06rFZJw9jSd5lZUHdbQX');
define('NONCE_SALT',       '1zU6ZUjAF9zKYLAMh6kiYXQnQEg7DAfGcaeoHs4tZMBQ3mPJECmQfBM3xMRicMHn');

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
