<?php
require_once 'config/DataBase.php';


/** Afficher tous les cars 
 * @return array
*/
function GetCars() : array
{
    
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT * FROM car";
    $adminGetCars = $db->query($sql);
    $adminGetCars = $adminGetCars->fetchAll();

    return $adminGetCars;
}