<?php
require_once 'model/admin/booking/delete/AdminDeleteBookingModel.php';
require_once 'aSession/AdminSession.php';
require_once 'aSession/AdminSession.php';
require_once 'library/Tools.php';


//en $_GET
//supprimer une voiture
function adminDeleteBooking() : void
{
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }
    deleteBookingAdmin((int)$_GET['id']);
    redirect("index.php?action=admin&action2=booking&action3=get");
}