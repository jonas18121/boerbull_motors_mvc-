<?php
//model , gestion de la base de donnée

//inclure la bdd
require_once 'config/DataBase.php';


/** Afficher tous les cars 
 * 
 * @return array
*/
function GetCars(){
    
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT * FROM car";
    $adminGetCars = $db->query($sql);
    $adminGetCars = $adminGetCars->fetchAll();

    return $adminGetCars;
}