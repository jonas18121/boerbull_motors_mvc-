<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/admin/register/AdminRegisterModel.php';


//appel d'un fichier dans la librairie
require_once 'library/Tools.php';



//en $_GET
function adminRegisterForm(){
    //appel de la vue
    require_once 'www/templates/admin/register/AdminRegisterFormView.phtml';
}




//$_POST
//A partir du routeur , adminRegister() appelera notre function  registerAdmin()
function adminRegister(){


    //controle de formulaire en php
    if(!empty($_POST)){
        if(array_key_exists('name',$_POST) && isset($_POST['name']) && ctype_alpha($_POST['name'])){
            if(strlen($_POST['name']) >= 2 && strlen($_POST['name']) <= 25){
                if(array_key_exists('password',$_POST) && isset($_POST['password']) && strlen($_POST['password']) >= 8){
                    if(array_key_exists('mail',$_POST) && isset($_POST['mail'])){
                        if(preg_match("/^[a-zA-Z][a-zA-Z0-9._-]{1,19}@[a-z]{4,7}\.[a-z]{2,3}$/", $_POST['mail'])){

                            //inscription admin
                            registerAdmin((string)$_POST['name'], (string)$_POST['mail'], (string)$_POST['password']);
                            //redirection à la page de connexion pour admin
                            redirect('index.php?action=admin&action2=loginForm');
                        }  
                    }
                }
            }
        }
    }
  
    // s'il y a un controle qui n'est pas bon, on redirectionne à la page d' inscription pour admin
    redirect('index.php?action=admin&action2=registerForm');
    
}