<?php
require_once 'config/DataBase.php';


/** Afficher tous les users 
 * 
 * @return array
*/
function GetUsers() : array
{
    
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT * FROM user";
    $adminGetUsers = $db->query($sql);
    $adminGetUsers = $adminGetUsers->fetchAll();

    return $adminGetUsers;
}