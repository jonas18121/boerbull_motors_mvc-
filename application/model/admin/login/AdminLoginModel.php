<?php
require_once 'config/DataBase.php';


/** login  /CONNEXION 
 * @param string $email
 * @param string $password
 * 
 * @return void|array
*/
function loginAdmin(string $email, string $password) : ?array
{
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT * From boerbull_admin WHERE mail = :mail ";

    $adminExist = $db->prepare($sql);
    $adminExist->execute([':mail' => $email]);
    $adminExist = $adminExist->fetch();


    if(empty($adminExist)){
        throw new PDOException(('admin inconnu - cet email n\' existe pas'));
    }

    if(!password_verify($password, $adminExist['password'])){
        throw new PDOException('Le mot de passe est incorrect');
    } 
    return $adminExist;
}            


/** on récupère tous les admins 
 * @return array
*/
function adminAll() : array
{
    $db = new Database;
    $db = $db->dbConnect();

    $sql = 'SELECT * FROM boerbull_admin';
    $adminAll = $db->query($sql);
    $adminAll = $adminAll->fetchAll();
    return $adminAll;
}