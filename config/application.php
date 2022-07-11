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

/**
 * URLs
 */
WPConfig::set("WP_HOME", env("WP_HOME"));
WPConfig::set("WP_SITEURL", env("WP_SITEURL"));
WPConfig::set("COOKIE_DOMAIN", env("COOKIE_DOMAIN") ?? parse_url(WPConfig::get("WP_HOME"), PHP_URL_HOST));

/**
 * Custom content directory
 */
WPConfig::set("CONTENT_DIR", "/app");
WPConfig::set("WP_CONTENT_DIR", $webroot.WPConfig::get("CONTENT_DIR"));
WPConfig::set("WP_CONTENT_URL", WPConfig::get("WP_HOME").WPConfig::get("CONTENT_DIR"));

/**
 * Database settings
 */
WPConfig::set("DB_NAME", env("DB_NAME"));
WPConfig::set("DB_USER", env("DB_USER"));
WPConfig::set("DB_PASSWORD", env("DB_PASSWORD"));
WPConfig::set("DB_HOST", env("DB_HOST") ?? "localhost");
WPConfig::set("DB_CHARSET", env("DB_CHARSET") ?? "utf8mb4");
WPConfig::set("DB_COLLATE", env("DB_COLLATE") ?? "");
$table_prefix = env("DB_PREFIX") ?? "wp_";

/**
 * Authentication unique keys and salt
 */
WPConfig::set("AUTH_KEY", env("AUTH_KEY"));
WPConfig::set("SECURE_AUTH_KEY", env("SECURE_AUTH_KEY"));
WPConfig::set("LOGGED_IN_KEY", env("LOGGED_IN_KEY"));
WPConfig::set("NONCE_KEY", env("NONCE_KEY"));
WPConfig::set("AUTH_SALT", env("AUTH_SALT"));
WPConfig::set("SECURE_AUTH_SALT", env("SECURE_AUTH_SALT"));
WPConfig::set("LOGGED_IN_SALT", env("LOGGED_IN_SALT"));
WPConfig::set("NONCE_SALT", env("NONCE_SALT"));


/**
 * Custom settings
 */
WPConfig::set("AUTOMATIC_UPDATER_DISABLED", env("AUTOMATIC_UPDATER_DISABLED") ?? true);
WPConfig::set("DISABLE_WP_CRON", env("DISABLE_WP_CRON") ?? false);
WPConfig::set("DISALLOW_FILE_EDIT", env("DISALLOW_FILE_EDIT") ?? true);
WPConfig::set("DISALLOW_FILE_MODS", env("DISALLOW_FILE_MODS") ?? true);
WPConfig::set("WP_POST_REVISIONS", env("WP_POST_REVISIONS") ?? true);
WPConfig::set("WPLANG", env("WP_LANG") ?? "en_US");
WPConfig::set("WP_CACHE", env("WP_CACHE") ?? true);
WPConfig::set("WP_MEMORY_LIMIT", env("WP_MEMORY_LIMIT") ?? "64M");
WPConfig::set("WP_MAX_MEMORY_LIMIT", env("WP_MAX_MEMORY_LIMIT") ?? "128M");

/**
 * Debugging settings
 */
WPConfig::set("WP_DEBUG", env("WP_DEBUG") ?? false);
WPConfig::set("WP_DEBUG_DISPLAY", env("WP_DEBUG_DISPLAY") ?? false);
WPConfig::set("WP_DEBUG_LOG", env("WP_DEBUG_LOG") ?? false);
WPConfig::set("SCRIPT_DEBUG", env("SCRIPT_DEBUG") ?? false);
ini_set("display_errors", "0");

/**
 * Allow WordPress to detect HTTPS when used behind a reverse proxy or a load balancer
 * See https://codex.wordpress.org/Function_Reference/is_ssl#Notes
 */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

/**
 * Override previous settings with environment PHP script
 */
$env_config = dirname(__FILE__)."/environments/".WP_ENV.".php";
if(file_exists($env_config)){
    require_once($env_config);
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
