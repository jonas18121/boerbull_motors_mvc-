<?php
// le router

//renvois les erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

///////// inclure les controlleurs ///////////
require_once 'controller/HomeController.php';//inclure HomeController.php
require_once 'controller/category/CategoryController.php';//inclure CategoryController.php
require_once 'controller/oneCar/OneCarController.php';//inclure OneCarController.php
require_once 'controller/panier/PanierController.php';//inclure PanierController.php
require_once 'controller/tarif/TarifController.php';//inclure TarifController.php
require_once 'controller/aPropos/AProposController.php';//inclure AProposController.php

                            /////USER/////
require_once 'controller/user/login/UserLoginFormController.php';//inclure UserLoginFormController.php
require_once 'controller/user/register/UserRegisterFormController.php';//inclure UserRgisterFormController.php
require_once 'controller/user/logout/UserLogoutController.php';//inclure PanierController.php
require_once 'controller/user/booking/UserBookingFormController.php';//inclure UserBookingFormController.php
require_once 'controller/user/booking/UserBookingController.php';//inclure UserBookingFormController.php
require_once 'controller/user/delete/UserDeleteSelfController.php';//inclure UserDeleteSelfController.php


                            /////ADMIN/////
require_once 'controller/admin/login/AdminLoginController.php';//inclure AdminLoginController.php
require_once 'controller/admin/logout/AdminLogoutController.php';//inclure AdminLogoutController.php
require_once 'controller/admin/register/AdminRegisterController.php';//inclure AdminRegisterController.php
require_once 'controller/admin/delete/AdminDeleteSelfController.php';//inclure AdminDeleteSelfController.php

                            //Admin User //
require_once 'controller/admin/users/get/AdminGetUsersController.php';//inclure AdminUsersController.php
require_once 'controller/admin/users/add/AdminAddUsersController.php';//inclure AdminAddUserController.php
require_once 'controller/admin/users/edit/AdminEditUsersController.php';//inclure AdminEditFromController.php
require_once 'controller/admin/users/delete/AdminDeleteUsersController.php';//inclure AdminDeleteController.php
require_once 'controller/admin/users/booking/AdminBookingUsersController.php';//inclure AdminBookingUsersController.php
                            //Admin Car //
require_once 'controller/admin/car/get/AdminGetCarsController.php';//inclure AdminGetCarsController.php
require_once 'controller/admin/car/add/AdminAddCarsController.php';//inclure AdminAddCarsController.php
require_once 'controller/admin/car/delete/AdminDeleteCarsController.php';//inclure AdminDeleteCarsController.php
require_once 'controller/admin/car/edit/AdminEditCarsController.php';//inclure AdminEditCarsController.php
                            //Admin Booking //
require_once 'controller/admin/booking/get/AdminGetBookingController.php';//inclure AdminEditBookingController.php
require_once 'controller/admin/booking/delete/AdminDeleteBookingController.php';//inclure AdminDeleteBookingController.php

// le bloc try catch sevira pour renvoyer les erreurs, s'il y en a 
try{
    if($_GET){
        if(isset($_GET['action']) && !empty($_GET['action'])){
            if(array_key_exists('action', $_GET) && ctype_alpha($_GET['action'])){

                //afficher l'acceuil
                if($_GET['action'] === 'home'){
                    //si tous les controles sont réussi , on appel getHome() qui est dans HomeController.php
                    getHome();
                }
                //afficher les categories de voiture
                elseif($_GET['action'] === 'category'){

                    if(array_key_exists('id_category', $_GET)){

                        if(isset($_GET['id_category']) && !empty($_GET['id_category'])){

                            if(ctype_digit($_GET['id_category'])&& $_GET['id_category'] > 0){
                                //si tous les controles sont réussi , on appel getOneCategory() qui est dans CategoryController.php
                                getOneCategory();

                            }else{
                                //ont lance une erreur, s'il a pas de id_category
                                throw new Exception("Erreur : Tous les champs ne sont pas rempli !"); 
                            }
                        }else{
                            getHome();
                        }
                    }else{
                        getHome();
                    }
                }
                //afficher une seule voiture
                elseif($_GET['action'] === 'oneCar'){

                    if(array_key_exists('id', $_GET)){

                        if(isset($_GET['id']) && !empty($_GET['id'])){

                            if(ctype_digit($_GET['id'])&& $_GET['id'] > 0){
        
                                //si tous les controles sont réussi , on appel getOneCar() qui est dans OneCarController.php
                                getOneCar();
                                
                            }else{
                                //ont lance une erreur, s'il a pas de id_category
                                throw new Exception("Erreur : Tous les champs ne sont pas rempli !"); 
                            }
                        }else{
                            getHome();
                        }
                    }else{
                        getHome();
                    }
                }
                //ajouter un element dans le panier et afficher ce qu'il y a dans le panier
                elseif($_GET['action'] === 'panier'){

                    if(array_key_exists('id', $_GET)){

                        if(isset($_GET['id']) && !empty($_GET['id'])){

                            if(ctype_digit($_GET['id'])&& $_GET['id'] > 0){

                                //si tous les controles sont réussi , on appel panierAdd() qui est dans PanierController.php
                                panierAdd();

                            }else{
                                getHome();
                            }
                        }else{
                            getHome();
                        }
                    }else{
                        getHome();
                    }
                }
                //afficher ce qu'il y a dans le panier
                elseif($_GET['action'] === 'panierView'){
                    //si tous les controles sont réussi , on appel PanierView() qui est dans PanierController.php
                    panierOpen();
                }
                //connexion user // inscription user
                elseif($_GET['action'] === 'user'){

                    if(array_key_exists('action2', $_GET)){

                        if(isset($_GET['action2']) && !empty($_GET['action2'])){

                            //afficher un formulaire de connexion user
                            if(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'loginForm'){
                                //si tous les controles sont réussi , on appel userLoginForm() qui est dans LoginController.php
                                userLoginForm();
                            } 
                            //connection user
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'login'){  
                                //si tous les controles sont réussi , on appel userLoginFormOk() qui est dans UserLoginFormController.php
                                userLogin();
                            }
                            //afficher un formulaire d'inscription user
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'registerForm'){
                                //si tous les controles sont réussi , on appel  userRegisterForm() qui est dans UserRegisterFormController.php
                                userRegisterForm();

                            }
                            //inscription user
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'register'){  
                                //si tous les controles sont réussi , on appel userRegisterFormOk() qui est dans UserRegisterFormController.php
                                userRegister();
                            }
                            //logout user
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'logout'){  
                                //si tous les controles sont réussi , on appel  userLougout() qui est dans UserLogoutController.php
                                userLougout();
                            }
                            // user supprime son compte
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'deleteUser'){
                                
                                if(array_key_exists('id', $_GET)){

                                    if(isset($_GET['id']) && !empty($_GET['id'])){ 

                                        if(ctype_digit($_GET['id'])&& $_GET['id'] > 0){ 
                                            //si tous les controles sont réussi , on appel  userDeleteSelf() qui est dans UserDeleteSelfController.php
                                            userDeleteSelf();
                                        }else{
                                            getHome();
                                        }
                                    }else{
                                        getHome();
                                    }
                                }else{
                                    getHome();
                                }
                            }
                            //prendre un RDV , affiche form
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'bookingForm'){  
                                //si tous les controles sont réussi , on appel userBookingForm() qui est dans UserBookingFormController.php
                                bookingFormView();
                            }
                            // RDV confirmer
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'booking'){  
                                //si tous les controles sont réussi , on appel userBookingForm() qui est dans UserBookingFormController.php
                                userBookingForm();
                            }
                            // Afficher les rendez-vous de user
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'userRDV'){ 

                                if(array_key_exists('user_i', $_GET)){

                                    if(isset($_GET['user_i']) && !empty($_GET['user_i'])){ 

                                        if(ctype_digit($_GET['user_i'])&& $_GET['user_i'] > 0){ 
                                            //si tous les controles sont réussi , on appel getRDV() qui est dans UserBookingController.php
                                            getRDV();
                                        }else{
                                            getHome();
                                        }
                                    }else{
                                        getHome();
                                    }
                                }else{
                                    getHome();
                                }
                            }
                            // user effacer un rendez-vous
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'deleteOneBooking'){ 

                                if(array_key_exists('id', $_GET)){

                                    if(isset($_GET['id']) && !empty($_GET['id'])){ 

                                        if(ctype_digit($_GET['id'])&& $_GET['id'] > 0){ 
                                            //si tous les controles sont réussi , on appel getRDV() qui est dans UserBookingController.php
                                            deleteRDV();
                                        }else{
                                            getHome();
                                        }
                                    }else{
                                        getHome();
                                    }
                                }else{
                                    getHome();
                                }
                            }
                            // effacer un article dans le panier 
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'deleteOneArticle'){ 

                                if(array_key_exists('id', $_GET)){

                                    if(isset($_GET['id']) && !empty($_GET['id'])){ 

                                        if(ctype_digit($_GET['id'])&& $_GET['id'] > 0){
                                            //si tous les controles sont réussi , on appel deleteOneArticle() qui est dans PanierController.php
                                            deleteOneArticle();
                                        }else{
                                            getHome();
                                        }
                                    }else{
                                        getHome();
                                    }
                                }else{
                                    getHome();
                                }
                            }
                            else{
                                getHome();
                            } 
                        }
                        else{
                            getHome();
                        }
                    }
                    else{
                        getHome();
                    }
                }
                // afficher le tarif de toute les voitures
                elseif ($_GET['action'] === 'tarif') {
                    
                    getTarif();
                }
                // afficher le a propos de l'entreprise
                elseif ($_GET['action'] === 'aPropos') {
                    
                    getAPropos();
                }
                //connexion admin // inscription admin
                elseif ($_GET['action'] === 'admin') {
                    
                    if(array_key_exists('action2', $_GET)){

                        if(isset($_GET['action2']) && !empty($_GET['action2'])){

                            //afficher un formulaire de connexion admin
                            if(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'loginForm'){
                                //si tous les controles sont réussi , on appel loginFormView() qui est dans AdminLoginController.php
                                adminLoginForm();
                            }
                            //connexion admin
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'loginAdmin'){  
                                //si tous les controles sont réussi , on appel adminLogin() qui est dans AdminLoginController.php
                                adminLogin();
                            }
                            //afficher un formulaire d'inscription admin
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'registerForm'){
                                //si tous les controles sont réussi , on appel adminRegisterForm() qui est dans AdminRegisterController.php
                                adminRegisterForm();
                            }
                            //iscription admin
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'registerAdmin'){  
                                //si tous les controles sont réussi , on appel adminRegister() qui est dans AdminRegisterController.php
                                adminRegister();
                            }
                            //déconnexion admin
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'logout'){  
    
                                //si tous les controles sont réussi , on appel adminLogout() qui est dans AdminLogoutController.php
                                adminLogout();
                            }
                            //admin supprime son compte
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'deleteAdmin'){  
    
                                if(array_key_exists('id', $_GET)){

                                    if(isset($_GET['id']) && !empty($_GET['id'])){ 

                                        if(ctype_digit($_GET['id'])&& $_GET['id'] > 0){ 

                                            //si tous les controles sont réussi , on appel adminDelete() qui est dans AdminDeleteSelfController.php
                                            adminDeleteSelf();
                                        }else{
                                            getHome();
                                        }
                                    }else{
                                        getHome();
                                    }
                                }else{
                                    getHome();
                                }
                            }
                            //admin CRUD user
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'users'){  
    
                                if(array_key_exists('action3', $_GET)){

                                    if(isset($_GET['action3']) && !empty($_GET['action3'])){
            
                                        //admin affiche un formulaire d'ajoute de users
                                        if(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'addForm'){
                                            //si tous les controles sont réussi , on appel adminAddFormUsers() qui est dans AdminAddUserController.php
                                            adminAddFormUsers();
                                        }
                                        //admin ajoute users
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'add'){
                                            //si tous les controles sont réussi , on appel adminAddUsers() qui est dans AdminAddUserController.php
                                            adminAddUsers();
                                        }
                                        // afficher tous les users
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'get'){

                                            //si tous les controles sont réussi , on appel adminGetUsers() qui est dans AdminGetUsersController.php
                                            adminGetUsers();
                                        }
                                        // afficher le formulaire pour modifier un users
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'editForm'){
                                            
                                            if(array_key_exists('id', $_GET)){
                                                if(isset($_GET['id']) && !empty($_GET['id'])){ 
                                                    if(ctype_digit($_GET['id'])&& $_GET['id'] > 0){
                                                        //si tous les controles sont réussi , on appel adminEditFromUsers() qui est dans AdminEditFromUsersController.php
                                                        adminEditFormUsers();
                                                    }else{
                                                        getHome();
                                                    }
                                                }else{
                                                    getHome();
                                                }
                                            }else{
                                                getHome();
                                            }
                                        }
                                        // admin modifie un users
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'edit'){
                                            //si tous les controles sont réussi , on appel adminEditUsers() qui est dans AdminEditFromUsersController.php
                                            adminEditUsers();
                                        }
                                        // admin supprime un users
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'delete'){

                                            if(array_key_exists('id', $_GET)){

                                                if(isset($_GET['id']) && !empty($_GET['id'])){ 
            
                                                    if(ctype_digit($_GET['id'])&& $_GET['id'] > 0){

                                                        //si tous les controles sont réussi , on appel adminDeleteUsers() qui est dans AdminDeleteUsersController.php
                                                        adminDeleteUsers();
                                                    }else{
                                                        getHome();
                                                    }
                                                }else{
                                                    getHome();
                                                }
                                            }else{
                                                getHome();
                                            }
                                        }
                                        // admin affiche formulaire du booking pour pouvoir ajouter un RDV
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'bookingForm'){

                                            if(array_key_exists('id', $_GET)){

                                                if(isset($_GET['id']) && !empty($_GET['id'])){ 
            
                                                    if(ctype_digit($_GET['id'])&& $_GET['id'] > 0){

                                                        //si tous les controles sont réussi , on appel adminBookingFormUser() qui est dans AdminBookingUserController.php
                                                        adminBookingFormUser();
                                                    }else{
                                                        getHome();
                                                    }
                                                }else{
                                                    getHome();
                                                }
                                            }else{
                                                getHome();
                                            }       
                                        }
                                        // admin ajoute un RDV pour un user
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'bookingAdd'){
                                            //si tous les controles sont réussi , on appel adminBookingUser() qui est dans AdminBookingUserController.php
                                            adminAddBookingUser();
                                                          
                                        }else{
                                            getHome();
                                        }
                                    }else{
                                        getHome();
                                    }
                                }else{
                                    getHome();
                                }   
                            }
                            //admin CRUD car
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'car'){

                                if(array_key_exists('action3', $_GET)){

                                    if(isset($_GET['action3']) && !empty($_GET['action3'])){
            
                                        //admin affiche tous les voitures
                                        if(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'get'){

                                            //si tous les controles sont réussi , on appel adminGetCars() qui est dans AdminGetCarsController.php
                                            adminGetCars();
                                        }
                                        //admin affiche un formulaire d'ajoute de cars
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'addForm'){

                                            //si tous les controles sont réussi , on appel adminAddFormCars() qui est dans AdminAddCarsController.php
                                            adminAddFormCars();
                                        }
                                        //admin ajoute cars
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'add'){

                                            //si tous les controles sont réussi , on appel adminAddCars() qui est dans AdminAddCarsController.php
                                            adminAddCars();
                                        }
                                        //admin supprime cars
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'delete'){

                                            if(array_key_exists('id', $_GET)){

                                                if(isset($_GET['id']) && !empty($_GET['id'])){ 
            
                                                    if(ctype_digit($_GET['id'])&& $_GET['id'] > 0){

                                                        //si tous les controles sont réussi , on appel adminDeleteCars() qui est dans AdminDeleteCarsController.php
                                                        adminDeleteCars();
                                                    }else{
                                                        getHome();
                                                    }
                                                }else{
                                                    getHome();
                                                }
                                            }else{
                                                getHome();
                                            }
                                        }
                                        //admin affiche un formulaire pour modifier un car
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'editForm'){

                                            if(array_key_exists('id', $_GET)){

                                                if(isset($_GET['id']) && !empty($_GET['id'])){ 
            
                                                    if(ctype_digit($_GET['id'])&& $_GET['id'] > 0){

                                                        //si tous les controles sont réussi , on appel adminEditFormCars() qui est dans AdminEditFormController.php
                                                        adminEditFormCars();
                                                    }else{
                                                        getHome();
                                                    }
                                                }else{
                                                    getHome();
                                                }
                                            }else{
                                                getHome();
                                            }
                                        }
                                        //admin  modifier un car
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'edit'){

                                            //si tous les controles sont réussi , on appel adminEditCars() qui est dans AdminEditController.php
                                            adminEditCars();

                                        }else{
                                            getHome();
                                        }
                                    }else{
                                        getHome();
                                    }
                                }else{
                                    getHome();
                                }
                            }
                            //admin CRUD booking
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'booking'){

                                if(array_key_exists('action3', $_GET)){

                                    if(isset($_GET['action3']) && !empty($_GET['action3'])){
            
                                        //admin affiche tous les rendez-vous
                                        if(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'get'){

                                            //si tous les controles sont réussi , on appel adminGetBooking() qui est dans AdminGetBookingController.php
                                            adminGetBooking();
                                        }
                                        //admin supprime un rendez-vous
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'delete'){

                                            if(array_key_exists('id', $_GET)){

                                                if(isset($_GET['id']) && !empty($_GET['id'])){ 
            
                                                    if(ctype_digit($_GET['id'])&& $_GET['id'] > 0){

                                                        //si tous les controles sont réussi , on appel adminDeleteBooking() qui est dans AdminDeleteBookingController.php
                                                        adminDeleteBooking();
                                                    }else{
                                                        getHome();
                                                    }
                                                }else{
                                                    getHome();
                                                }
                                            }else{
                                                getHome();
                                            }
                                        }else{
                                            getHome();
                                        }
                                    }else{
                                        getHome();
                                    }
                                }else{
                                    getHome();
                                }
                            }else{
                                getHome();
                            }
                        }else{
                            getHome();
                        }
                    }else{
                        getHome();
                    }
                }
                else{
                    getHome();
                }
            }
            else{
                getHome();
            }
        }
        else{
            // on appel par defaut,  getHome() qui est dans HomeController.php
            //si les valeurs du paramètre action ne sont pas bonnes
            getHome();
        }
    }
    else{
        // on appel par defaut,  getHome() qui est dans HomeController.php
        getHome();
    }
}catch(Exception $e){
    $errorMessage = $e->getMessage();
    require_once 'www/templates/ErrorView.phtml';
}

