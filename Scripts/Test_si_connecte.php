<?php
/******************************************************************************
 * Nom :       Test_si_connecte.php
 * Projet :    Mon site de blog et de news
 * Objectif :  Test si l'utilisateur est connecté
 * Créé le :   24/02/2018
 * Auteur :    nairo5913
******************************************************************************/
//session_start();

if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    $connecte = true;
}
else
{
    $connecte = false;
}
?>