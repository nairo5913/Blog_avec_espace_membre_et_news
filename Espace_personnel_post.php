<?php
/******************************************************************************
 * Nom :       Espace_personnel_post.php
 * Projet :    Mon site de blog et de news
 * Objectif :  Page de traitement de l'espace personnel
 * Créé le :   24/02/2018
 * Auteur :    nairo5913
******************************************************************************/
session_start();
include("./Scripts/connection_bdd.php");
$_SESSION['erreur_espace_personnel'] = "";

if (isset($_POST['section']))
{
    $section = strip_tags($_POST['section']);
    $id = $_SESSION['id'];
    $pseudo = $_SESSION['pseudo'];
    $chaine = '';
    $erreur = false;


    switch ($section)
    {
        case 'identitee':
            //// Téléphone portable ////
            if (isset($_POST['telephone_portable']))
            {
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

            //// Téléphone fixe ////
            if (isset($_POST['telephone_fixe']))
            {
                $telephone_fixe = htmlspecialchars($_POST['telephone_fixe']);
                // Test du format
                if (preg_match("#^0[1-58-9]([-. ]?[0-9]{2}){4}$#", $telephone_fixe))
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

            //// Date de naissance ////
            if (isset($_POST['date_naissance']))
            {
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
            }
            else
            {
                $chaine = "Probleme avec le champ date de naissance. <br>";
            }

            //// Erreur ////
            if ($erreur)
            {
                $_SESSION['erreur_espace_personnel'] = $chaine;
                header("Location: ./Espace_personnel.php?section=identitee");
            }
            else
            {
                // afficher ok puis redirection vers espace perso
            }

            break;

        case 'compte':

            //// Mot de passe ////
            if (isset($_POST['pass_actuel']) AND isset($_POST['nouveau_pass']) AND isset($_POST['pass_confirmation']))
            {
                    $sql = "SELECT pass FROM Membres WHERE id = :id";
                    $req = $bdd->prepare($sql);
                    $req->execute(array(
                        'id' => $id));

                    $donnees = $req->fetch();

                    if (password_verify($_POST['pass_actuel'], $donnees['pass']))
                    {
                        if ($_POST['nouveau_pass'] == $_POST['pass_confirmation'])
                        {
                            $pass_hache = password_hash($_POST['nouveau_pass'], PASSWORD_DEFAULT);

                            $sql = "UPDATE Membres SET pass = :nvpass WHERE id = :id";
                            $req = $bdd->prepare($sql);
                            $req->execute(array(
                                'nvpass' => $pass_hache,
                                'id' => $id));
                            $req->closeCursor();

                        }
                        else
                        {
                            $erreur =true;
                            $chaine = $chaine . 'Les nouveaux mot de passe sont différent.<br>';
                        }

                    }
                    else
                    {
                        $erreur =true;
                        $chaine = $chaine . 'Le mot de passe actuel est invalide.<br>';
                    }
            }
            else
            {
                $chaine = $chaine . 'Probleme avec les champs de mot de passe.<br>';
            }

            //// Avatar ////
            if (isset($_POST['avatar']))
            {
                //
            }
            else
            {
                //
            }

            //// Erreur ////
            if ($erreur)
            {
                $_SESSION['erreur_espace_personnel'] = $chaine;
                header("Location: ./Espace_personnel.php?section=compte");
            }
            else
            {
                // afficher ok puis redirection vers espace perso
                header("Location: ./Espace_personnel.php");
            }

            break;

        case 'a_propos':

            //// Description ////
            if (isset($_POST['description']))
            {
                $sql = "SELECT description FROM Membres WHERE id = :id";
                $req = $bdd->prepare($sql);
                $req->execute(array(
                    'id' => $id));
                $donnees = $req->fetch();
                $req->closeCursor();

                $description = $donnees['description'];
                $nvdescription = strip_tags($_POST['description']);

                if ($description != $nvdescription)
                {
                    $sql = "UPDATE Membres SET description = :nvdescription WHERE id = :id";
                    $req = $bdd->prepare($sql);
                    $req->execute(array(
                        'nvdescription' => $nvdescription,
                        'id' => $id));
                    $req->closeCursor();

                    header("Location: Espace_personnel.php");
                }/*
                else
                {
                    echo "description idenditique";
                }*/
            }
            else
            {

            }

            //// Erreur ////
            if ($erreur)
            {
                $_SESSION['erreur_espace_personnel'] = $chaine;
                header("Location: ./Espace_personnel.php?section=a_propos");
            }
            else
            {
                // afficher ok puis redirection vers espace perso
            }

            break;

        default:
            // retourner vers la page de modif avec erreur :
            // La section du formulaire est invalide !
            break;
    }
}
else
{
    echo "pas de section";
}

?>