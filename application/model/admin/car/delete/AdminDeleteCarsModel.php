<?php
require_once 'config/DataBase.php';

/** supprimer un user 
 * 
 * @param int $id
 * @return void
*/
function deleteCar(int $id) : void
{
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "DELETE FROM car WHERE id = :id ";
    $deleteUser = $db->prepare($sql);
    $deleteUser->execute([':id' => $id]);
}