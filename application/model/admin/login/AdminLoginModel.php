<?php
//model , gestion de la base de donnée

//inclure la bdd
require_once 'config/DataBase.php';


/** login  /CONNEXION 
 * 
 * @param string
 * 
 * @return void/array
*/
function loginAdmin($email, $password){
    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    //si le mail est dans la table boerbull_admin , on selectionne tous le contenue de cette table
    $sql = "SELECT * From boerbull_admin WHERE mail = :mail ";

    $adminExist = $db->prepare($sql);
    $adminExist->execute([':mail' => $email]);
    $adminExist = $adminExist->fetch();


    //on teste si le mail exist dans la table user
    if(empty($adminExist)){
        throw new PDOException(('admin inconnu - cet email n\' existe pas'));
    }

    //on teste si le mot de passe correspond a celui qui est dans la bdd
    if(!password_verify($password, $adminExist['password'])){
        throw new PDOException('Le mot de passe est incorrect');
    } 

    return $adminExist;
    
}            




/** on récupère tous les admins 
 * 
 * @return array
*/
function adminAll(){
    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    $sql = 'SELECT * FROM boerbull_admin';
    $adminAll = $db->query($sql);
    $adminAll = $adminAll->fetchAll();

    return $adminAll;
}