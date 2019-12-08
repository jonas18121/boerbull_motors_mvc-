<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/admin/users/edit/AdminEditUsersModel.php';

//appel de la session
require_once 'aSession/AdminSession.php';

//appel du fichier dans la librairie
require_once 'library/Tools.php';


//en GET$
//affiche le formulaire de modification de user
function adminEditFormUsers(){

    //si le admin n'est pas connecter au le renvois a l'accueil
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }

    // Avec $_GET, on recupère la valeur de l'id qui est dans l'url 
    $adminEditFormUsers = editFormUsers((int)$_GET['id']);

    //appel de la vue
    require_once 'www/templates/admin/users/edit/AdminEditFormUsersView.phtml';
} 


//en POST
//admin modifie un user
function adminEditUsers(){

    //si le admin n'est pas connecter au le renvois a l'accueil
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }

    //controle de formulaire en php
    if(!empty($_POST)){
        if(array_key_exists('id',$_POST) && isset($_POST['id']) && ctype_digit($_POST['id'])){
            if(array_key_exists('first_name',$_POST) && isset($_POST['first_name']) && ctype_alpha($_POST['first_name'])){
                if( strlen($_POST['first_name']) >= 2 && strlen($_POST['first_name']) <= 40){
                    if(array_key_exists('last_name',$_POST) && isset($_POST['last_name']) && ctype_alpha($_POST['last_name'])){
                        if(strlen($_POST['last_name']) >= 2 && strlen($_POST['last_name']) <= 40){
                            if(array_key_exists('password',$_POST) && isset($_POST['password']) && strlen($_POST['password']) >= 8){
                                if(array_key_exists('mail',$_POST) && isset($_POST['mail'])){
                                    if(preg_match("/^[a-zA-Z][a-zA-Z0-9._-]{1,19}@[a-z]{4,7}\.[a-z]{2,3}$/", $_POST['mail'])){

                                        editUsers((string)$_POST['first_name'], (string)$_POST['last_name'], (string)$_POST['mail'], (string)$_POST['password'], (int)$_POST['id']);

                                        //on redirectionne l'admin vers la liste des users
                                        redirect("index.php?action=admin&action2=users&action3=get");
                                    }
                                    redirect('index.php?action=admin&action2=users&action3=editForm&id=' . (int)$_POST['id']);
                                }
                                redirect('index.php?action=admin&action2=users&action3=editForm&id=' . (int)$_POST['id']);
                            }
                            redirect('index.php?action=admin&action2=users&action3=editForm&id=' . (int)$_POST['id']);
                        }
                        redirect('index.php?action=admin&action2=users&action3=editForm&id=' . (int)$_POST['id']);
                    }
                    redirect('index.php?action=admin&action2=users&action3=editForm&id=' . (int)$_POST['id']);
                }
                redirect('index.php?action=admin&action2=users&action3=editForm&id=' . (int)$_POST['id']);
            }
            //on redirectionne l'admin vers la liste des users
            redirect('index.php?action=admin&action2=users&action3=editForm&id=' . (int)$_POST['id']);
        }
    }

    //on redirectionne l'admin vers la liste des users
    redirect("index.php?action=admin&action2=users&action3=get");
}