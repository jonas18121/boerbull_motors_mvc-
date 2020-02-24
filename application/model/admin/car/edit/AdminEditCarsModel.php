<?php
require_once 'config/DataBase.php';
include_once 'library/Tools.php';


//en $_GET
/** admin affiche le car a modifier 
 * @param int $id
 * @return array $editFormCars
*/
function editFormCars(int $id) : array 
{
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT * FROM car WHERE id = :id";

    $editFormCars = $db->prepare($sql);
    $editFormCars->execute([':id' => $id]);
    $editFormCars = $editFormCars->fetchAll();

    if(empty($editFormCars)){
        redirect("index.php");
    }

    return $editFormCars;
}


// en $_POST
/** admin insert le contenu modifier du car 
 * @param string $marque
 * @param string $modele
 * @param int $anne
 * @param string $conso
 * @param string $color
 * @param int $prix_trois_jours
 * @param string $puissance
 * @param string $moteur
 * @param string $carburant
 * @param int cent
 * @param string $nombre_de_place
 * @param int $id_category
 * @param int $id
 * 
 * @return void
*/
function editCars(string $marque, string $modele, int $anne, string $conso, string $color, int $prix_trois_jours, string $puissance, string $moteur, string $carburant, int $cent, int $nombre_de_place, int $id_category, int $id) : void
{

    $db = new Database;
    $db = $db->dbConnect();

    // requète pour modifier un car précis
    $sql = "UPDATE car SET marque = :marque, modele = :modele, annee = :annee, conso = :conso, color = :color, prix_trois_jours = :prix_trois_jours, 
        puissance = :puissance, moteur = :moteur, carburant = :carburant, cent = :cent, nombre_de_place = :nombre_de_place, id_category = :id_category WHERE id = :id";

        $editCar = $db->prepare($sql);
        $editCar->execute([

            ':marque' => $marque, 
            ':modele' => $modele, 
            ':annee' => $anne,
            ':conso' => $conso,
            ':color' => $color,
            ':prix_trois_jours' => $prix_trois_jours,
            ':puissance' => $puissance,
            ':moteur' => $moteur,
            ':carburant' => $carburant,
            ':cent' => $cent,
            ':nombre_de_place' => $nombre_de_place,
            ':id_category' => $id_category,
            ':id' => $id
        ]);
}
