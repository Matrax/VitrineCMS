<?php

declare(strict_types = 1);

/**
 * Classe représentant l'administrateur de la page web.
 * Cette classe permet de gérer la connexion de l'utilisateur en tant que adminstrateur
 * à l'aide de plusieurs méthodes static.
 * @brief Classe représentant l'administrateur de la page web
 * @author Alexandre Pierret
 * @version 1.0
 */
class Admin
{

    /**
     * Cette méthode static connecte l'administrateur en lui donnant
     * un cookie de session et avant tout en vérifiant
     * si ses informations pour se connecter données en paramètre sont
     * valides (login et mot de passe) à l'aide du fichier de configuration.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function connectSession(string $login, string $password)
    {
        $goodLogin = Configuration::getConfiguration("login");
        $goodPassword = Configuration::getConfiguration("password");

        if(htmlentities($login) == htmlentities($goodLogin)
        && htmlentities($password) == htmlentities($goodPassword))
        {
            Admin::loadSession();
            $_SESSION["login"] = htmlentities($login);
            $_SESSION["password"] = htmlentities($password);
        }
    }

    /**
     * Cette méthode static permet de vérifier si l'utilisateur est connecté en tant qu'administrateur.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function isConnected() : bool
    {
        Admin::loadSession();
        $goodLogin = Configuration::getConfiguration("login");
        $goodPassword = Configuration::getConfiguration("password");
        if(isset($_SESSION) == true && isset($_SESSION["login"]) == true && isset($_SESSION["password"]) == true)
        {
            if(htmlentities($_SESSION["login"]) == htmlentities($goodLogin)
            && htmlentities($_SESSION["password"]) == htmlentities($goodPassword))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Cette méthode static déconnecte l'administrateur en supprimant le cookie de session associé.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function disconnectSession()
    {
        session_set_cookie_params(0);
        session_unset();
        session_destroy();
    }

    /**
     * Cette méthode static charge la session.
     * @author Alexandre Pierret
     * @version 1.0
     */
    public static function loadSession()
    {
        if(isset($_SESSION) == false) session_start();
    }

}