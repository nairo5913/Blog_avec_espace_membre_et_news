<?php
/******************************************************************************
 * Nom :       Navigation.php
 * Projet :    Mon site de blog et de news
 * Objectif :  Barre de navigation
 * Créé le :   24/02/2018
 * Auteur :    nairo5913
******************************************************************************/
include './Scripts/Test_si_connecte.php';
?>
<nav>
    <ul>
        <li><a href="./Espace_personnel.php" title="Espace personnel">Espace personnel</a></li>
        <li><a href="./Galerie_image.php" title="Gallerie d'image">Gallerie d'image</a></li>
        <li class="menu_deroulant">
            <a href="javascript:void(0)" title="Menu déroulant" class="menu_deroulanttn">Forum</a>
            <div class="contenu_menu_deroulant">
                <a href="#" title="Catégorie 1">Catégorie 1</a>
                <a href="#" title="Catégorie 2">Catégorie 2</a>
                <a href="#" title="Catégorie 3">Catégorie 3</a>
            </div>
        </li>
        <?php
        if ($connecte)
        {
            if ($_SESSION['groupe'] == 3)
            { ?>
                <li style="float:right"><a href="#" title="Administration">Administration</a></li>
            <?php }
        }
        ?>
    </ul>
</nav>