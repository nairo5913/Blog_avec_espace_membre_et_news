<?php
/******************************************************************************
 * Nom :       Acceuil.php
 * Projet :    Mon site de blog et de news
 * Objectif :  Page d'acceuill du site (index)
 * Créé le :   24/12/2017
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
        <title>Blog - Accueil</title>
    </head>
    <body>
        <?php require('./Style/En_tete.php');
        require("./Style/Navigation.php"); ?>
        <section>
            <article>
                <h1>Acceuil</h1>
                <p>
                    Bienvenue sur sur mon site !
                    <br><br>
                <?php
                    if ($connecte)
                    {?>

                        Vous êtes bien connecter <?php echo $_SESSION['pseudo'];?>
                        <br>
                        Votre groupe :
                        <?php echo $_SESSION['groupe']; ?>

                    <?php }
                    else
                    {?>

                        Veuillez vous connecter en cliquant sur le bouton se connecter si dessus.

                    <?php }

                ?>
                </p>
            </article>
            <article>
                <h1>Attention</h1>
                <p>
                    Pensez à l'inscription.
                    <br>
                </p>
                <p>
                    OK!!!
                    <br>
                    Je sais pas quoi mettre d'autre!!!!
                    <br>
                </p>
                <p>

                    Ibi victu recreati et quiete, postquam abierat timor, vicos opulentos adorti equestrium adventu cohortium, quae casu propinquabant, nec resistere planitie porrecta conati digressi sunt retroque concedentes omne iuventutis robur relictum in sedibus acciverunt.
                </p>
                <p>
                    Et interdum acciderat, ut siquid in penetrali secreto nullo citerioris vitae ministro praesente paterfamilias uxori susurrasset in aurem, velut Amphiarao referente aut Marcio, quondam vatibus inclitis, postridie disceret imperator. ideoque etiam parietes arcanorum soli conscii timebantur.
                    <br>
                    Ciliciam vero, quae Cydno amni exultat, Tarsus nobilitat, urbs perspicabilis hanc condidisse Perseus memoratur, Iovis filius et Danaes, vel certe ex Aethiopia profectus Sandan quidam nomine vir opulentus et nobilis et Anazarbus auctoris vocabulum referens, et Mopsuestia vatis illius domicilium Mopsi, quem a conmilitio Argonautarum cum aureo vellere direpto redirent, errore abstractum delatumque ad Africae litus mors repentina consumpsit, et ex eo cespite punico tecti manes eius heroici dolorum varietati medentur plerumque sospitales.
                </p>
            </article>
        </section>
        <?php require('./Style/Pied_de_page.php'); ?>
    </body>
</html>