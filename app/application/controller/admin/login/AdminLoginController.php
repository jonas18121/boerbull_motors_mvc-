<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/admin/login/AdminLoginModel.php';

//appel de la session
require_once 'aSession/AdminSession.php';



// en $_GET
function adminLoginForm(){
    //appel de la vue
    require_once 'www/templates/admin/login/AdminLoginFormView.phtml';
}



// en $_POST
//A partir du routeur , il appelera notre function adminLogin()
function adminLogin(){


    //controle de formulaire en php
    if(!empty($_POST)){
        if(array_key_exists('password',$_POST) && isset($_POST['password']) && strlen($_POST['password']) >= 8){
            if(array_key_exists('mail',$_POST) && isset($_POST['mail'])){
                if(preg_match("/^[a-zA-Z][a-zA-Z0-9._-]{1,19}@[a-z]{4,7}\.[a-z]{2,3}$/", $_POST['mail'])){

                    //connection admin
                    $login = loginAdmin((string)$_POST['mail'], (string)$_POST['password']);
                    //on crée la session
                    adminCreate((int)$login['id'], (string)$login['name'], (string)$login['mail']);
                    //redirection à la page d'accueil
                    redirect('index.php');
                }
            }
        }
    }

    //si un controle n'est pas bon, redirection à la page de connexion
    redirect('index.php?action=admin&action2=loginForm'); 
    
}