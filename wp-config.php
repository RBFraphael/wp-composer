<?php

require_once("local-config.php");

define("WP_SITEURL", WP_HOME."/cms" );
define("WP_CONTENT_DIR", dirname(__FILE__)."/content");
define("WP_CONTENT_URL", WP_HOME."/content");

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
