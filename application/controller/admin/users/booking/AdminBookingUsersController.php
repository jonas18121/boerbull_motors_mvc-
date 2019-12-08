<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/admin/users/booking/AdminBookingUserModel.php';

//appel de la session
require_once 'aSession/AdminSession.php';

//appel d'un fichier dans la librairie
require_once 'library/Tools.php';


//en $_GET
//affiche le formulaire booking
function adminBookingFormUser(){

    //si le admin n'est pas connecter au le renvois a l'accueil
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }

    $user = GetUser($_GET['id']);

    //appel de la vue
    require_once 'www/templates/admin/users/booking/AdminBookingUserView.php';
}



//en $_POST
//ajoute un RDV pour un user
function adminAddBookingUser(){

    //si le admin n'est pas connecter au le renvois a l'accueil
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }

    if(!empty($_POST)){
        if(array_key_exists('user_i',$_POST) && isset($_POST['user_i']) && ctype_digit($_POST['user_i'])){
            if(array_key_exists('booking_date_debut',$_POST) && isset($_POST['booking_date_debut'])){  
                if(array_key_exists('booking_time_debut',$_POST) && isset($_POST['booking_time_debut'])){ 
                    if(array_key_exists('booking_date_fin',$_POST) && isset($_POST['booking_date_fin'])){  
                        if(array_key_exists('booking_time_fin',$_POST) && isset($_POST['booking_time_fin'])){ 
                            if(array_key_exists('number_of_seats',$_POST) && isset($_POST['number_of_seats']) && ctype_digit($_POST['number_of_seats'])){ 
                
                                adminAddBooking($_POST['user_i'], $_POST['booking_date_debut'], $_POST['booking_time_debut'], $_POST['booking_date_fin'], $_POST['booking_time_fin'], $_POST['number_of_seats']);

                                redirect("index.php?action=admin&action2=users&action3=get");
                            }
                        }
                    }
                }
            }
        }
    }

    
    redirect("index.php");
} 