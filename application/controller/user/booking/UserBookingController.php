<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/user/booking/UserBookingModel.php';
require_once 'model/panier/NewPanierModel.php';

//appel de la session
require_once 'aSession/UserSession.php';

//appel d'un fichier dans la librairie
require_once 'library/Tools.php';


//afficher les RDV
function getRDV(){

    // On ne peut pas afficher les réservations sans être connecté !
    // sinon l'utilisateur sera renvoyer vers la page de connexion
    if(!isAuthenticatedUser()){
        redirect('index.php?action=user&action2=loginForm');
    }

    //pour éviter que la session de l'utilisateur en cours, ait accès au RDV des autres utilisateurs   
    if(isset($_GET['user_i']) & $_GET['user_i'] ===  $_SESSION['user']['id'] ){
    
        $getBooking = getBooking((int)$_GET['user_i']);

        //appel de la vue
        require_once 'www/templates/user/booking/BookingView.phtml';
    }

    // si $_GET['user_i'] est différent , 
    //on remet $_SESSION['user']['id'] dans $_GET['user_i'] pour afficher le bon resultat
    $_GET['user_i'] = $_SESSION['user']['id'];
    $getBooking = getBooking((int)$_GET['user_i']);


    //appel de la vue
    require_once 'www/templates/user/booking/BookingView.phtml';
}




//effacer un RDV
function deleteRDV(){
    // On ne peut pas effacer les réservations sans être connecté !
    // sinon l'utilisateur sera renvoyer vers la page de connexion
    if(!isAuthenticatedUser()){
        redirect('index.php?action=user&action2=loginForm');
    }
    
    deleteBooking((int)$_GET['id']);

    redirect('index.php?action=user&action2=userRDV&user_i='. getUserId());
}

