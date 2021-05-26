<?php

declare(strict_types = 1);

require_once("../php/utils/Configuration.php");
Configuration::loadConfiguration("../../configuration.json");
require_once("../php/users/Admin.php");

if(Admin::isConnected())
{
    echo(<<<HTML
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <title>Connexion</title>
                <style>
                    body { display: flex; justify-content: center; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; background-color: rgb(0, 0, 50);}
                    input { margin: 20px; height: 30px; background-color: lightgray; border: none; border-radius: 5px; width: 100%;}
                    .title { margin: 20px; font-size: 24px; font-weight: bold; color: white;}
                    form { display: flex; flex-direction: column; margin: 20px;}
                    .submit:hover { cursor: pointer }
                </style>
            </head>
            <body>
                <form action="../scripts/regenerate_password.php" method="post">
                    <div class="title">Connexion</div><br>
                    <input name="login" type="text" placeholder="Identifiant" required>
                    <input name="password" type="password" placeholder="Mot de passe" required>
                    <input name="new_password" type="password" placeholder="Nouveau mot de passe" required>
                    <input class="submit" type="submit" value="Connexion">
                </form>
            </body>
        </html>
    HTML);
} else {
    header("Location: ../index.php");
}

