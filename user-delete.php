<?php

require 'include/connectdb.php';

    $res_id = $_POST['id'];  
    
    if($res_id){
    $sql = "DELETE FROM Reservation where Reservation_Id = :ID";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':ID' => $res_id
    ]);

    header('Location: reservation.php');
    
}
    ?>