<?php
require_once 'config/DataBase.php';
require_once 'library/Tools.php';

//en GET 
/** Afficher un seul user 
 * 
 * @param int
 * @return array
*/
function GetUser(int $id) : array 
{    
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "SELECT * FROM user WHERE id = :id";

    $getUser = $db->prepare($sql);
    $getUser->execute([':id' => $id]);
    $getUser = $getUser->fetch();

    if(empty($getUser)){
        redirect("index.php");
    }
    return $getUser;
}

//en POST
/** admin ajoute un RDV pour un user 
 * 
 * @param int
 * @param string
 * @param string
 * @param string
 * @param string
 * @param int
 * 
 * @return void
*/
function adminAddBooking(int $user_id, string $booking_date_debut, string $booking_time_debut, string $booking_date_fin, string $booking_time_fin, int $number_of_seats) : void
{
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "INSERT INTO booking (user_i, booking_date_debut, booking_time_debut, booking_date_fin, booking_time_fin, number_of_seats, created_at ) 
    VALUES(:user_i, :booking_date_debut, :booking_time_debut, :booking_date_fin, :booking_time_fin, :number_of_seats, NOW())";

    $adminAddBooking = $db->prepare($sql);
    $adminAddBooking->execute([
        ':user_i'               => $user_id, 
        ':booking_date_debut'   => $booking_date_debut, 
        ':booking_time_debut'   => $booking_time_debut,
        ':booking_date_fin'     => $booking_date_fin, 
        ':booking_time_fin'     => $booking_time_fin,
        ':number_of_seats'      => $number_of_seats
    ]);
}