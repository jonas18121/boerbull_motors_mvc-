<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/oneCar/OneCarModel.php';

//A partir du routeur , getOneCar() appelera notre function OneCar()
function getOneCar(){

    //appel de la fontion du model
    $oneCar = OneCar((int)$_GET['id']);

    //appel de la vue
    require_once 'www/templates/oneCar/OneCarView.phtml';
}