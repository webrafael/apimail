<?php

namespace Mail\Config;

use Symfony\Component\Dotenv\Dotenv;

class Configuration
{
    
    /**
     * $path
     *
     * @var string
     * @access public
     */
    static public $path;

    /**
     * getDir()
     *
     * @return void
     * @access protected
     */
    static protected function getDir()
    {
        $file       = file_exists(dirname(__DIR__, 6).'/.env');
        self::$path = (!is_null(self::$path)) ? self::$path : $file;
        return self::$path;
    }

    /**
     * get
     * 
     * @package Symfony\Component\Dotenv\Dotenv::class
     * @param   string $name
     * @return  string
     */
    static public function get(string $name = null)
    {
        $config = new Dotenv();
        $config->load(self::getDir());

        return getenv($name);
    }
}