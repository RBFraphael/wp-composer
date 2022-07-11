<?php
use RBFraphael\WPComposer\WPConfig;

WPConfig::set("WP_DEBUG", false);
WPConfig::set("WP_DEBUG_DISPLAY", false);
WPConfig::set("WP_DEBUG_LOG", false);
WPConfig::set("SCRIPT_DEBUG", false);
WPConfig::set("WP_CACHE", true);
ini_set("display_errors", "0");