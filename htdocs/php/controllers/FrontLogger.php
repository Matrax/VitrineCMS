<?php

declare(strict_types = 1);

class FrontLogger
{
    /**
     * Cette fonction génère une page html pour afficher une erreur.
     * @param string $message Le message d'erreur à afficher.
     */
    public static function error(string $message)
    {
        echo(<<<HTML
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="refresh" content="2;URL=../index.php"> 
                    <title>Erreur</title>
                    <style>
                        body { margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; background-color: rgb(0, 0, 50);}
                        .message {margin: 50px; font-size: 24px; color: red;}
                        .sub-message {margin: 50px; font-size: 24px; color: white;}
                    </style>
                </head>
                <body>
                    <div class="message">{$message}</div>
                    <div class="sub-message">Vous allez être redirigé à la page d'accueil.</div>
                </body>
            </html>
        HTML);

        exit(1);
    }
};

