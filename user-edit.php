<?php
require 'include/connectdb.php';

// $ReservationId = $_POST['id'];
// $nGuest = $_POST['n-guest'];
// $checkin = $_POST['checkin'];
// $checkout = $_POST['checkout'];
// $room_Id = $_POST['room-id'];
// $fname = $_POST['fname'];
// $lname = $_POST['lname'];
// $email = $_POST['email'];


$sql = "UPDATE Reservation 
        JOIN Room ON Room.Room_Id = Reservation.Room_Id
        JOIN users ON users.Id = Reservation.users_Id
        SET Reservation.Number_Guest = :ng, Reservation.Checkin = :checkin, Reservation.Checkout = :checkout, 
        Reservation.Room_Id = :room_id, 
        users.fname = :fn, users.lname = :ln, users.Email = :email
        WHERE Reservation.Reservation_Id ='" . $_POST['id'] . "'";

    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':ng' => $_POST['n-guest'],
        ':checkin' => $_POST['checkin'],
        ':checkout' => $_POST['checkout'],
        ':fn' => $_POST['fname'],
        ':ln' => $_POST['lname'],
        ':email' => $_POST['email'],
        ':room_id' => $_POST['room-id'],
    ]);

    header ('Location: reservation.php');




// $sqlSelect = 'SELECT users.fname, users.lname, users.Email, 
// Reservation.Number_Guest, Reservation.Room_Id, Reservation.Checkin, Reservation.Checkout, 
// Room.Room_Id, Room.Room_Type, Room.Room_Price, Room.Room_Number
// JOIN Reservation ON Reservation.users_Id = users_Id
// JOIN Room ON Room.Room_Id = Reservation.Room_Id';

// $statement2 = $pdo->query($sql);
// $reservation = $statement2->fetch(PDO::FETCH_ASSOC);

// echo $_POST['roomP'];