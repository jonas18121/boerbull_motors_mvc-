<?php
//model , gestion de la base de donnée

//inclure la bdd
require_once 'config/DataBase.php';


/** afficher les RDV 
 * 
 * @param int
 * 
 * @return array
*/
function getBooking($user_i){
    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT * FROM booking WHERE user_i = :user_i";

    $getBooking = $db->prepare($sql);
    $getBooking->execute(["user_i" => $user_i]);

    $getBooking = $getBooking->fetchAll();

    return $getBooking;
}



/** effacer un RDV 
 * 
 * @param int
 * 
 * @return void
*/
function deleteBooking($id){
    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "DELETE FROM booking WHERE id = :id";

    $deleteOneBooking = $db->prepare($sql);
    $deleteOneBooking->execute(array(
        ':id' => $id
    ));
}