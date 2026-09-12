<?php
//model , gestion de la base de donnée

//inclure la bdd
require_once 'config/DataBase.php';


/** pour la reservation 
 * 
 * @param int/string/dateTime
 * 
 * @return void
*/
function addBooking($user_id, $booking_date_debut, $booking_time_debut, $booking_date_fin, $booking_time_fin, $number_of_seats, $car_id){
    //connexion à la bdd
    $db = new Database;
    $db = $db->dbConnect();

    $sql = "INSERT INTO booking (user_i, booking_date_debut, booking_time_debut, booking_date_fin, booking_time_fin, number_of_seats, car_id, created_at )
                VALUES(:user_i, :booking_date_debut, :booking_time_debut, :booking_date_fin, :booking_time_fin, :number_of_seats, :car_id, NOW())";

    //Insertion de la réservation dans la base de données.
    $addBooking = $db->prepare($sql);
    $addBooking->execute([
        ':user_i' => $user_id, 
        ':booking_date_debut' => $booking_date_debut, 
        ':booking_time_debut' => $booking_time_debut,
        ':booking_date_fin' => $booking_date_fin, 
        ':booking_time_fin' => $booking_time_fin,
        ':number_of_seats' => $number_of_seats,
        ':car_id' => $car_id
    ]);
}


