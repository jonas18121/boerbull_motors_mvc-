<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/admin/car/delete/AdminDeleteCarsModel.php';

//appel de la session
require_once 'aSession/AdminSession.php';

//appel du fichier dans la librairie
require_once 'library/Tools.php';


//en $_GET
//supprimer une voiture
function adminDeleteCars(){

    //si le admin n'est pas connecter au le renvois a l'accueil
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }

    // Avec $_GET, on recupère la valeur de l'id qui est dans l'url 
    deleteCar((int)$_GET['id']);

    //on redirectionne l'admin vers la liste des voitures
    redirect("index.php?action=admin&action2=car&action3=get");
}