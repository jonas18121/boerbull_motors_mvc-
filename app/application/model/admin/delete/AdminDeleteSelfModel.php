<?php
require_once 'config/DataBase.php';

/** admin supprime son compte 
 * @param int $id
 * @return void
*/
function deleteSelfAdmin(int $id) : void
{
    $db = new Database;
    $db = $db->dbConnect();
    $sql = "DELETE FROM boerbull_admin WHERE id = :id ";

    $deleteUser = $db->prepare($sql);
    $deleteUser->execute([':id' => $id]);
}