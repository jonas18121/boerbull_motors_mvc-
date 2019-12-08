<?php
//model , gestion de la base de donnée

//inclure la bdd
require_once 'config/DataBase.php';

/** admin supprime son compte 
 * 
 * @param int
 * 
 * @return void
*/
function deleteSelfAdmin($id){

    $db = new Database;
    $db = $db->dbConnect();

    $sql = "DELETE FROM boerbull_admin WHERE id = :id ";

    $deleteUser = $db->prepare($sql);
    $deleteUser->execute([':id' => $id]);
}