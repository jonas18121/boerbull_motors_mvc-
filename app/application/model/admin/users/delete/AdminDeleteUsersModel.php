<?php
require_once 'config/DataBase.php';

/** admin supprime un user 
 * 
 * @param int
 * @return void
*/
function deleteUser(int $id) : void
{
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "DELETE FROM user WHERE id = :id ";
    $deleteUser = $db->prepare($sql);
    $deleteUser->execute([':id' => $id]);
}