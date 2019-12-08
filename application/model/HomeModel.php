<?php
//model , gestion de la base de donnée

//inclure la bdd
require_once 'config/DataBase.php';



/** selectionner toute les voitures et afficher 5 maximum , 1 voiture pour chaque category qui existe
 * 
 * @return array 
 */
function findHome(){

    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT * FROM car INNER JOIN category ON category.id = car.id_category WHERE id_category LIMIT 5";

    $home = $db->query($sql);
    $home = $home->fetchAll();

    return  $home;
}