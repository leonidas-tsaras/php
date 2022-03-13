<?php

class CNLF_Autoloader {

    private static $_instance = null;

    private function __construct() {
        spl_autoload_register(array($this, 'load'));
    }

    public static function _instance() {
        if (!self::$_instance) {
            self::$_instance = new CNLF_Autoloader();
        }
        return self::$_instance;
    }

    // register autoloading
    public function load($class_name) {
        $root = dirname(__FILE__);
        $dirs = ["admin", "user"];
        foreach($dirs as $dir) {
            $file = $root . '/' . $dir . '/' . $class_name . '.class.php';
            if(file_exists($file)) {
                require_once($file);
                return;
            }
        }
    });
}

CNLF_Autoloader::_instance();