<?php
//controlleur mettre en relation le model et la vue 

//appel de le session user
require_once 'aSession/UserSession.php';

function userLougout(){

    //on appel userDestroy() qui est dans UserSession.php
    userDestroy();

    //puis on ce redire vers l'accueil
    redirect('index.php');
}

