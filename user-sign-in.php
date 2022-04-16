<?php 
require 'include/connectdb.php';
include 'include/head.php';

?>

    <body style="margin-top: 8rem;">

            <div  class="text-center w-25 mx-auto border border-secondary mt-5 shadow">
            <p class="mt-5"><a style="font-size: 2rem;" class="navbar-brand" href="index.php">Deluxe</a></p>
              <form action="userValidation.php" method="POST" class="bg-white p-5 contact-form">
                <div style="margin-bottom: 2rem; class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div style="margin-bottom: 3rem;" class="form-group">
                    <input type="text" class="form-control" name="password" placeholder="Password">
                </div>
                <div style="margin-bottom: 3rem;" class="form-group">
                  <input type="submit" value="Sign in" class="btn btn-primary py-3 px-5">
                </div>
                <div>
                  <a href="index.php">You do not have an account ?<br> make first a reservation</a>
                </div>
              </form>
            </div>
            

