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
 * This has been slightly modified (to read environment variables) for use in Docker.
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// IMPORTANT: this file needs to stay in-sync with https://github.com/WordPress/WordPress/blob/master/wp-config-sample.php
// (it gets parsed by the upstream wizard in https://github.com/WordPress/WordPress/blob/f27cb65e1ef25d11b535695a660e7282b98eb742/wp-admin/setup-config.php#L356-L392)
// a helper function to lookup "env_FILE", "env", then fallback
if (!function_exists('getenv_docker')) {
        // https://github.com/docker-library/wordpress/issues/588 (WP-CLI will load this file 2x)
        function getenv_docker($env, $default)
        {
                if ($fileEnv = getenv($env . '_FILE')) {
                        return rtrim(file_get_contents($fileEnv), "\r\n");
                } else if (($val = getenv($env)) !== false) {
                        return $val;
                } else {
                        return $default;
                }
        }
}
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', getenv_docker('WORDPRESS_DB_NAME', 'wordpress'));
/** MySQL database username */
define('DB_USER', getenv_docker('WORDPRESS_DB_USER', 'example username'));
/** MySQL database password */
define('DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'example password'));
/**
 * Docker image fallback values above are sourced from the official WordPress installation wizard:
 * https://github.com/WordPress/WordPress/blob/f9cc35ebad82753e9c86de322ea5c76a9001c7e2/wp-admin/setup-config.php#L216-L230
 * (However, using "example username" and "example password" in your database is strongly discouraged.  Please use strong, random credentials!)
 */
/** MySQL hostname */
define('DB_HOST', getenv_docker('WORDPRESS_DB_HOST', 'mysql'));
/** Database charset to use in creating database tables. */
define('DB_CHARSET', getenv_docker('WORDPRESS_DB_CHARSET', 'utf8'));
/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', getenv_docker('WORDPRESS_DB_COLLATE', ''));
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
define('AUTH_KEY',             getenv_docker('WORDPRESS_AUTH_KEY',             '75880807637e416044fcd384cfa32495eeee3197'));
define('SECURE_AUTH_KEY',      getenv_docker('WORDPRESS_SECURE_AUTH_KEY',      '649e324f28451e271b95ddd7e476667e5b0b92ab'));
define('LOGGED_IN_KEY',        getenv_docker('WORDPRESS_LOGGED_IN_KEY',        '92459cda10083abcf94dddcb7fa3650968b150a4'));
define('NONCE_KEY',            getenv_docker('WORDPRESS_NONCE_KEY',            '90a419b29d618670cf8c4a527217cedee099b78a'));
define('AUTH_SALT',            getenv_docker('WORDPRESS_AUTH_SALT',            '0cd8d1ad8bfb4b819605f0c73df632385258ec49'));
define('SECURE_AUTH_SALT',     getenv_docker('WORDPRESS_SECURE_AUTH_SALT',     '2e38820a9aace6b893cbbf073d524b558db3c2e9'));
define('LOGGED_IN_SALT',       getenv_docker('WORDPRESS_LOGGED_IN_SALT',       '4cc74a1f665a28f0a885477509f7e3dca400b6ea'));
define('NONCE_SALT',           getenv_docker('WORDPRESS_NONCE_SALT',           '6377c4cd294d916f2b81887aec4f859b15d9b749'));
define('MEMCACHED_HOST',       getenv_docker('MEMCACHED_HOST',                 'host.docker.internal'));
define('MEMCACHED_PORT',       getenv_docker('MEMCACHED_PORT',                 '11211'));
define('MEMCACHED_SALT',       getenv_docker('MEMCACHED_SALT', 'vasakos-gr-'));
define('USE_HTTPS',            getenv_docker('USE_HTTPS',                      'on'));


define('DISABLE_WP_CRON', getenv_docker('WORDPRESS_DISABLE_CRON', 'false'));
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', getenv_docker('WORDPRESS_DISABLE_UPDATES', 'false'));

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY',true);

// (See also https://wordpress.stackexchange.com/a/152905/199287)
/**#@-*/
/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv_docker('WORDPRESS_TABLE_PREFIX', 'wp_');
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

//define('FORCE_SSL_ADMIN', false);

$memcachedServerAddress = MEMCACHED_HOST . ":" . MEMCACHED_PORT;

$memcached_servers = array(
        'default' => array(
                $memcachedServerAddress
        )
);

/* Add any custom values between this line and the "stop editing" line. */
// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy

$_SERVER['HTTPS'] = USE_HTTPS;

// (we include this by default because reverse proxying is extremely common in container environments)
if ($configExtra = getenv_docker('WORDPRESS_CONFIG_EXTRA', '')) {
        eval($configExtra);
}
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
        define('ABSPATH', __DIR__ . '/');
}
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
