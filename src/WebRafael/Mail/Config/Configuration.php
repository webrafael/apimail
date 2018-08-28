<?php

namespace Mail\Config;

use Symfony\Component\Dotenv\Dotenv;

class Configuration
{
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
        $config->load(dirname(__DIR__, 6).'/.env');

        return getenv($name);
    }
}