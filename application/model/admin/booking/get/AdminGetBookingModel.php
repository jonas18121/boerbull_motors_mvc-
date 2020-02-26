<?php
require_once 'config/DataBase.php';

/** Afficher tous les cars 
 * @return array
*/
function findBooking() : array
{    
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT booking.id, booking_date_debut, booking_time_debut, booking_date_fin, booking_time_fin, number_of_seats, user_i, last_name, first_name, mail 
        FROM booking 
        INNER JOIN user ON user.id = booking.user_i ";
    $adminGetBooking = $db->query($sql);
    $adminGetBooking = $adminGetBooking->fetchAll();
    return $adminGetBooking;
}