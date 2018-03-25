<?php
/******************************************************************************
 * Nom :       Acceuil_blog.php
 * Projet :    TP : créer un espace membres
 * Objectif :  Acceuil de l'espace blog
 * Créé le :   01/01/2018
 * Auteur :    nairo5913
******************************************************************************/
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="nairo5913" />
        <meta name="description" content="Blog avec commentaires et espace membre" />
        <link rel="stylesheet" type="text/css" href="../Style/Style_en_tete.css">
        <link rel="stylesheet" type="text/css" href="../Style/Style_navigation.css">
        <link rel="stylesheet" type="text/css" href="../Style/Style_general.css">
        <link rel="stylesheet" type="text/css" href="../Style/Style_pied_de_page.css">
        <link rel="stylesheet" type="text/css" href="../Style/Style_formulaire.css">
        <link rel="shortcut icon" href="../Style/Images/favicon.ico" >
        <link rel="icon" type="image/gif" href="../Style/Images/animated_favicon1.gif" >
        <title>Blog - Accueil</title>
    </head>
    <body>
        <?php require('../Style/En_tete.php');
        require("../Style/Navigation.php"); ?>
        <section>
            <article>
                <h1></h1>
                <p>

                </p>
            </article>
        </section>
        <?php require('../Style/Pied_de_page.php'); ?>
    </body>
</html>