<?php

require 'include/connectdb.php';

$username = $_POST['username'];
$password = $_POST['password'];

$errors = array();

if(empty($_POST['username'])){
    $errors[] = "Enter an username";
}
if(empty($_POST['password'])){
    $errors[] = "Enter a password";
}


$sql = "SELECT COUNT(*) FROM Administrator WHERE Username = :username";

$statement = $pdo->prepare($sql);
$statement->execute([
    ':username' => $username
]);

$count = $statement->fetchColumn();

if ($count > 0){
    header('Location: admin-sign-up.php');
} 

if(empty($errors)){

$sql2 = "INSERT INTO Administrator (Username, Password)
VALUES (:Username, :Password)";

$statement2 = $pdo->prepare($sql2);
$statement2->execute([
    ':Username' => $username,
    ':Password' => $password
]);

if ($statement2){
    
    echo'<h1>Registered</h1>
    <p>You are now registered.<a href="admin-sign-in.php"</a>Sign in</p>';
}
} else {

        echo "<h1>Error</h1>
        <p>The following error(s) occured:<br>";
        
        foreach ($errors as $msg){
            echo " . $msg<br>";
        }
        echo '<p><a href="user-sign-up.php">Please try again - Sign up</p>';
    }



?>