<?php
/******************************************************************************
 * Nom :       Inscription_post.php
 * Projet :    Mon site de blog et de news
 * Objectif :  Page de traitement des inscriptions
 * Créé le :   24/02/2018
 * Auteur :    nairo5913
******************************************************************************/
session_start();
include './Scripts/connection_bdd.php';

if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['date_naissance']) AND isset($_POST['pseudo']) AND isset($_POST['email']) AND isset($_POST['pass']))
{
//// Variable ////
    /// Session
    $_SESSION['erreur_inscription'] = "";
    /// Formulaire (post)
    $confirm_pass = htmlspecialchars($_POST['confirm_pass']);
    $date_naissance = strip_tags($_POST['date_naissance']);
    $email = strip_tags($_POST['email']);
    $nom = strip_tags($_POST['nom']);
    $pass = htmlspecialchars($_POST['pass']);
    $prenom = strip_tags($_POST['prenom']);
    $pseudo = strip_tags($_POST['pseudo']);
    /// Date
    $date_actuelle = getdate();
    $annee_actuelle = (int) $date_actuelle['year'];
    $jour_actuel = (int) $date_actuelle['mday'];
    $mois_actuel = (int) $date_actuelle['mon'];
    // Téléphone
    $telephone_fixe_cree = false;
    $telephone_portable_cree = false;
    /// Test
    $chaine = '';
    $erreur = false;


//// Test ////
    /// Nom ///
    /*if (preg_match("#[^0-9]#", $nom))
    {
        $chaine = $chaine . "Nom invalide <br>";
        $erreur = true;
    }

    /// Prénom ///
    if (preg_match("#[a-zA-Z -]#", $prenom))
    {
        echo "ok";
    }
    else
    {
        $chaine = $chaine . "Prénom invalide <br>";
        $erreur = true;
    }*/

    /// Date de naissance ///
    // Année
    $annee = preg_replace('#([0-9]{4})(-[0-9]{2}){2}#', '$1', $date_naissance);
    $annee = (int) $annee;

    if (!(1900 <= $annee AND $annee <= $annee_actuelle))
    {// Si l'année n'est pas comprise dans l'intervalle affichage du message d'erreur
        $chaine = $chaine . 'Année invalide. L\'année doit etre comprise entre 1900 et ' . $annee_actuelle . '.<br>';
        $erreur = true;
    }

    $mois = preg_replace('#([0-9]{4})-([0-9]){2}-([0-9]){2}#', '$2', $date_naissance);

    if (!(1 <= $mois AND $mois <=12))
    {
        $chaine = $chaine . 'Mois invalide. Le mois doit etre comprise entre 01 et 12 <br>';
        $erreur = true;
    }
    else
    {// Si les mois sont bon on verifie si l'année selectionner correspond à l'année en cours et si le mois et bien passé
        if ($annee == $annee_actuelle AND $mois > $mois_actuel)
        {
            $chaine = $chaine . 'Mois invalide. Le mois sélectionné n\'est pas encore passé dans l\'année en cours.<br>';
            $erreur = true;
        }
    }

    //$jour = preg_replace();

    /// Pseudo ///
    // Requete sql
    $sql = "SELECT id FROM Membres WHERE pseudo = :pseudo";
    $req = $bdd->prepare($sql);
    $req->execute(array(
        'pseudo' => $pseudo));

    $donnees = $req->fetch();

    if ($donnees)
    {
        $chaine = $chaine . 'Ce pseudo existe déja.<br>';
        $erreur = true;
    }
    $req->closeCursor();

    /// Email ///
    if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
    {
        $chaine = $chaine . 'Email invalide <br>';
        $erreur = true;
    }

    /// Téléphone portable ///
    if (isset($_POST['telephone_portable']))
    {// Si le téléphone existe on teste ce qu'il contient
        $telephone_portable = htmlspecialchars($_POST['telephone_portable']);
        // Test du format
        if (preg_match("#^0[6-7]([-. ]?[0-9]{2}){4}$#", $telephone_portable))
        {
            // Remplacement des  " " "." "-"
            $telephone_portable = (int) $telephone_portable;
            // Ajout du 0
            $telephone_portable = "0$telephone_portable";
            $telephone_portable_cree = true;
        }
        elseif ($telephone_portable == '')
        {// Si téléphone ne contien rien
            //echo "rien";
            $telephone_portable = '';
        }
        else
        {// Erreur
            $chaine = $chaine . 'Téléphone portable invalide <br>';
            $erreur = true;
        }
    }
    else
    {
        $telephone_portable = '';
    }

    /// Téléphone fixe ///
    if (isset($_POST['telephone_fixe']))
    {// Si le téléphone existe on teste ce qu'il contient
        $telephone_fixe = htmlspecialchars($_POST['telephone_fixe']);
        // Test du format
        if (preg_match("#^0[1-58]([-. ]?[0-9]{2}){4}$#", $telephone_fixe))
        {
            // Remplacement des  " " "." "-"
            $telephone_fixe = (int) $telephone_fixe;
            // Ajout du 0
            $telephone_fixe = "0$telephone_fixe";
            $telephone_fixe_cree = true;
        }
        elseif ($telephone_fixe == '')
        {// Si téléphone ne contien rien
            //echo "rien";
            $telephone_fixe = '';
        }
        else
        {// Erreur
            $chaine = $chaine . 'Téléphone fixe invalide <br>';
            $erreur = true;
        }
    }
    else
    {
        $telephone = '';
    }

    /// Mot de passe ///
    if ($pass == $confirm_pass)
    {
        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    }
    else
    {
        $chaine = $chaine . "Les mots de passe sont différents <br>";
        $erreur = true;
    }

    if ($erreur)
    {// Si il y a une erreur on redirige vers la page d'inscription et on envoi l'erreur
        $_SESSION['erreur_inscription'] = $chaine;
        header("Location: Inscription.php");
    }
    else
    {// Sinon on ajoute les donnéers dans la base de données puis on redirige vers la page d'acceuil
        // Ajout des données dans la base de données
        $sql = "INSERT INTO Membres(pseudo, mail, pass, nom, prenom, date_naissance) VALUE (:pseudo, :mail, :pass, :nom, :prenom, :date_naissance)";
        $req = $bdd->prepare($sql);
        $req->execute(array(
            'pseudo' => $pseudo,
            'mail' => $email,
            'pass' => $pass_hache,
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $date_naissance));
        $req->closeCursor();

        $sql = "SELECT id FROM Membres WHERE pseudo = :pseudo";
        $req = $bdd->prepare($sql);
        $req->execute(array(
            'pseudo' => $pseudo));

        $donnees = $req->fetch();
        $id = $donnees['id'];
        $req->closeCursor();

        // Insertion téléphone fixe
        if ($telephone_fixe_cree)
        {// Si le telephone fixe est créé on l'insert dans la bdd
            $sql = "UPDATE Membres SET telephone_fixe = :nvtelephone_fixe WHERE id = :id";
            $req = $bdd->prepare($sql);
            $req->execute(array(
                'nvtelephone_fixe' => $telephone_fixe,
                'id' => $id));
            $req->closeCursor();
        }

        // Insertion téléphone portable
        if ($telephone_portable_cree)
        {// Si le telephone portable est créé on l'insert dans la bdd
            $sql = "UPDATE Membres SET telephone_portable = :nvtelephone_portable WHERE id = :id";
            $req = $bdd->prepare($sql);
            $req->execute(array(
                'nvtelephone_portable' => $telephone_portable,
                'id' => $id));
            $req->closeCursor();
        }


        $_SESSION['erreur_inscription'] = '';
        header("Location: Connexion.php");
    }

}
else
{
    $_SESSION['erreur_inscription'] = "Erreur avec l'un des champs! <br>";
    header("Location: Inscription.php");
}

?>