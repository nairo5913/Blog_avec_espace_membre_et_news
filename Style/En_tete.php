<?php
/******************************************************************************
 * Nom :       En_tete.php
 * Projet :    Mon site de blog et de news
 * Objectif :  En-tête des pages du blog
 * Créé le :   24/02/2018
 * Auteur :    nairo5913
******************************************************************************/
include './Scripts/Test_si_connecte.php';
?>
<header>
    <div id="logo_retour_acceuil" class="logo_retour_acceuil">
        <a href="./Acceuil.php" >
            <img src="./Style/Images/homeBouton.png" alt="Bouton home" title="Retour à l'acceuil" id="logo">
        </a>
    </div>
    <div id="titre_en_tete" class="titre_en_tete">
        <h1>Mon super blog!</h1>
    </div>
        <?php
        if ($connecte)
        {?>
        <div id="bouton_en_tete_deconnexion" class="bouton_en_tete_deconnexion">
            <form action="Deconnexion.php" method="post" accept-charset="utf-8">
                <button type="submit">Déconnexion</button>
            </form>
        </div>
        <?php }
        else
        {?>
        <div id="bouton_en_tete" class="bouton_en_tete">
            <form action="Inscription.php" method="post" accept-charset="utf-8">
                <button type="submit">Inscription</button>
                <button type="submit" formaction="Connexion.php">Se connecter</button>

            </form>
        </div>
        <?php }

         ?>
</header>