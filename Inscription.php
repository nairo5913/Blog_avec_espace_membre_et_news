<?php
/******************************************************************************
 * Nom :       Inscription.php
 * Projet :    Mon site de blog et de news
 * Objectif :  Page d'inscription
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
        <title>Blog - Inscription</title>
    </head>
    <body>
        <?php require('./Style/En_tete.php');
        require("./Style/Navigation.php");
        $date_actuelle = getdate();
        $annee_actuelle = (int) $date_actuelle['year'];
        $jour_actuel = (int) $date_actuelle['mday'];
        $mois_actuel = (int) $date_actuelle['mon'];
        ?>
        <section>
            <article>
                <h1>Inscription</h1>
                <form action="Inscription_post.php" method="post" accept-charset="utf-8">
                    <fieldset>
                        <legend>Identitée</legend>
                        <label for="nom">Votre nom* :
                            <input type="text" name="nom" id="nom" placeholder="Ex : Valjean" maxlength="50" minlength="2" pattern="[^0-9\$+&~#\.\{\}\\/\(\)\[\]\|@]{2,50}" required >
                        </label>
                        <br><br>

                        <label for="prenom">Votre prénom* :
                            <input type="text" name="prenom" id="prenom" placeholder="Ex : Jean" maxlength="50" minlength="2" pattern="[^0-9\$+&~#\.\{\}\\/\(\)\[\]\|@]{2,50}" required>
                        </label>
                        <br><br>

                        <label for="date_naissance">Votre date de naissance* :
                            <input type="date" name="date_naissance" id="date_naissance" min="1900-01-01" required>
                        </label>
                        <br><br>

                        <label for="telephone_portable">Votre téléphone portable :
                            <input type="tel" name="telephone_portable" id="telephone_portable" maxlength="10" placeholder="Ex : 0611223344" pattern="^0[6-7]([-. ]?[0-9]{2}){4}$">
                        </label>
                        <br><br>

                        <label for="telephone_fixe">Votre téléphone fixe :
                            <input type="tel" name="telephone_fixe" id="telephone_fixe" maxlength="10" placeholder="Ex : 0311223344" pattern="^0[1-58-9]([-. ]?[0-9]{2}){4}$">
                        </label>
                        <br><br>

                    </fieldset>
                    <fieldset>
                        <legend>Création du compte</legend>
                        <label for="pseudo">Votre pseudo* :
                            <input type="text" name="pseudo" id="pseudo" placeholder="Ex : azertyuiop" maxlength="50" minlength="3" pattern="[A-Za-z0-9]{3,50}" required>
                        </label>
                        <br><br>

                        <label for="email">Votre email* :
                            <input type="email" name="email" id="email" placeholder="Ex : exemple@domaine.fr" pattern="^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$" required>
                        </label>
                        <br><br>

                        <label for="pass">Votre mot de passe* :
                            <input type="password" name="pass" id="pass" required>
                        </label>
                        <br><br>

                        <label for="confirm_pass">Confirmer votre mot de passe* :
                            <input type="password" name="confirm_pass" id="confirm_pass" required>
                        </label>
                        <br><br>

                    </fieldset>
                    <fieldset>
                        <legend>Validation</legend>
                        <label for="legende">* : champs obligatoire.
                            <input type="text" name="legende" id="legende" placeholder="Exemple de champ obligatoire" required disabled>
                        </label>
                    <?php
                        if (isset($_SESSION['erreur_inscription']))
                        {
                            if ($_SESSION['erreur_inscription'] != '')
                            { ?>
                                <div id="erreur" class="erreur">
                                    <h2>Erreur</h2>
                                    <?php echo $_SESSION['erreur_inscription']; ?>
                                <div>
                            <?php }
                        }
                    ?>
                        <br>
                        <input type="submit" name="envoyer" value="Envoyer">
                        <input type="reset" name="reinitialiser" value="Vider les champs">
                    </fieldset>
                </form>
            </article>
        </section>
        <?php require('./Style/Pied_de_page.php'); ?>
    </body>
</html>