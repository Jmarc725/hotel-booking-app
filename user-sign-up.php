<?php 
require 'include/connectdb.php';
include 'include/head.php';


$roomNumber = $_GET['Room_Number'];
setcookie("roomNumber", $roomNumber);
?>

    <body>

    <div class="w-50 p-5 text-center mx-auto border border-secondary mt-5 shadow">
        <p class="mt-2 mb-2"><a style="font-size: 2rem;" class="navbar-brand" href="index.php">Deluxe</a></p>
              <form style="margin-top: 5rem;" class="row g-3" action="userRegistration.php" method="POST" class="bg-white p-5 contact-form">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" name="fname" placeholder="First Name">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="lname" placeholder="Last Name">
                  </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" name="phone" placeholder="Phone">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="address" placeholder="Address">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="password" placeholder="Password">
                </div>
                <div style="margin-bottom: 3rem;" class="form-group col-md-12">
                  <textarea name="" id="" cols="30" rows="4" name="message" class="form-control" placeholder="Message"></textarea>
                </div>
                <div class="form-group mx-auto">
                  <input type="submit" value="Sign up" class="btn btn-primary py-3 px-5">
                </div>
                
              </form>
              <div class="mx-auto">
                  <a href="user-sign-in.php">You have already an account ?<br>Sign in</a>
                </div>
        </div>

