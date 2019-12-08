<?php
//model , gestion de la base de donnée

//inclure la bdd
require_once 'config/DataBase.php';

/** supprimer un user 
 * 
 * @param int
 * 
 * @return void
*/
function deleteBookingAdmin($id){

    $db = new Database;
    $db = $db->dbConnect();

    $sql = "DELETE FROM booking WHERE id = :id ";

    $deleteBooking = $db->prepare($sql);
    $deleteBooking->execute([':id' => $id]);
}