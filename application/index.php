<?php
error_reporting(E_ALL);//renvois les erreurs
ini_set('display_errors', 1);

///////// inclure les controlleurs ///////////
require_once 'controller/HomeController.php';
require_once 'controller/category/CategoryController.php';
require_once 'controller/oneCar/OneCarController.php';
require_once 'controller/panier/PanierController.php';
require_once 'controller/tarif/TarifController.php';
require_once 'controller/aPropos/AProposController.php';

                            /////USER/////
require_once 'controller/user/login/UserLoginFormController.php';
require_once 'controller/user/register/UserRegisterFormController.php';
require_once 'controller/user/logout/UserLogoutController.php';
require_once 'controller/user/booking/UserBookingFormController.php';
require_once 'controller/user/booking/UserBookingController.php';
require_once 'controller/user/delete/UserDeleteSelfController.php';


                            /////ADMIN/////
require_once 'controller/admin/login/AdminLoginController.php';
require_once 'controller/admin/logout/AdminLogoutController.php';
require_once 'controller/admin/register/AdminRegisterController.php';
require_once 'controller/admin/delete/AdminDeleteSelfController.php';

                            //Admin User //
require_once 'controller/admin/users/get/AdminGetUsersController.php';
require_once 'controller/admin/users/add/AdminAddUsersController.php';
require_once 'controller/admin/users/edit/AdminEditUsersController.php';
require_once 'controller/admin/users/delete/AdminDeleteUsersController.php';
require_once 'controller/admin/users/booking/AdminBookingUsersController.php';
                            //Admin Car //
require_once 'controller/admin/car/get/AdminGetCarsController.php';
require_once 'controller/admin/car/add/AdminAddCarsController.php';
require_once 'controller/admin/car/delete/AdminDeleteCarsController.php';
require_once 'controller/admin/car/edit/AdminEditCarsController.php';
                            //Admin Booking //
require_once 'controller/admin/booking/get/AdminGetBookingController.php';
require_once 'controller/admin/booking/delete/AdminDeleteBookingController.php';


                    ///////// Routeur ///////////
try{
    if($_GET){
        if(isset($_GET['action']) && !empty($_GET['action'])){
            if(array_key_exists('action', $_GET) && ctype_alpha($_GET['action'])){

                //afficher l'acceuil
                if($_GET['action'] === 'home')
                {
                    getHome();// HomeController.php
                }
                //afficher les categories de voiture
                elseif($_GET['action'] === 'category'){

                    if(array_key_exists('id_category', $_GET)){

                        if(isset($_GET['id_category']) && !empty($_GET['id_category'])){

                            if(ctype_digit($_GET['id_category'])&& $_GET['id_category'] > 0)
                            {
                                getOneCategory();// CategoryController.php
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

                            if(ctype_digit($_GET['id'])&& $_GET['id'] > 0)
                            {
                                getOneCar();// OneCarController.php
                                
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

                            if(ctype_digit($_GET['id'])&& $_GET['id'] > 0)
                            {
                                panierAdd();//PanierController.php

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
                elseif($_GET['action'] === 'panierView')
                {
                    panierOpen();// PanierController.php
                }
                //connexion user // inscription user
                elseif($_GET['action'] === 'user'){

                    if(array_key_exists('action2', $_GET)){

                        if(isset($_GET['action2']) && !empty($_GET['action2'])){

                            //afficher un formulaire de connexion user
                            if(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'loginForm')
                            {
                                userLoginForm();//LoginController.php
                            } 
                            //connection user
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'login')
                            {  
                                userLogin();//UserLoginFormController.php
                            }
                            //afficher un formulaire d'inscription user
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'registerForm')
                            {
                                userRegisterForm();//UserRegisterFormController.php
                            }
                            //inscription user
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'register')
                            {  
                                userRegister();// UserRegisterFormController.php
                            }
                            //logout user
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'logout')
                            {  
                                userLougout();//UserLogoutController.php
                            }
                            // user supprime son compte
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'deleteUser'){
                                
                                if(array_key_exists('id', $_GET)){

                                    if(isset($_GET['id']) && !empty($_GET['id'])){ 

                                        if(ctype_digit($_GET['id'])&& $_GET['id'] > 0)
                                        { 
                                            userDeleteSelf();//UserDeleteSelfController.php
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
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'bookingForm')
                            {  
                                bookingFormView();//UserBookingFormController.php
                            }
                            // RDV confirmer
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'booking')
                            {  
                                userBookingForm();//UserBookingFormController.php
                            }
                            // Afficher les rendez-vous de user
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'userRDV'){ 

                                if(array_key_exists('user_i', $_GET)){

                                    if(isset($_GET['user_i']) && !empty($_GET['user_i'])){ 

                                        if(ctype_digit($_GET['user_i'])&& $_GET['user_i'] > 0)
                                        { 
                                            getRDV();// UserBookingController.php
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

                                        if(ctype_digit($_GET['id'])&& $_GET['id'] > 0)
                                        { 
                                            deleteRDV();//UserBookingController.php
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

                                        if(ctype_digit($_GET['id'])&& $_GET['id'] > 0)
                                        {
                                            deleteOneArticle();// PanierController.php
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
                elseif ($_GET['action'] === 'tarif') 
                {
                    getTarif();
                }
                // afficher le a propos de l'entreprise
                elseif ($_GET['action'] === 'aPropos') 
                {    
                    getAPropos();
                }
                //connexion admin // inscription admin
                elseif ($_GET['action'] === 'admin') {
                    
                    if(array_key_exists('action2', $_GET)){

                        if(isset($_GET['action2']) && !empty($_GET['action2'])){

                            //afficher un formulaire de connexion admin
                            if(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'loginForm')
                            {
                                adminLoginForm();//AdminLoginController.php
                            }
                            //connexion admin
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'loginAdmin')
                            {  
                                adminLogin();//AdminLoginController.php
                            }
                            //afficher un formulaire d'inscription admin
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'registerForm')
                            {
                                adminRegisterForm();// AdminRegisterController.php
                            }
                            //iscription admin
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'registerAdmin')
                            {  
                                adminRegister();//AdminRegisterController.php
                            }
                            //déconnexion admin
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'logout')
                            {  
                                adminLogout();//AdminLogoutController.php
                            }
                            //admin supprime son compte
                            elseif(ctype_alpha($_GET['action2']) && $_GET['action2'] === 'deleteAdmin'){  
    
                                if(array_key_exists('id', $_GET)){

                                    if(isset($_GET['id']) && !empty($_GET['id'])){ 

                                        if(ctype_digit($_GET['id'])&& $_GET['id'] > 0)
                                        { 
                                            adminDeleteSelf();//AdminDeleteSelfController.php
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
                                        if(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'addForm')
                                        {
                                            adminAddFormUsers();// AdminAddUserController.php
                                        }
                                        //admin ajoute users
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'add')
                                        {
                                            adminAddUsers();// AdminAddUserController.php
                                        }
                                        // afficher tous les users
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'get')
                                        {
                                            adminGetUsers();//AdminGetUsersController.php
                                        }
                                        // afficher le formulaire pour modifier un users
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'editForm'){
                                            
                                            if(array_key_exists('id', $_GET)){
                                                if(isset($_GET['id']) && !empty($_GET['id'])){ 
                                                    if(ctype_digit($_GET['id'])&& $_GET['id'] > 0)
                                                    {
                                                        adminEditFormUsers();//AdminEditFromUsersController.php
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
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'edit')
                                        {
                                            adminEditUsers();// AdminEditFromUsersController.php
                                        }
                                        // admin supprime un users
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'delete'){

                                            if(array_key_exists('id', $_GET)){

                                                if(isset($_GET['id']) && !empty($_GET['id'])){ 
            
                                                    if(ctype_digit($_GET['id'])&& $_GET['id'] > 0)
                                                    {
                                                        adminDeleteUsers();// AdminDeleteUsersController.php
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
            
                                                    if(ctype_digit($_GET['id'])&& $_GET['id'] > 0)
                                                    {
                                                        adminBookingFormUser();//AdminBookingUserController.php
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
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'bookingAdd')
                                        {
                                            adminAddBookingUser();// AdminBookingUserController.php         
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
                                        if(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'get')
                                        {
                                            adminGetCars();//AdminGetCarsController.php
                                        }
                                        //admin affiche un formulaire d'ajoute de cars
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'addForm')
                                        {
                                            adminAddFormCars();//AdminAddCarsController.php
                                        }
                                        //admin ajoute cars
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'add')
                                        {
                                            adminAddCars();//AdminAddCarsController.php
                                        }
                                        //admin supprime cars
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'delete'){

                                            if(array_key_exists('id', $_GET)){

                                                if(isset($_GET['id']) && !empty($_GET['id'])){ 
            
                                                    if(ctype_digit($_GET['id'])&& $_GET['id'] > 0)
                                                    {
                                                        adminDeleteCars();//AdminDeleteCarsController.php
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
            
                                                    if(ctype_digit($_GET['id'])&& $_GET['id'] > 0)
                                                    {
                                                        adminEditFormCars();//AdminEditFormController.php
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
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'edit')
                                        {
                                            adminEditCars();//AdminEditController.php
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
                                        if(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'get')
                                        {
                                            adminGetBooking();//AdminGetBookingController.php
                                        }
                                        //admin supprime un rendez-vous
                                        elseif(ctype_alpha($_GET['action3']) && $_GET['action3'] === 'delete'){

                                            if(array_key_exists('id', $_GET)){

                                                if(isset($_GET['id']) && !empty($_GET['id'])){ 
            
                                                    if(ctype_digit($_GET['id'])&& $_GET['id'] > 0)
                                                    {
                                                        adminDeleteBooking();//AdminDeleteBookingController.php
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
        // on appel par defaut,  getHome()
        getHome();
    }
}catch(Exception $e){
    $errorMessage = $e->getMessage();
    require_once 'www/templates/ErrorView.phtml';
}