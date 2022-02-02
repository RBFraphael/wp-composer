<?php
/* Database settings */
define("DB_NAME", "database");
define("DB_USER", "db_user");
define("DB_PASSWORD", "db_password");
define("DB_HOST", "db_host");
define("DB_CHARSET", "utf8");

$table_prefix = "wp_";

/* WordPress URL. */
define("WP_HOME", "http://localhost.com");

/**
 * Authentication unique keys and salts.
 * {@link https://api.wordpress.org/secret-key/1.1/salt/.
 */
define("AUTH_KEY", "put your unique phrase here");
define("SECURE_AUTH_KEY", "put your unique phrase here");
define("LOGGED_IN_KEY", "put your unique phrase here");
define("NONCE_KEY", "put your unique phrase here");
define("AUTH_SALT", "put your unique phrase here");
define("SECURE_AUTH_SALT", "put your unique phrase here");
define("LOGGED_IN_SALT", "put your unique phrase here");
define("NONCE_SALT", "put your unique phrase here");

/* Misc */
define("WP_DEBUG", false);
