<?php
require_once 'config/DataBase.php';

/** afficher les RDV 
 * 
 * @param int $user_i
 * @return array
*/
function getBooking(int $user_i) :array
{
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
 * @param int $id
 * @return void
*/
function deleteBooking(int $id) :void
{
    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "DELETE FROM booking WHERE id = :id";

    $deleteOneBooking = $db->prepare($sql);
    $deleteOneBooking->execute(array(
        ':id' => $id
    ));
}