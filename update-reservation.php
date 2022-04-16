<?php

require 'include/connectdb.php';

$cookie = $guestId;
$sql = "SELECT * FROM RESERVATIONS WHERE GUESTID = $guestId";




$statement = $pdo->prepare($sql);
$statement->execute([ 
  ':newData' => $checkIn
]); 

$Update = "UPDATE RESERVATIONs SET checkin = :newDate";
$Update = "UPDATE RESERVATIONs SET checkout = :newDate";


?>
