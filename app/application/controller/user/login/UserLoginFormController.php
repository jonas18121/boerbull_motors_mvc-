<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/user/login/UserLoginFormModel.php';
require_once 'model/panier/NewPanierModel.php';

//appel de la session
require_once 'aSession/UserSession.php';

// en $_GET
function userLoginForm(){
    //appel de la vue
    require_once 'www/templates/user/login/UserLoginFormView.phtml';
}

// en $_POST
//A partir du routeur , userLogin() appelera notre function loginUser()
function userLogin(){

    //controle de formulaire en php
    if(!empty($_POST)){
        if(array_key_exists('password',$_POST) && isset($_POST['password']) && strlen($_POST['password']) >= 8){
            if(array_key_exists('mail',$_POST) && isset($_POST['mail'])){
                if(preg_match("/^[a-zA-Z][a-zA-Z0-9._-]{1,19}@[a-z]{4,7}\.[a-z]{2,3}$/", $_POST['mail'])){

                    //connection user
                    $login = loginUser((string)$_POST['mail'], (string)$_POST['password'] );
                    
                    //on crée la session
                    create((int)$login['id'], (string)$login['first_name'], (string)$login['last_name'], (string)$login['mail']);

                    //redirection à la page d'accueil
                    redirect('index.php');

                }else{
                    //si un controle n'est pas bon, redirection à la page de connexion
                    redirect('index.php?action=user&action2=loginForm'); 
                }
            }else{
                //si un controle n'est pas bon, redirection à la page de connexion
                redirect('index.php?action=user&action2=loginForm'); 
            }
        }else{
            //si un controle n'est pas bon, redirection à la page de connexion
            redirect('index.php?action=user&action2=loginForm'); 
        }
    }
    

    //si un controle n'est pas bon, redirection à la page de connexion
    redirect('index.php?action=user&action2=loginForm'); 
}