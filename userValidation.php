<?php

require 'include/connectdb.php';


$errors = array();

// Cookies
$Adult = $_COOKIE['nAdult'];
$Checkin = $_COOKIE['checkinDate'];
$Checkout = $_COOKIE['checkoutDate'];
$username = $_POST['username'];
$roomNumber = $_COOKIE['roomNumber'];
$roomType = $_COOKIE['roomType'];


setcookie("username", $_POST['username']);

$sql = "SELECT COUNT(*) FROM users WHERE Username = :Username AND Password = :Password";

$statement = $pdo->prepare($sql);
$statement->execute([
    ':Username' => $_POST['username'],
    ':Password' => $_POST['password']
]);

$count = $statement->fetchColumn();


if(empty($_POST['username'])){
    $errors[] = "Enter an username";
}
if(empty($_POST['password'])){
    $errors[] = "Enter a password";
}


if (empty($errors)){

if ($count == 1){
    
    session_start();
    $_SESSION['loggedIn']=true;


// Query Room_Id
$sql5 = "SELECT Room_Id FROM Room WHERE Room_Number = '$roomNumber'";
$statement5 = $pdo->query($sql5);
$result5 = $statement5->FETCH(PDO::FETCH_ASSOC);
$room_Id = $result5['Room_Id'];


// Query users_Id
$sql3 = "SELECT Id FROM users WHERE Username = '$username'";
$statement3 = $pdo->query($sql3);
$result3 = $statement3->FETCH(PDO::FETCH_ASSOC);
$user_Id = $result3['Id'];

$_SESSION['id'] = $user_Id;

// Insert into reservation
$sql4 = "INSERT INTO Reservation (users_Id, Room_Id, Number_Guest, Checkin, Checkout) 
VALUES (:users_Id, :Room_Id, :Number_Guest, :Checkin, :Checkout);
WHERE users_Id = '$user_id'";

$statement4 = $pdo->prepare($sql4);
$statement4->execute([
  ':users_Id' => $user_Id,
  ':Room_Id' => $room_Id,
  ':Number_Guest' =>$Adult,
  ':Checkin' => $Checkin,
  ':Checkout' => $Checkout
]);



    header('Location: reservation.php');

} else {
    header('Location: user-sign-up.php');
}   
}
else {
        echo "<h1>Error</h1>
        <p>The following error(s) occured:<br>";
        
        foreach ($errors as $msg){
            echo " . $msg<br>";
        }
        echo '<p><a href="user-sign-in.php">Please try again - Sign in</p>';
    
    }

?>

