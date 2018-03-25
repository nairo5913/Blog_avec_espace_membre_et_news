<?php
/******************************************************************************
 * Projet : Création d'image
 * Nom du fichier : test_gd.php
 * Description : Génération d'image avec php (bibliotheque GD) puis affichage
 * Auteur : nairo5913
******************************************************************************/
/* 1 : on indique qu'on va envoyer une image PNG */
header ("Content-type: image/png");

/* 2 : on crée une nouvelle image de taille 200 x 50 */
$image = imagecreate(200,50);
// À partir d'une image existante
// $image = imagecreatefromjpeg("couchersoleil.jpg");

/* 3 : on s'amuse avec notre image */
//// Manipulation des couleurs
$orange = imagecolorallocate($image, 255, 128, 0);
$bleu = imagecolorallocate($image, 0, 0, 255);
$bleuclair = imagecolorallocate($image, 156, 227, 254);
$noir = imagecolorallocate($image, 0, 0, 0);
$blanc = imagecolorallocate($image, 255, 255, 255);

//// Écriture de texte ////
// imagestring($image, $police, $x, $y, $texte_a_ecrire, $couleur);
imagestring($image, 4, 35, 15, "Salut les Zéros !", $blanc);

//// Déssiner une forme ////
// Un pixel
// ImageSetPixel ($image, $x, $y, $couleur);
//ImageSetPixel ($image, 100, 100, $noir);
//
// Une ligne ////
// ImageLine ($image, $x1, $y1, $x2, $y2, $couleur);
//ImageLine ($image, 30, 30, 120, 120, $noir);
//
// Une ellipse ////
// ImageEllipse ($image, $x, $y, $largeur, $hauteur, $couleur);
//ImageEllipse ($image, 100, 100, 100, 50, $noir);
//
//// Un rectangle ////
// ImageRectangle ($image, $x1, $y1, $x2, $y2, $couleur);
//ImageRectangle ($image, 30, 30, 160, 120, $noir);
//
//// Un polygone ////
// ImagePolygon ($image, $array_points, $nombre_de_points, $couleur);
//$points = array(10, 40, 120, 50, 160, 160); ImagePolygon ($image, $points, 3, $noir);

//// Rendre une image transparente ////
//imagecolortransparent($image, $orange);

/* 4 : on a fini de faire joujou, on demande à afficher l'image */
imagepng($image);

?>