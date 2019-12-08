<?php
//model , gestion de la base de donnée

//inclure la bdd
require_once 'config/DataBase.php';

//appel dans la librairie
include_once 'library/Tools.php';


//en $_GET
/** admin affiche le car a modifier 
 * 
 * @param int
 * 
 * @return array
*/
function editFormCars($id){

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
 * 
 * @param string/int/
 * 
 * @return void
*/
function editCars($marque, $modele, $anne, $conso, $color, $prix_trois_jours, $puissance, $moteur, $carburant, $cent, $nombre_de_place, $id_category, $id){

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
