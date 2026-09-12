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

    $stmt = $db->prepare($sql);
    $stmt->execute(["user_i" => $user_i]);

    $getBooking = $stmt->fetchAll();

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

    $stmt = $db->prepare($sql);
    $stmt->execute(array(
        ':id' => $id
    ));
}