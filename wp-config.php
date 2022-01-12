<?php

require_once("local-config.php");

define("WP_CONTENT_DIR", dirname(__FILE__)."/content");
define("WP_CONTENT_URL", WP_HOME."/content");

/** Absolute path to the WordPress directory. */
if (!defined("ABSPATH") ) {
    define("ABSPATH", dirname(__FILE__)."/cms");
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH."wp-settings.php");
