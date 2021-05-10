<?php

declare(strict_types = 1);

/**
 * Classe contenant des méthodes static pour gérer et récupérer des informations du fichier de configuration.
 * @brief Classe contenant des méthodes static pour gérer et récupérer des informations du fichier de configuration
 * @author Alexandre Pierret
 * @version 1.0
 */
class Configuration
{
    private static ?array $file = null;

    /**
     * Cette méthode static charge le fichier de configuration (sous format json).
     * @param string $path Le chemin du fichier de coonfiguration.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function loadConfiguration(string $path)
    {
        if(file_exists($path)) 
        {
            Configuration::$file = json_decode(file_get_contents($path), true);
            if(Configuration::getConfiguration("show-error") == "yes")
            {
                ini_set("display_startup_errors", "1");
                ini_set("display_errors", "1");
                error_reporting(E_ALL);
            }
        }
    }

    /**
     * Cette méthode static récupère la valuer d'une configuration.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function getConfiguration(string $name) : string
    {
        return Configuration::$file[$name];
    }
}