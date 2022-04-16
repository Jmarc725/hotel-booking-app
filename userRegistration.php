<?php
require 'include/connectdb.php';
include 'include/header.php';

$errors = array();
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$username = $_POST['username'];
$password = $_POST['password'];


if(empty($_POST['fname'])){
    $errors[] = "Enter your first name";
}
if(empty($_POST['lname'])){
    $errors[] = "Enter your last name";
}
if(empty($_POST['email'])){
    $errors[] = "Enter your email address";
}
if(empty($_POST['phone'])){
    $errors[] = "Enter your phone number";
}
if(empty($_POST['address'])){
    $errors[] = "Enter your address";
}
if(empty($_POST['username'])){
    $errors[] = "Enter your username";
}
if(empty($_POST['password'])){
    $errors[] = "Enter your password";
}




if (empty($errors)){

$sql2 = "SELECT COUNT(*) FROM users WHERE Username = :Username";

$statement2 = $pdo->prepare($sql2);
$statement2->execute([
    ':Username' => $_POST['username']
]);

$count = $statement2->fetchColumn();

if ($count != 0){
    echo 'Username already registerd <a href="user-sign-in.php">Sign in</a>';

}
}

if(empty($errors)){
    $sql = "INSERT INTO users (fname, lname, Email, Phone, Address, Username, Password)
    VALUES (:fname, :lname, :Email, :Phone, :Address, :Username, :Password)";
    
    $statement = $pdo->prepare($sql);
    $result = $statement->execute([
        ':fname' => $_POST['fname'],
        ':lname' => $_POST['lname'],
        ':Email' => $_POST['email'],
        ':Phone' => $_POST['phone'],
        ':Address' => $_POST['address'],
        ':Username' => $_POST['username'],
        ':Password' => $_POST['password']
    ]);    
} 


if ($result){
    header('Location: user-sign-in.php');

    // echo'<h1>Registered</h1>
    // <p>You are now registered.<a href="userSignIn.php"</a>Sign in</p>';
} 
else {
    
    echo "<h1>Error</h1>
    <p>The following error(s) occured:<br>";
    
    foreach ($errors as $msg){
        echo " . $msg<br>";
    }
    echo '<p><a href="user-sign-up.php">Please try again - Sign up</p>';
}


?>

