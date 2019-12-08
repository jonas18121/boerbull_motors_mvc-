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
function deleteCar($id){

    $db = new Database;
    $db = $db->dbConnect();

    $sql = "DELETE FROM car WHERE id = :id ";

    $deleteUser = $db->prepare($sql);
    $deleteUser->execute([':id' => $id]);
}