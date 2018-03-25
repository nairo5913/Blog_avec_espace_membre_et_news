<?php
/******************************************************************************
 * Nom :       Connexion.php
 * Projet :    Mon site de blog et de news
 * Objectif :  Page de connexion
 * Créé le :   24/02/2018
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
        <link rel="stylesheet" type="text/css" href="Style/Style_en_tete.css">
        <link rel="stylesheet" type="text/css" href="Style/Style_navigation.css">
        <link rel="stylesheet" type="text/css" href="Style/Style_general.css">
        <link rel="stylesheet" type="text/css" href="Style/Style_pied_de_page.css">
        <link rel="stylesheet" type="text/css" href="Style/Style_formulaire.css">
        <link rel="shortcut icon" href="Style/Images/favicon.ico" >
        <link rel="icon" type="image/gif" href="Style/Images/animated_favicon1.gif" >
        <title>Blog - Connexion</title>
    </head>
    <body>
        <?php require('./Style/En_tete.php');
        require("./Style/Navigation.php"); ?>
        <section>
            <article>
                <h1>Connexion</h1>
                <?php if (isset($_GET['page']))
                {
                    if ($_GET['page'] == 'espace_perso')
                    { ?>
                        <form action="Connexion_post.php?page=espace_perso" method="post" accept-charset="utf-8">
                    <?php }
                    else
                    { ?>
                        <form action="Connexion_post.php" method="post" accept-charset="utf-8">
                    <?php }
                }
                else
                { ?>
                    <form action="Connexion_post.php" method="post" accept-charset="utf-8">
                <?php } ?>

                    <fieldset>
                        <legend>Connexion</legend>
                        <label for="pseudo">Pseudo : <input type="text" name="pseudo" id="pseudo" placeholder="Indentifiant" required autofocus></label>
                        <br><br>

                        <label>Mot de passe : <input type="password" name="pass" id="pass" placeholder="Mot de passes" required></label>
                        <br><br>

                        <label>Connexion automatique : <input type="checkbox" name="connection_auto" id="connection_auto"></label>
                        <br>
                    <?php
                        if (isset($_SESSION['erreur_connexion']))
                        {
                            if ($_SESSION['erreur_connexion'] != '')
                            { ?>
                                <div id="erreur" class="erreur">
                                    <p>
                                        <h2>Erreur</h2>
                                        <?php echo $_SESSION['erreur_connexion']; ?>
                                    </p>
                                </div>
                            <?php }
                        } ?>
                        <br>
                        <input type="submit" name="connexion" value="Se connecter">
                    </fieldset>
                </form>
            </article>
        </section>
        <?php require('./Style/Pied_de_page.php'); ?>
    </body>
</html>