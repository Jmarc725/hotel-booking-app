<?php

require 'include/connectdb.php';


$username = $_POST['username'];
$password = $_POST['password'];
$errors = array();

$sql = "SELECT COUNT(*) FROM Administrator WHERE Username = :username AND Password = :password";

$statement = $pdo->prepare($sql);
$statement->execute([
    ':username' => $username,
    ':password' => $password
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
    header ('Location: adminAccess.php');
} else {
    header ('Location: admin-sign-up.php');
}
} else {
    echo "<h1>Error</h1>
    <p>The following error(s) occured:<br>";
    
    foreach ($errors as $msg){
        echo " . $msg<br>";
    }
    echo '<p><a href="admin-sign-in.php">Please try again - Sign in</p>';
}



?>