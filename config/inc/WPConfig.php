<?php

namespace RBFraphael\WPComposer
{
    class WPConfig
    {
        private static $settings = [];

        public static function set($key, $value)
        {
            $key = strtoupper(trim($key));
            self::$settings[$key] = $value;
        }

        public static function get($key, $default = "")
        {
            $key = strtoupper(trim($key));
            return self::$settings[$key] ?? $default;
        }

        public static function apply()
        {
            foreach(self::$settings as $key => $value){
                if(self::is_defined($key)){
                    die("Config ".$key." already defined in another location as ".self::get($key));
                }
                self::define($key, $value);
            }
        }

        public static function debug()
        {
            var_dump(self::$settings);
            die();
        }

        private static function is_defined($key)
        {
            $key = strtoupper(trim($key));
            return defined($key);
        }

        private static function define($key, $value)
        {
            $key = strtoupper(trim($key));
            define($key, $value);
        }
    }
}
