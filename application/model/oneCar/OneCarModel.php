<?php
//model , gestion de la base de donnée

//inclure la bdd
require_once 'config/DataBase.php';

//appel dans la librairie
include_once 'library/Tools.php';

/** selectionne une voiture 
 * 
 * @param int
 * 
 * @return array
*/
function OneCar($one){
    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT * FROM car WHERE id = :id";

    $oneCar = $db->prepare($sql);
    $oneCar->execute(array('id' => $one));

    $oneCar = $oneCar->fetchAll();
    
    if(empty($oneCar)){
        redirect("index.php");
    }

    return $oneCar;
}





/** selectionne une voiture 
 * 
 * @param array
 * 
 * @return array
*/
function OneCarBooking(array $session){
    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    $sql = 'SELECT * FROM car WHERE id IN ('.implode(',',$session).')';

    $oneCar = $db->prepare($sql);
    $oneCar->execute(array('id' => implode(',' , $session)));

    $oneCar = $oneCar->fetchAll();

    if(empty($oneCar)){
        redirect("index.php");
    }

    return $oneCar;
}