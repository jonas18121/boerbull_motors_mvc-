<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/user/booking/UserBookingFormModel.php';
include_once 'model/panier/NewPanierModel.php';
require_once 'model/oneCar/OneCarModel.php';


//appel de la session
require_once 'aSession/UserSession.php';

//appel d'un fichier dans la librairie
require_once 'library/Tools.php';


// en $_GET
//A partir du routeur , bookingFormView() appelera les différente function 
function bookingFormView(){
    // On ne peut pas réserver sans être connecté !
    // sinon l'utilisateur sera renvoyer vers la page de connexion
    if(!isAuthenticatedUser()){
        redirect('index.php?action=user&action2=loginForm');
    }

    $session = array_keys($_SESSION['panier']);//recupère le ou les clé qui son dans la session panier

    $ClassPanier = new PanierModel();//instance de panier model
    $panier = $ClassPanier->PanierView($session); //appel de la fonction panierVie(), puis on le met dans la variable $panier
    $prix_total_TTC = $ClassPanier->prixTTC($session);

    
    
    if(!empty($session)){
        //appel de la fontion du model
        $oneCar = OneCarBooking($session);
    }else {
        $oneCar = '';
    }

    //appel de la vue
    require_once 'www/templates/user/booking/BookingFormView.phtml';
}




//en POST
//A partir du routeur , il appelera notre function userBookingForm()
function userBookingForm(){

    // On ne peut pas réserver sans être connecté !
    // sinon l'utilisateur sera renvoyer vers la page de connexion
    if(!isAuthenticatedUser()){
        redirect('index.php?action=user&action2=loginForm');
    }

    if(!empty($_POST)){
        if(array_key_exists('id',$_POST) && isset($_POST['id']) && ctype_digit($_POST['id'])){ 
            if(array_key_exists('user_i',$_POST) && isset($_POST['user_i']) && ctype_digit($_POST['user_i'])){ 
                if(array_key_exists('numberOfSeats',$_POST) && isset($_POST['numberOfSeats']) && ctype_digit($_POST['numberOfSeats'])){ 
                    if(array_key_exists('datetimepicker',$_POST) && isset($_POST['datetimepicker'])){  
                        if(array_key_exists('datetimepicker2',$_POST) && isset($_POST['datetimepicker2'])){ 

                            //récupération du compte client de l'utilisateur connecté
                            //$userId = getUserId();
                            $userId = (int)$_POST['user_i'];

                            //récupération id de ou des voitures selectionner
                            $car_id = (int)$_POST['id'];


                            // pre_var_dump('l 73 userBookingFormController.php', DateTime::createFromFormat('d/m/Y', date(substr($_POST['datetimepicker'], 0, 10))), true);
                            //Récupéré la date de debut jusqu'a 10 caractères, EX : 2019-06-21
                            $dateDebut = DateTime::createFromFormat('d/m/Y', date(substr($_POST['datetimepicker'], 0, 10)));

                            //récupéré les heures qui s'ajoutera après la date et s'affichera au 11èmes caractères 
                            $hourDebut = substr($_POST['datetimepicker'],11);

                            //pre_var_dump('l 79 UserBookingFormController.php', $dateDebut, true);


                            //Récupéré la date de fin jusqu'a 10 caractères, EX : 2019-06-21
                            //$dateFin = new DateTime(date(substr($_POST['datetimepicker2'], 0, 10)));
                            $dateFin = DateTime::createFromFormat('d/m/Y', date(substr($_POST['datetimepicker2'], 0, 10)));

                            //récupéré les heures qui s'ajoutera après la date et s'affichera au 11èmes caractères 
                            $hourFin = substr($_POST['datetimepicker2'],11);



                            //création de la reservation
                            addBooking($userId, $dateDebut->format('Y-m-d'), $hourDebut, $dateFin->format('Y-m-d'), $hourFin, (int)$_POST['numberOfSeats'], $car_id);

                            

                            $ClassPanier = new PanierModel(); 
                            $ClassPanier->deleteAll();


                            //redirection vers la page d'accueil
                            redirect('index.php');
                        }
                    }
                }
            }
        }
        redirect('index.php?action=user&action2=bookingForm&id='.  (int)$_POST['id'] );
    }


    
    //redirection vers la page d'accueil
    redirect('index.php');
}