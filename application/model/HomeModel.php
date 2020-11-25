<?php
require_once 'config/DataBase.php';

/** selectionner toute les voitures et afficher 1 voiture pour chaque category qui existe
 * 
 * @return array $home - retourne un tableau qui contient des objects Car de la classe Car
 */
function findHome() :array
{

    //connexion à la bdd
    $db   = new Database;
    $db   = $db->dbConnect();

    $sql  = "SELECT car.modele, car.id_category, car.image_url, category.id, category.name
        FROM car 
        INNER JOIN category ON category.id = car.id_category 
        WHERE id_category 
        GROUP BY category.id"
    ;

    $home = $db->query($sql);
    $home = $home->fetchAll();

    return  $home;
}