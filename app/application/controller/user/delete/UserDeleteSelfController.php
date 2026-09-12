<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/user/delete/UserDeleteSelfModel.php';

//appel de la session
require_once 'aSession/UserSession.php';

//appel du fichier dans la librairie
require_once 'library/Tools.php';


//en $_GET
//supprimer une voiture
function userDeleteSelf(){

    //si le admin n'est pas connecter au le renvois a l'accueil
    if(!isAuthenticatedUser()){
        redirect("index.php");
    }

    // Avec $_GET, on recupère la valeur de l'id qui est dans l'url 
    deleteSelfUser((int)$_GET['id']);

    //on detruit la session de user
    userDestroy();

    //on redirectionne vers l'accueil
    redirect("index.php");
}