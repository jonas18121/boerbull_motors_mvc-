<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/tarif/TarifModel.php';

//A partir du routeur , getTarif() appelera notre function getTarifs()
function getTarif(){

    $tarifView = getTarifs();

    require_once 'www/templates/tarif/TarifView.phtml';
}