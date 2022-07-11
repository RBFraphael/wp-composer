<?php
use RBFraphael\WPComposer\WPConfig;

WPConfig::set("WP_DEBUG", true);
WPConfig::set("WP_DEBUG_DISPLAY", true);
WPConfig::set("WP_DEBUG_LOG", true);
WPConfig::set("SCRIPT_DEBUG", true);
WPConfig::set("WP_CACHE", false);
ini_set("display_errors", "1");