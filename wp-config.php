<?php

require_once("local-config.php");

define("WP_SITEURL", WP_HOME."/cms" );
define("WP_CONTENT_DIR", dirname(__FILE__)."/content");
define("WP_CONTENT_URL", WP_HOME."/content");

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

/** Absolute path to the WordPress directory. */
if (!defined("ABSPATH") ) {
    define("ABSPATH", dirname(__FILE__)."/cms");
}

/** Disable automatic updates */
define("WP_AUTO_UPDATE_CORE", false);
define("DISALLOW_FILE_MODS", true);

/** Disable plugin/theme files editing */
define("DISALLOW_FILE_EDIT", true);

/** Sets up WordPress vars and included files. */
require_once(ABSPATH."wp-settings.php");
