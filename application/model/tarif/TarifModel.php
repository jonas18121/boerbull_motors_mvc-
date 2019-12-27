<?php
require_once 'config/DataBase.php';

/** afficher les tarifs
 * 
 * @return array
 */
function getTarifs() : array 
{
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT marque, modele, prix_trois_jours, puissance, name FROM car INNER JOIN category ON category.id = car.id_category";

    $tarifView = $db->query($sql);
    $tarifView = $tarifView->fetchAll();

    return $tarifView;
}