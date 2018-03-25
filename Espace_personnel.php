<?php
/******************************************************************************
 * Nom :       Espace_personnel.php
 * Projet :    Mon site de blog et de news
 * Objectif :  Espace personnel pour modifier les information du compte
 * Créé le :   24/02/2018
 * Auteur :    nairo5913
******************************************************************************/
session_start();
require("./Scripts/connection_bdd.php");
require("./Scripts/Test_si_connecte.php")
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
        <title>Blog - Espace personnel</title>
    </head>
    <body>
        <?php require('./Style/En_tete.php');
        require("./Style/Navigation.php"); ?>
        <section>
            <article>
                <h1>Espace personnel</h1>
                <?php
                if ($connecte)
                {
                    // Récupération variable de session
                    $id = $_SESSION['id'];
                    $pseudo = $_SESSION['pseudo'];

                    //Requête SQL
                    $sql = "SELECT * FROM Membres WHERE id = :id";
                    $req = $bdd->prepare($sql);
                    $req->execute(array(
                        'id' => $id));

                    $donnees = $req->fetch();

                    $req->closeCursor();

                    $mail = $donnees['mail'];
                    $nom = $donnees['nom'];
                    $prenom = $donnees['prenom'];
                    $date_naissance = $donnees['date_naissance'];
                    $telephone_portable = $donnees['telephone_portable'];
                    $telephone_fixe = $donnees['telephone_fixe'];
                    $date_inscription = $donnees['date_inscription'];
                    $id_groupe = $donnees['id_groupe'];
                    $presentation = $donnees['description'];

                    // On récupere le groupe
                    $sql = "SELECT groupe FROM Groupes WHERE id = :id";
                    $req = $bdd->prepare($sql);
                    $req->execute(array(
                        'id' => $id_groupe));
                    $donnees = $req->fetch();
                    $groupe = $donnees['groupe'];

                    $req->closeCursor();


                    //formulaire
                    //ajouter if si bouton modifier
                    if (isset($_GET['section']))
                    {
                        $section = strip_tags($_GET['section']);

                        switch ($section)
                        {
                            case 'identitee': ?>
                                <form action="./Espace_personnel_post.php" method="post" accept-charset="utf-8">
                                    <fieldset id="identitee">
                                        <legend>Identitée</legend>
                                        <label for="nom">Votre nom :
                                            <input type="text" name="nom" id="nom" value="<?php echo $nom; ?>" disabled>
                                        </label>
                                        <br><br>

                                        <label for="prenom">Votre prénom :
                                            <input type="text" name="prenom" id="prenom" value="<?php echo $prenom; ?>" disabled>
                                        </label>
                                        <br><br>

                                        <label for="date_naissance">Votre date de naissance* :
                                            <input type="date" name="date_naissance" id="date_naissance" min="1900-01-01" value="<?php echo $date_naissance; ?>" required>
                                        </label>
                                        <br><br>

                                        <label for="telephone_portable">Votre téléphone portable :
                                            <input type="tel" name="telephone_portable" id="telephone_portable" pattern="^0[6-7]([-. ]?[0-9]{2}){4}$" value="<?php echo $telephone_portable; ?>" >
                                        </label>
                                        <br><br>

                                        <label for="telephone_fixe">Votre téléphone fixe :
                                            <input type="tel" name="telephone_fixe" id="telephone_fixe" pattern="^0[1-58-9]([-. ]?[0-9]{2}){4}$" value="<?php echo $telephone_fixe; ?>" >
                                        </label>
                                        <br><br>

                                    </fieldset>
                                    <fieldset>
                                        <legend>Validation</legend>
                                        <input type="hidden" name="section" id="section" value="identitee">

                                        <label for="legende">* : champs obligatoire.
                                            <input type="text" name="legende" id="legende" placeholder="Exemple de champ obligatoire" required disabled>
                                        </label>
                                        <br><br>

                                        <label for="legende">Champs non modifiable :
                                            <input type="text" name="legende" id="legende" placeholder="Exemple de champ non modifiable" disabled>
                                        </label>
                                    <?php
                                        if (isset($_SESSION['erreur_espace_personnel']))
                                        {
                                            if ($_SESSION['erreur_espace_personnel'])
                                            { ?>
                                                <div id="erreur" class="erreur">
                                                    <h2>Erreur</h2>
                                                    <?php echo $_SESSION['erreur_espace_personnel']; ?>
                                                <div>
                                            <?php
                                            }
                                        }
                                    ?>
                                        <br>
                                        <input type="submit" name="envoyer" value="Envoyer">
                                        <input type="reset" name="reinitialiser" value="Réinitialiser les champs">
                                    </fieldset>
                                </form>
                                <?php break;

                            case 'compte': ?>
                                <form action="./Espace_personnel_post.php" method="post" accept-charset="utf-8">
                                    <fieldset>
                                        <legend>Compte</legend>
                                        <label for="pseudo">Votre pseudo :
                                            <input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>" disabled>
                                        </label>
                                        <br><br>

                                        <label for="pass_actuel">Votre mot de passe actuel :
                                            <input type="password" name="pass_actuel" id="pass_actuel" autofocus>
                                        </label>
                                        <br><br>

                                        <label for="nouveau_pass">Votre nouveau mot de passe :
                                            <input type="password" name="nouveau_pass" id="nouveau_pass" >
                                        </label>
                                        <br><br>

                                        <label for="pass_confirmation">Retaper votre nouveau mot de passe :
                                            <input type="password" name="pass_confirmation" id="pass_confirmation" >
                                        </label>
                                        <br><br>

                                        <label for="avatar">Votre avatar :
                                            <!-- liste de sélection d'image -->
                                            <select name="avatar">
                                                <option value="1">
                                                    1<img src="" alt="avatar 1" class="avatar_img" id="avatar_img_1">
                                                </option>
                                                <option value="2">
                                                    2<img src="#" alt="avatar 2" class="avatar_img" id="avatar_img_2">
                                                </option>
                                                <option value="3">
                                                    3<img src="" alt="avatar 3" class="avatar_img" id="avatar_img_3">
                                                </option>
                                                <option value="4">
                                                    4<img src="" alt="avatar 4" class="avatar_img" id="avatar_img_4">
                                                </option>
                                            </select>
                                        </label>
                                        <br><br>

                                        <label for="groupe">Votre groupe :
                                            <input type="text" name="groupe" id="groupe" value="<?php echo $groupe; ?>" disabled>
                                        </label>
                                        <br><br>

                                    </fieldset>
                                    <fieldset>
                                        <legend>Validation</legend>
                                        <input type="hidden" name="section" id="section" value="compte">

                                        <label for="legende">* : champs obligatoire.
                                            <input type="text" name="legende" id="legende" placeholder="Exemple de champ obligatoire" required disabled>
                                        </label>
                                        <br><br>

                                        <label for="legende">Champs non modifiable :
                                            <input type="text" name="legende" id="legende" placeholder="Exemple de champ non modifiable" disabled>
                                        </label>
                                    <?php
                                        if (isset($_SESSION['erreur_espace_personnel']))
                                        {
                                            if ($_SESSION['erreur_espace_personnel'])
                                            { ?>
                                                <div id="erreur" class="erreur">
                                                    <h2>Erreur</h2>
                                                    <?php echo $_SESSION['erreur_espace_personnel']; ?>
                                                <div>
                                            <?php
                                            }
                                        }
                                    ?>
                                        <br>
                                        <input type="submit" name="envoyer" value="Envoyer">
                                        <input type="reset" name="reinitialiser" value="Réinitialiser les champs">
                                    </fieldset>
                                </form>
                                <?php break;

                            case 'a_propos': ?>
                                <form action="./Espace_personnel_post.php" method="post" accept-charset="utf-8">
                                    <fieldset>
                                        <legend>À propos</legend>
                                        <label for="description">Dites en un peu plus sur vous :
                                            <textarea name="description" name="description" id="description" autofocus><?php echo $presentation; ?></textarea>
                                        </label>
                                        <br><br>

                                    </fieldset>
                                    <fieldset>
                                        <legend>Validation</legend>
                                        <input type="hidden" name="section" id="section" value="a_propos">

                                        <label for="legende">* : champs obligatoire.
                                            <input type="text" name="legende" id="legende" placeholder="Exemple de champ obligatoire" required disabled>
                                        </label>
                                        <br><br>

                                        <label for="legende">Champs non modifiable :
                                            <input type="text" name="legende" id="legende" placeholder="Exemple de champ non modifiable" disabled>
                                        </label>
                                    <?php
                                        if (isset($_SESSION['erreur_espace_personnel']))
                                        {
                                            if ($_SESSION['erreur_espace_personnel'])
                                            { ?>
                                                <div id="erreur" class="erreur">
                                                    <h2>Erreur</h2>
                                                    <?php echo $_SESSION['erreur_espace_personnel']; ?>
                                                <div>
                                            <?php
                                            }
                                        }
                                    ?>
                                        <br>
                                        <input type="submit" name="envoyer" value="Envoyer">
                                        <input type="reset" name="reinitialiser" value="Réinitialiser les champs">
                                    </fieldset>
                                </form>

                                <?php break;

                            default:
                                echo "La section du formulaire est invalide !";
                                break;
                        }
                    }
                    else
                    { ?>
                        <form action="./Espace_personnel_post.php" method="post" accept-charset="utf-8">
                            <fieldset id="identitee">
                                <legend>Identitée</legend>
                                <label for="nom">Votre nom :
                                    <input type="text" name="nom" id="nom" value="<?php echo $nom; ?>" disabled>
                                </label>
                                <br><br>

                                <label for="prenom">Votre prénom :
                                    <input type="text" name="prenom" id="prenom" value="<?php echo $prenom; ?>" disabled>
                                </label>
                                <br><br>

                                <label for="date_naissance">Votre date de naissance :
                                    <input type="date" name="date_naissance" id="date_naissance" value="<?php echo $date_naissance; ?>" disabled>
                                </label>
                                <br><br>

                                <label for="telephone_portable">Votre téléphone portable :
                                    <input type="tel" name="telephone_portable" id="telephone_portable" value="<?php echo $telephone_portable; ?>" disabled>
                                </label>
                                <br><br>

                                <label for="telephone_fixe">Votre téléphone fixe :
                                    <input type="tel" name="telephone_fixe" id="telephone_fixe" value="<?php echo $telephone_fixe; ?>" disabled>
                                </label>
                                <br><br>

                                <div class="bouton_modifier_contenu">
                                    <button type="submit" class="bouton_modifier" formaction="./Espace_personnel.php?section=identitee">Modifier</button>
                                </div>
                                <br>

                            </fieldset>
                            <fieldset>
                                <legend>Compte</legend>
                                <label for="pseudo">Votre pseudo :
                                    <input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>" disabled>
                                </label>
                                <br><br>

                                <label for="pass_actuel">Votre mot de passe :
                                    <input type="password" name="pass_actuel" id="pass_actuel" value="azertyuiop" disabled>
                                </label>
                                <br><br>

                                <label for="avatar">Votre avatar :
                                    <!-- liste de sélection d'image -->
                                    <select name="avatar" disabled>
                                        <option value="1">
                                            1<img src="" alt="avatar 1" class="avatar_img" id="avatar_img_1">
                                        </option>
                                        <option value="2">
                                            2<img src="#" alt="avatar 2" class="avatar_img" id="avatar_img_2">
                                        </option>
                                        <option value="3">
                                            3<img src="" alt="avatar 3" class="avatar_img" id="avatar_img_3">
                                        </option>
                                        <option value="4">
                                            4<img src="" alt="avatar 4" class="avatar_img" id="avatar_img_4">
                                        </option>
                                    </select>
                                </label>
                                <br><br>

                                <label for="groupe">Votre groupe :
                                    <input type="text" name="groupe" id="groupe" value="<?php echo $groupe; ?>" disabled>
                                </label>
                                <br><br>

                                <div class="bouton_modifier_contenu">
                                    <button type="submit" class="bouton_modifier" formaction="./Espace_personnel.php?section=compte">Modifier</button>
                                </div>

                                <br><br>

                            </fieldset>
                            <fieldset>
                                <legend>À propos</legend>
                                <label for="description">Dites en un peu plus sur vous :
                                    <textarea name="description" name="description" id="description" disabled><?php echo $presentation; ?></textarea>
                                </label>
                                <br><br>

                                <div class="bouton_modifier_contenu">
                                    <button type="submit" class="bouton_modifier" formaction="./Espace_personnel.php?section=a_propos">Modifier</button>
                                </div>
                                <br>

                        </form>
                    <?php }

                    ?>

                <?php }
                else
                {
                    //Message demandant la connection ?>
                    <h2 class="non_connecte">Vous n'ête pas connecté !</h2>
                    <br>
                    <p>
                        Merci de bien vouloir vous connecter pour accéder à votre espace personnel.
                        <br><br>
                        Cliquez sur le bouton "Se connecter" ci dessous pour aller vers la page de connection.
                        <br><br>

                        <div class="bouton_conteneur">
                            <form action="Inscription.php" method="post" accept-charset="utf-8">
                                <button type="submit"><span>Inscription</span></button>
                                <button type="submit" formaction="Connexion.php?page=espace_perso"><span>Se connecter</span></button>

                            </form>
                        </div>
                    </p>
                <?php } ?>
            </article>
        </section>
        <?php require('./Style/Pied_de_page.php'); ?>
    </body>
</html>