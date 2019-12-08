<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/admin/car/edit/AdminEditCarsModel.php';

//appel de la session
require_once 'aSession/AdminSession.php';

//appel du fichier dans la librairie
require_once 'library/Tools.php';


//en GET$
//affiche le formulaire de modification de car
function adminEditFormCars(){

    //si le admin n'est pas connecter au le renvois a l'accueil
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }

    // Avec $_GET, on recupère la valeur de l'id qui est dans l'url 
    $adminEditFormCars = editFormCars((int)$_GET['id']);

    //appel de la vue
    require_once 'www/templates/admin/car/edit/AdminEditCarsView.phtml';
} 




//en POST
//admin modifie une voiture
function adminEditCars(){

    //si le admin n'est pas connecter au le renvois a l'accueil
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }
    

    if(!empty($_POST)){
        if(array_key_exists('id',$_POST) && isset($_POST['id']) && ctype_digit($_POST['id'])){ 
            if(array_key_exists('marque',$_POST) && isset($_POST['marque']) && strlen($_POST['marque']) >= 2 && strlen($_POST['marque']) <= 25){ //var_dump($_POST);die;
                if(array_key_exists('modele',$_POST) && isset($_POST['modele']) && strlen($_POST['modele']) >= 2 && strlen($_POST['modele']) <= 35){ 
                    if(array_key_exists('annee',$_POST) && isset($_POST['annee']) && ctype_digit($_POST['annee']) && strlen($_POST['annee']) === 4){ 
                        if(array_key_exists('conso',$_POST) && isset($_POST['conso']) && ctype_digit($_POST['conso']) && strlen($_POST['conso']) < 4){
                            if(array_key_exists('color',$_POST) && isset($_POST['color']) && ctype_alpha($_POST['color'])){
                                if(array_key_exists('prix_trois_jours',$_POST) && isset($_POST['prix_trois_jours']) && ctype_digit($_POST['prix_trois_jours']) && strlen($_POST['prix_trois_jours']) < 5){ 
                                    if(array_key_exists('puissance',$_POST) && isset($_POST['puissance']) && ctype_digit($_POST['puissance']) && strlen($_POST['puissance']) < 5){
                                        if(array_key_exists('moteur',$_POST) && isset($_POST['moteur'])){ 
                                            if(array_key_exists('carburant',$_POST) && isset($_POST['carburant']) && ctype_alpha($_POST['carburant'])){ 
                                                if(array_key_exists('cent',$_POST) && isset($_POST['cent']) && ctype_digit($_POST['cent'])){ 
                                                    if(array_key_exists('nombre_de_place',$_POST) && isset($_POST['nombre_de_place']) && ctype_digit($_POST['nombre_de_place']) && strlen($_POST['nombre_de_place']) === 1){  
                                                        if(array_key_exists('id_category',$_POST) && isset($_POST['id_category']) && ctype_digit($_POST['id_category']) && strlen($_POST['id_category']) === 1){ 
                                                        
                                                            editCars((string)$_POST['marque'], (string)$_POST['modele'], (int)$_POST['annee'], (int)$_POST['conso'], (string)$_POST['color'], (int)$_POST['prix_trois_jours'], (int)$_POST['puissance'], $_POST['moteur'], (string)$_POST['carburant'], (int)$_POST['cent'], (int)$_POST['nombre_de_place'], (int)$_POST['id_category'], (int)$_POST['id']);

                                                            //on redirectionne l'admin vers la liste des users
                                                            redirect("index.php?action=admin&action2=car&action3=get");
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            redirect('index.php?action=admin&action2=car&action3=editForm&id=' . (int)$_POST['id']);
        }
    }
    
    //on redirectionne l'admin vers la liste des users
    redirect("index.php?action=admin&action2=car&action3=get");

}