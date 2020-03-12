<?php
require_once 'model/admin/booking/get/AdminGetBookingModel.php';
require_once 'aSession/AdminSession.php';
require_once 'library/Tools.php';


//en GET
/** afficher les RDV
 * @return void
 */
function adminGetBooking() : void
{
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }
    $adminFindBooking = findBooking();
    require_once 'www/templates/admin/booking/get/AdminGetBookingView.phtml';
} 