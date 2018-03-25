<?php
/******************************************************************************
 * Nom :       connection_bdd.php
 * Projet :    Mon site de blog et de news
 * Objectif :  Connection à la base de données
 * Créé le :   24/02/2018
 * Auteur :    nairo5913
******************************************************************************/

/* Variables */
$nom_serveur = "localhost";
$nom_base_donnes = "Blog";
$nom_utilisateur = "pi";
$mot_de_passe = "raspberry";

try
{
    $bdd = new PDO("mysql:host=$nom_serveur; dbname=$nom_base_donnes; charset=utf8", $nom_utilisateur, $mot_de_passe);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Connecté avec succès";
}
catch (Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

?>