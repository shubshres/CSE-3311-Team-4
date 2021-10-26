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
define( 'DB_NAME', 'mavsinja_wp1' );

/** MySQL database username */
define( 'DB_USER', 'mavsinja_wp1' );

/** MySQL database password */
define( 'DB_PASSWORD', 'D.dQJPxL78AH4h3XsZn75' );

/** MySQL hostname */
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
define('AUTH_KEY',         'kb0KCM1wRT0OMYcF6vJKz4vxqWN4bNe7VIisIvT8tC5VjV6rza5WnnRlioYzDxTz');
define('SECURE_AUTH_KEY',  'sTNbfhKDmPnHxPaEYpBbcCBZs2dtr21dLNhznBpv3fAj1wUJEiF9ZZiH1aftAfRA');
define('LOGGED_IN_KEY',    'soMfJpezNcLh6FvalZZndJ7j1j1xrwVIJ2xlqDsJABkomARKHuMGiGYDm5RSeoTt');
define('NONCE_KEY',        'BDGoiK7FS8iiTsDV8xeqgVChg57C6JeUBuUdKKywGjYEAuvdOLhn9Zai2zNmcTBp');
define('AUTH_SALT',        'AAP4ftT2USxwUnORMX6CSqYqZqu6nRgnmsTOarLA6CIDu19BeJh8JSXgHdm1I7uq');
define('SECURE_AUTH_SALT', 'QJxI1qjLnOl9cwWlic7aVoYvRD9fdveRblGrKu3HKrY1RgLYbuWm6XTugYQbWNpZ');
define('LOGGED_IN_SALT',   'k8LdLVdeikMwTKW4Mnzk38nbWDEgzd5jCzOl9G4TNIlFx6cQynx2XEvmO7tQjc54');
define('NONCE_SALT',       '46osGEbA0tUMyIqnBuuNE8AT0i3eyLRy9QpjdZOW7EOUsydwllGgnm97IA5F2Baf');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed externally by Installatron.
 * If you remove this define() to re-enable WordPress's automatic background updating
 * then it's advised to disable auto-updating in Installatron.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';