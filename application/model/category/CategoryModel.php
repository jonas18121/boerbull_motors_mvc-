<?php
require_once 'config/DataBase.php';
require_once 'library/Tools.php';

/** selectionner des voitures par categorie 
 * 
 * @param int $category
 * @return array $categories
*/
function findCategory(int $category, int $premier, int $nb_car_par_page) : array
{
    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT car.id, image_url, modele, marque, name 
        FROM car 
        INNER JOIN category 
        ON category.id = car.id_category 
        WHERE category.id = :id_category
        LIMIT {$premier}, {$nb_car_par_page}"
    ;

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

/**
 * compter le nombre de voiture dans une categorie
 */
function nb_car(int $category)  : string
{
    $db = new Database;
    $db = $db->dbConnect();
    
    $sql = "SELECT COUNT(*) AS nb_car FROM category, car WHERE category.id = {$category} AND car.id_category = category.id";

    $nb_car = $db->query($sql);
    $nb_car = $nb_car->fetch();

    if(empty($nb_car)){
        redirect("index.php");
    }
    // pre_var_dump($nb_car['nb_car'], null, true);
    return (int) $nb_car['nb_car'];
}

