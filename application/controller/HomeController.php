<?php
//controlleur, mettre en relation le model et la vue 

//appel du model
require_once 'model/HomeModel.php';

//A partir du routeur , getHome() appelera notre function findHome()
function getHome(){

    //appel de la fontion du model
    $home = findHome();

    //appel de la vue
    require_once 'www/templates/HomeView.phtml';
}
