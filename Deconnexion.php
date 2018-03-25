<?php
/******************************************************************************
 * Nom :       Deconnexion.php
 * Projet :    Mon site de blog et de news
 * Objectif :  Page de déconnexion
 * Créé le :   24/02/2018
 * Auteur :    nairo5913
******************************************************************************/
//include("./Scripts/connection_bdd.php");

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="nairo5913" />
        <meta name="description" content="Blog avec commentaires et espace membre" />*
        <link rel="stylesheet" type="text/css" href="Style/Style_en_tete.css">
        <link rel="stylesheet" type="text/css" href="Style/Style_navigation.css">
        <link rel="stylesheet" type="text/css" href="Style/Style_pied_de_page.css">
        <link rel="stylesheet" type="text/css" href="Style/Style_general.css">
        <link rel="stylesheet" type="text/css" href="Style/Style_formulaire.css">
        <link rel="shortcut icon" href="Style/Images/favicon.ico" >
        <link rel="icon" type="image/gif" href="Style/Images/animated_favicon1.gif" >
        <title>Blog - Déconnexion</title>
    </head>
    <body>
        <?php require('./Style/En_tete.php');
        require("./Style/Navigation.php"); ?>
        <section>
            <article>
            <?php
                session_start();

                // Suppression des variables de session et de la session
                $_SESSION = array();
                session_destroy();

                // Suppression des cookies de connexion automatique
                //setcookie('login', '');
                //setcookie('pass_hache', '');
            ?>
                <p id="deconnexion_succes" class="deconnexion_succes">
                    Déconnecter avec succès ! <br>
                    <br>
                    Merci de votre visite et à bientot !
                </p>
            </article>
        </section>
        <?php require('./Style/Pied_de_page.php'); ?>
    </body>
</html>