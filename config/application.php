<?php
use RBFraphael\WPComposer\WPConfig;
use function Env\env;
require_once __DIR__."/inc/WPConfig.php";

/**
 * Project root
 */
$root = dirname(__DIR__);

/**
 * Website root (that your server - Apache, NGINX, etc - will point to)
 */
$webroot = $root . "/web";

/**
 * Use of .env and .env.local files to set WordPress constants
 * .env.local will override .env if it exists
 */
$env_files = file_exists($root."/.env.local") ? [".env", ".env.local"] : [".env"];
$dotenv = Dotenv\Dotenv::createUnsafeImmutable($root, $env_files, false);
if (file_exists($root."/.env")) {
    $dotenv->load();
    $required = [
        "WP_HOME", "WP_SITEURL", "DB_NAME", "DB_USER", "DB_PASSWORD", "AUTH_KEY", "SECURE_AUTH_KEY",
        "LOGGED_IN_KEY", "NONCE_KEY", "AUTH_SALT", "SECURE_AUTH_SALT", "LOGGED_IN_SALT", "NONCE_SALT"
    ];
    $dotenv->required($required);
}

/**
 * Set up our global environment constant and load its config first
 * Default: production
 */
define("WP_ENV", env("WP_ENV") ?? "production");
define("WP_ENVIRONMENT_TYPE", WP_ENV);
ini_set("display_errors", "0");

/**
 * Load environment PHP script
 */
$env_config = dirname(__FILE__)."/environments/".WP_ENV.".php";
if(file_exists($env_config)){
    require_once($env_config);
}

/**
 * URLs
 */
$WP_HOME = env("WP_HOME");
$WP_HOME = $WP_HOME == "auto" ? (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" : $WP_HOME;
if(!WPConfig::get("WP_HOME") == "") WPConfig::set("WP_HOME",$WP_HOME);
if(!WPConfig::get("WP_SITEURL") == "") WPConfig::set("WP_SITEURL", env("WP_SITEURL"));
if(!WPConfig::get("COOKIE_DOMAIN") == "") WPConfig::set("COOKIE_DOMAIN", env("COOKIE_DOMAIN") ?? parse_url(WPConfig::get("WP_HOME"), PHP_URL_HOST));

/**
 * Custom content directory
 */
if(!WPConfig::get("CONTENT_DIR") == "") WPConfig::set("CONTENT_DIR", "/app");
if(!WPConfig::get("WP_CONTENT_DIR") == "") WPConfig::set("WP_CONTENT_DIR", $webroot.WPConfig::get("CONTENT_DIR"));
if(!WPConfig::get("WP_CONTENT_URL") == "") WPConfig::set("WP_CONTENT_URL", WPConfig::get("WP_HOME").WPConfig::get("CONTENT_DIR"));

/**
 * Database settings
 */
if(!WPConfig::get("DB_NAME") == "") WPConfig::set("DB_NAME", env("DB_NAME"));
if(!WPConfig::get("DB_USER") == "") WPConfig::set("DB_USER", env("DB_USER"));
if(!WPConfig::get("DB_PASSWORD") == "") WPConfig::set("DB_PASSWORD", env("DB_PASSWORD"));
if(!WPConfig::get("DB_HOST") == "") WPConfig::set("DB_HOST", env("DB_HOST") ?? "localhost");
if(!WPConfig::get("DB_CHARSET") == "") WPConfig::set("DB_CHARSET", env("DB_CHARSET") ?? "utf8mb4");
if(!WPConfig::get("DB_COLLATE") == "") WPConfig::set("DB_COLLATE", env("DB_COLLATE") ?? "");
$table_prefix = env("DB_PREFIX") ?? "wp_";

/**
 * Authentication unique keys and salt
 */
if(!WPConfig::get("AUTH_KEY") == "") WPConfig::set("AUTH_KEY", env("AUTH_KEY"));
if(!WPConfig::get("SECURE_AUTH_KEY") == "") WPConfig::set("SECURE_AUTH_KEY", env("SECURE_AUTH_KEY"));
if(!WPConfig::get("LOGGED_IN_KEY") == "") WPConfig::set("LOGGED_IN_KEY", env("LOGGED_IN_KEY"));
if(!WPConfig::get("NONCE_KEY") == "") WPConfig::set("NONCE_KEY", env("NONCE_KEY"));
if(!WPConfig::get("AUTH_SALT") == "") WPConfig::set("AUTH_SALT", env("AUTH_SALT"));
if(!WPConfig::get("SECURE_AUTH_SALT") == "") WPConfig::set("SECURE_AUTH_SALT", env("SECURE_AUTH_SALT"));
if(!WPConfig::get("LOGGED_IN_SALT") == "") WPConfig::set("LOGGED_IN_SALT", env("LOGGED_IN_SALT"));
if(!WPConfig::get("NONCE_SALT") == "") WPConfig::set("NONCE_SALT", env("NONCE_SALT"));


/**
 * Custom settings
 */
if(!WPConfig::get("AUTOMATIC_UPDATER_DISABLED") == "") WPConfig::set("AUTOMATIC_UPDATER_DISABLED", env("AUTOMATIC_UPDATER_DISABLED") ?? true);
if(!WPConfig::get("DISABLE_WP_CRON") == "") WPConfig::set("DISABLE_WP_CRON", env("DISABLE_WP_CRON") ?? false);
if(!WPConfig::get("DISALLOW_FILE_EDIT") == "") WPConfig::set("DISALLOW_FILE_EDIT", env("DISALLOW_FILE_EDIT") ?? true);
if(!WPConfig::get("DISALLOW_FILE_MODS") == "") WPConfig::set("DISALLOW_FILE_MODS", env("DISALLOW_FILE_MODS") ?? true);
if(!WPConfig::get("WP_POST_REVISIONS") == "") WPConfig::set("WP_POST_REVISIONS", env("WP_POST_REVISIONS") ?? true);
if(!WPConfig::get("WPLANG") == "") WPConfig::set("WPLANG", env("WP_LANG") ?? "en_US");
if(!WPConfig::get("WP_CACHE") == "") WPConfig::set("WP_CACHE", env("WP_CACHE") ?? true);
if(!WPConfig::get("WP_MEMORY_LIMIT") == "") WPConfig::set("WP_MEMORY_LIMIT", env("WP_MEMORY_LIMIT") ?? "64M");
if(!WPConfig::get("WP_MAX_MEMORY_LIMIT") == "") WPConfig::set("WP_MAX_MEMORY_LIMIT", env("WP_MAX_MEMORY_LIMIT") ?? "128M");

/**
 * Debugging settings
 */
if(!WPConfig::get("WP_DEBUG") == "") WPConfig::set("WP_DEBUG", env("WP_DEBUG") ?? false);
if(!WPConfig::get("WP_DEBUG_DISPLAY") == "") WPConfig::set("WP_DEBUG_DISPLAY", env("WP_DEBUG_DISPLAY") ?? false);
if(!WPConfig::get("WP_DEBUG_LOG") == "") WPConfig::set("WP_DEBUG_LOG", env("WP_DEBUG_LOG") ?? false);
if(!WPConfig::get("SCRIPT_DEBUG") == "") WPConfig::set("SCRIPT_DEBUG", env("SCRIPT_DEBUG") ?? false);

/**
 * Allow WordPress to detect HTTPS when used behind a reverse proxy or a load balancer
 * See https://codex.wordpress.org/Function_Reference/is_ssl#Notes
 */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

/**
 * Apply all settings
 */
WPConfig::apply();

/**
 * Bootstrap WordPress
 */
if(!defined("ABSPATH")){
    define("ABSPATH", $webroot . "/cms/");
}
