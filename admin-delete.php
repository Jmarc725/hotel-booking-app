<?php 

require 'include/connectdb.php';


$idUser = $_POST['id-user'];
// echo $idUser;

// if ($idUser){

// $sql = "DELETE FROM Reservation WHERE users_Id = '$idUser'";

// $statement = $pdo->query($sql);

// $sql = 'DELETE FROM users WHERE Id = :id';
// $statement = $pdo->prepare($sql);
// $statement->execute([ 
//     ':id' => $idUser
// ]);

// header ('Location: adminAccess.php');

// }


// $idReservation = $_POST['id-res'];

// if ($idReservation){

$sql = "DELETE FROM Reservation WHERE users_Id = '$idUser'";
$statement = $pdo->query($sql);


// $statement = $pdo->prepare($sql1);
// $statement->execute([ 
//     ':id' => $idReservation
// ]);

header ('Location: adminAccess.php');

}

?>