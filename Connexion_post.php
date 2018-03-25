<?php
/******************************************************************************
 * Nom :       Connexion_post.php
 * Projet :    Mon site de blog et de news
 * Objectif :  Page de traitement des connexions
 * Créé le :   24/02/2018
 * Auteur :    nairo5913
******************************************************************************/
session_start();
include("./Scripts/connection_bdd.php");

if (isset($_POST['pseudo']) AND isset($_POST['pass']))
{
//// Variable ////
    /// Session
    $_SESSION['erreur_connexion'] = '';
    $_SESSION['pseudo'] = '';
    //$_SESSION[''] = '';
    /// Formulaire (post)
    $pseudo = strip_tags($_POST['pseudo']);
    $pass = htmlspecialchars($_POST['pass']);
    /// Test
    $chaine = '';
    $erreur = false;

/// Récupération des données dans la bdd ///
    $sql = "SELECT id, pass, id_groupe FROM Membres WHERE pseudo = :pseudo";
    $req = $bdd->prepare($sql);
    $req->execute(array(
        'pseudo' => $pseudo));

    $donnees = $req->fetch();

//// Vérification ////
    if ($donnees)
    {
        if (!password_verify($pass, $donnees['pass']))
        {
            $chaine = $chaine . "Mot de passe invalide.<br>";
            $erreur = true;
        }
    }
    else
    {
        $chaine = $chaine . "Ce pseudo n'existe pas.<br>";
        $erreur = true;
    }
    $id = $donnees['id'];
    $groupe = $donnees['id_groupe'];
    $req->closeCursor();

    /// Si il y a des erreur ou pas
    if ($erreur)
    {
        $_SESSION['erreur_connexion'] = $chaine;
        header("Location: Connexion.php");
    }
    else
    {
//// Connexion auto ////
        if (isset($_POST['connection_auto']))
        {
            echo "coché";
            // cookies
        }
        else
        {
            if (isset($_GET['page'])) {
                if ($_GET['page'] == 'espace_perso')
                {
                    $_SESSION['id'] = $id;
                    $_SESSION['pseudo'] = $pseudo;
                    $_SESSION['groupe'] = $groupe;
                    $_SESSION['erreur_connexion'] = '';
                    //echo "Vous êtes connecté !";
                    header("Location: Espace_personnel.php");
                }
                else
                {
                    $_SESSION['id'] = $id;
                    $_SESSION['pseudo'] = $pseudo;
                    $_SESSION['groupe'] = $groupe;
                    $_SESSION['erreur_connexion'] = '';
                    //echo "Vous êtes connecté !";
                    header("Location: Acceuil.php");
                }

            } else
            {
                $_SESSION['id'] = $id;
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['groupe'] = $groupe;
                $_SESSION['erreur_connexion'] = '';
                //echo "Vous êtes connecté !";
                header("Location: Acceuil.php");
            }
        }
    }


}
else
{
    $_SESSION['erreur_connexion'] = "Erreur avec l'un des champs! <br>";
    header("Location: Connexion.php");
}

?>