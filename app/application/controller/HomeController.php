<?php
require_once 'model/HomeModel.php';

/**
 * Appel le model HomeModel.php
 */
function getHome() : void
{
    $home = findHome();
    require_once 'www/templates/HomeView.phtml';
}
