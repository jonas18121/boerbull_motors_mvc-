<?php
//controlleur mettre en relation le model et la vue 

require_once 'model/admin/car/delete/AdminDeleteCarsModel.php';
require_once 'aSession/AdminSession.php';
require_once 'library/Tools.php';


//en $_GET
//supprimer une voiture
function adminDeleteCars(){

    //si le admin n'est pas connecter au le renvois a l'accueil
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }
    
    // Avec $_GET, on recupère la valeur de l'id et le nom de l'image qui sont dans l'url 
    deleteCar((int)$_GET['id']);
    unlink("www/imgBoerbullMotors/" . $_GET['image']);
    
    //on redirectionne l'admin vers la liste des voitures
    redirect("index.php?action=admin&action2=car&action3=get");
}