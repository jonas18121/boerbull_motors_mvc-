<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/user/register/UserRegisterFormModel.php';


//appel d'un fichier dans la librairie
require_once 'library/Tools.php';

//en $_GET
function userRegisterForm(){
    //appel de la vue
    require_once 'www/templates/user/register/UserRegisterFormView.phtml';
}

//$_POST
//A partir du routeur , il appelera notre function userRegisterFormOk()
function userRegister(){

    //controle de formulaire en php
    if(!empty($_POST)){
        if(array_key_exists('first_name',$_POST) && isset($_POST['first_name']) && ctype_alpha($_POST['first_name'])){
            if( strlen($_POST['first_name']) >= 2 && strlen($_POST['first_name']) <= 40){
                if(array_key_exists('last_name',$_POST) && isset($_POST['last_name']) && ctype_alpha($_POST['first_name'])){
                    if(strlen($_POST['first_name']) >= 2 && strlen($_POST['first_name']) <= 40){
                        if(array_key_exists('password',$_POST) && isset($_POST['password']) && strlen($_POST['password']) >= 8){
                            if(array_key_exists('mail',$_POST) && isset($_POST['mail'])){
                                if(preg_match("/^[a-zA-Z][a-zA-Z0-9._-]{1,19}@[a-z]{4,7}\.[a-z]{2,3}$/", $_POST['mail'])){

                                    //si tous les controles sont bon
                                    //inscription user
                                    registerUser((string)$_POST['first_name'] , (string)$_POST['last_name'], (string)$_POST['mail'], (string)$_POST['password']);

                                    //redirection à la page de connexion pour user 
                                    redirect('index.php?action=user&action2=loginForm');
                                } 
                            }
                        }
                    }
                }
            }
        } 
    }
    
  
    // s'il y a un controle qui n'est pas bon, on redirectionne à la page d' inscription pour user
    redirect('index.php?action=user&action2=registerForm');
}