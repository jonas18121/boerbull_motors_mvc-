<?php
require_once 'config/DataBase.php';

/** login  /CONNEXION 
 * 
 * @param string $email
 * @param string $password
 *  @return array $userExist
*/
function loginUser(string $email, string $password) :array
{
    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT * From user WHERE mail = :mail ";

    $userExist = $db->prepare($sql);
    $userExist->execute([':mail' => $email]);
    $userExist = $userExist->fetch();

    if(!$userExist){
        throw new PDOException(('User inconnu - cet email n\' existe pas'));
    }

    if(!password_verify($password, $userExist['password'])){
        throw new PDOException('Le mot de passe est incorrect');
    } 

    return $userExist;
}            

/** on récupère tous les users 
 * 
 *  @return array
*/
function userAll() : array
{
    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    $sql = 'SELECT * FROM user';
    $userAll = $db->query($sql);
    $userAll = $userAll->fetchAll();

    return $userAll;
}

