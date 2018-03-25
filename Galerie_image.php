<?php
/******************************************************************************
 * Nom :       Galerie_image.php
 * Projet :    Mon site de blog et de news
 * Objectif :  Galerie d'images
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
        <title>Blog - Accueil</title>
    </head>
    <body>
        <?php require('./Style/En_tete.php');
        require("./Style/Navigation.php"); ?>
        <section>
            <article>
                <h1>Titre 1</h1>
                <p>
                    Eodem tempore etiam Hymetii praeclarae indolis viri negotium est actitatum, cuius hunc novimus esse textum. cum Africam pro consule regeret Carthaginiensibus victus inopia iam lassatis, ex horreis Romano populo destinatis frumentum dedit, pauloque postea cum provenisset segetum copia, integre sine ulla restituit mora.
                </p>
            </article>
            <article>
                <h1>Titre 2</h1>
                <p>
                    Alii nullo quaerente vultus severitate adsimulata patrimonia sua in inmensum extollunt, cultorum ut puta feracium multiplicantes annuos fructus, quae a primo ad ultimum solem se abunde iactitant possidere, ignorantes profecto maiores suos, per quos ita magnitudo Romana porrigitur, non divitiis eluxisse sed per bella saevissima, nec opibus nec victu nec indumentorum vilitate gregariis militibus discrepantes opposita cuncta superasse virtute.
                </p>
            </article>
        </section>
        <?php require('./Style/Pied_de_page.php'); ?>
    </body>
</html>