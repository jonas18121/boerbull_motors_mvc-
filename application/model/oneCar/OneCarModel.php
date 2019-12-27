<?php
require_once 'config/DataBase.php';
include_once 'library/Tools.php';

/** selectionne une voiture 
 * 
 * @param int $one
 * @return array $oneCar
*/
function OneCar(int $one) : array
{
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
 * @param array $session
 * @return array $oneCar
*/
function OneCarBooking(array $session) :array
{
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