<?php
require_once 'config/DataBase.php';
require_once 'library/Tools.php';

//en $_GET
/** admin affiche le user a modifier 
 * 
 * @param int
 * @return array
*/
function editFormUsers(int $id) : array
{

    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT * FROM user WHERE id = :id";

    $editFormUsers = $db->prepare($sql);
    $editFormUsers->execute([':id' => $id]);
    $editFormUsers = $editFormUsers->fetchAll();

    if(empty($editFormUsers)){
        redirect("index.php");
    }

    return $editFormUsers;
}


//en $_POST
/** admin insert le contenu modifier du user 
 * 
 * @param string
 * @param string
 * @param string
 * @param string
 * @param int
 * 
 * @return void
*/
function editUsers(string $first_name, string $last_name, string $email, string $password, int $id) : void
{

    $db = new Database;
    $db = $db->dbConnect();

    // requète pour modifier un user précis
    $sql = "UPDATE user SET first_name = :first_name, last_name = :last_name, mail = :mail, password = :password WHERE id = :id";

    /* on hashe le nouveau mot de passe */
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);


    $editUsers = $db->prepare($sql);
    $editUsers = $editUsers->execute([
        ':id'         => $id,
        ':first_name' => $first_name, 
        ':last_name'  => $last_name, 
        ':mail'       => $email,
        ':password'   => $passwordHashed
    ]);
}