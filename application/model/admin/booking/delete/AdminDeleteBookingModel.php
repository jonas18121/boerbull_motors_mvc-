<?php
require_once 'config/DataBase.php';

/** supprimer un user 
 * 
 * @param int
 * @return void
*/
function deleteBookingAdmin(int $id) : void
{
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "DELETE FROM booking WHERE id = :id ";
    $deleteBooking = $db->prepare($sql);
    $deleteBooking->execute([':id' => $id]);
}