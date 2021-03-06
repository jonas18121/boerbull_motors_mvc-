<?php
require_once 'config/DataBase.php';

/** register  /INSCRIPTION 
 * @param string $first_name
 * @param string $last_name
 * @param string $email
 * @param string $password
 * 
 * @return void
*/
function registerUser(string $first_name, string $last_name, string $email, string $password) : void 
{
    $db = new Database;
    $db = $db->dbConnect();

    if(isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false){

        $sql = "SELECT * From user WHERE mail = :mail ";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':mail' => $email
        ]);
        $userExist = $stmt->fetchAll();
        
        if($userExist){
            throw new PDOException(("Un utilisateur existe déjà avec cet email."));
        }

        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (first_name, last_name, mail, password) VALUE(:first_name, :last_name, :mail, :password)";

        $stmt = $db->prepare($sql);
        $user = $stmt->execute([

            ':first_name' => $first_name, 
            ':last_name' => $last_name, 
            ':mail' => $email, 
            ':password' => $passwordHashed
        ]);
    }
}
