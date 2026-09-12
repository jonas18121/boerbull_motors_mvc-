<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/admin/users/delete/AdminDeleteUsersModel.php';

//appel de la session
require_once 'aSession/AdminSession.php';

//appel du fichier dans la librairie
require_once 'library/Tools.php';


//en $_GET
//supprimer un user
function adminDeleteUsers(){

    //si le admin n'est pas connecter au le renvois a l'accueil
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }

    // Avec $_GET, on recupère la valeur de l'id qui est dans l'url 
    deleteUser((int)$_GET['id']);

    //on redirectionne l'admin vers la liste des users
    redirect("index.php?action=admin&action2=users&action3=get");
}