<?php
require_once 'config/DataBase.php';
require_once 'library/Tools.php';

/** selectionner par categorie 
 * 
 * @param int $category
 * @return array $categories
*/
function findCategory(int $category) :array
{
    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT car.id, image_url, modele, marque, name FROM car INNER JOIN category ON category.id = car.id_category WHERE category.id = :id_category";

    $categories = $db->prepare($sql);
    $categories->execute(array('id_category' => $category));

    $categories = $categories->fetchAll();

    if(empty($categories)){
        redirect("index.php");
    }
    return $categories;
} 



// cette function est présente dans le HomeModel.php , sauf que ici on est pas limité a 5 voitures max
/** selectionner toutes les voitures 
 *
 * @return array 
 */ 
function findAllo() :array
{ 

    $db = new Database;
    $db = $db->dbConnect();
    
    $sql = "SELECT * FROM car ";
    $categories = $db->query($sql);
    $categories = $categories->fetchAll();
    return  $categories;
}

