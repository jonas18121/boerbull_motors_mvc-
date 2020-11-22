<?php
require_once 'config/DataBase.php';

/** admin ajoute une voiture 
 *
 * @param string $marque
 * @param string $modele
 * @param string $color
 * @param string $moteur
 * @param string $carburant
 * @param string $image_url
 * @param int $annee
 * @param int $conso
 * @param int $prix_trois_jours
 * @param int $puissance
 * @param int $id_category
 * @param int $cent
 * @return void  
 */ 
function addCars(string $marque, string $modele, int $annee, int $conso, string $color, int $prix_trois_jours, int $puissance, string $moteur, string $carburant, int $cent, int $nombre_de_place, int $id_category, string $image_url = null) :void
{
    $db = new Database;
    $db = $db->dbConnect();
     
    $sql = "INSERT INTO car(marque, modele, annee, conso, color, prix_trois_jours, puissance, moteur, carburant, cent, nombre_de_place, id_category, image_url) 
    VALUES(:marque, :modele, :annee, :conso, :color, :prix_trois_jours, :puissance, :moteur, :carburant, :cent, :nombre_de_place, :id_category, :image_url)";


    $addCar = $db->prepare($sql);
        
    $addCar->execute([

        ':marque' => $marque, 
        ':modele' => $modele, 
        ':annee' => $annee,
        ':conso' => $conso,
        ':color' => $color,
        ':prix_trois_jours' => $prix_trois_jours,
        ':puissance' => $puissance,
        ':moteur' => $moteur,
        ':carburant' => $carburant,
        ':cent' => $cent,
        ':nombre_de_place' => $nombre_de_place,
        ':id_category' => $id_category, 
        ':image_url' => $image_url
    ]);
}



/** admin ajoute une categorie à la voiture qu'on a ajouter 
 * 
 * @return array $category
*/
function category() : array
{
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT * FROM category";
    $category = $db->query($sql);
    $category = $category->fetchAll();
    
    return $category;
}