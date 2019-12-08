<?php
//model , gestion de la base de donnée

//inclure la bdd
require_once 'config/DataBase.php';

/** user supprime son compte 
 * 
 * @param int
 * 
 * @return void
*/
function deleteSelfUser($id){

    $db = new Database;
    $db = $db->dbConnect();

    $sql = "DELETE FROM user WHERE id = :id ";

    $deleteUser = $db->prepare($sql);
    $deleteUser->execute([':id' => $id]);
}