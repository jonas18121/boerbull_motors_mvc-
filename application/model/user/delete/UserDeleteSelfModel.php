<?php
require_once 'config/DataBase.php';

/** user supprime son compte 
 * 
 * @param int $id
 * @return void
*/
function deleteSelfUser(int $id) :void
{
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "DELETE FROM user WHERE id = :id ";

    $deleteUser = $db->prepare($sql);
    $deleteUser->execute([':id' => $id]);
}