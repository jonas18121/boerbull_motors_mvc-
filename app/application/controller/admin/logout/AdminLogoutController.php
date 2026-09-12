<?php
//controlleur mettre en relation le model et la vue 

//appel de le session user
require_once 'aSession/AdminSession.php';

//appel d'un fichier dans la librairie
require_once 'library/Tools.php';

function  adminLogout(){

    //on appel destroy() qui est dans AdminSession.php
    Admindestroy();

    //puis on ce redire vers l'accueil
    redirect('index.php');
}