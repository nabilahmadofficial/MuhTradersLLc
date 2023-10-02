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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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


define('AUTH_KEY',         'ew8p/hMok76LSwN41Q3yAzXHqLddPn5KSaY7NHLN+WIXwNnBVjqbMzNnixrldzKo/eB05Y/1e0zK7RyXBi7kPQ==');
define('SECURE_AUTH_KEY',  'PX+SYD3aECfLCPcLMcnWClvSOId13RSXoyXEY8YSx+nZ12Xcy+42LoU4kwMrGbQ8evPuMOm6GiaP1Pr4Wveq/w==');
define('LOGGED_IN_KEY',    'Ps+RGocA/tVAGllo7MFIg7mjdr3GaXaD+X6d0LG+4eJIgyzgDfq4CSiS5Tur5POxKaO5Iuhg6CDC/Kd6wwT+jw==');
define('NONCE_KEY',        'AHurHb5wruSQn9vcSQ3hpjbpP378eufCWkrpAccXDnyvfB+iBy3BwlRoZsQ9VumDFt8FdJ0+SliXFUmSmUuwHg==');
define('AUTH_SALT',        'eWA6gDn3bs/zOC1v5GS3NJ26rTHRXxcW2KN6KgrUB/JCHqzQDpxwY+sqQcD7Lc05DirlmGKQMzYcAL7fhwXOJg==');
define('SECURE_AUTH_SALT', 'xAATbmcoI4eBALSmchzuRk4gG8F9Eev2Yw96+t0k1VYkweasKLh8ajzodi6kjmuMaiC4GtQsvMYQRBBD5+R1wg==');
define('LOGGED_IN_SALT',   'VON6J2IKUw+OR/Jo/4YnO5ueBIZc5HSQ9Jyrpw0L6CVkU4sCjKPr/32WOS8lnc+BehGLg9479ufMWlcOrwHFCg==');
define('NONCE_SALT',       'E+sivZAxF9NDg146eDlnIyu5yHkJvzkZAzRa//0roSXdg9IoPhR1UC0yJhz7DWp5VKR4S/PfCJndLRNTjKXdWg==');
define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
