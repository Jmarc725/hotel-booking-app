
<?php 
require 'include/connectdb.php';
include 'include/head.php';

?>

  <body style="margin-top: 8rem;">

  <div class="text-center w-25 mx-auto border border-secondary mt-5 shadow">
        <p class="mt-5 "><a style="font-size: 2rem;" class="navbar-brand" href="index.php">Deluxe</a></p>

              <form action="adminValidation.php" method="POST" class="bg-white p-5 contact-form">
                <div style="margin-bottom: 1.5rem;"class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div style="margin-bottom: 3rem;" class="form-group">
                    <input type="text" class="form-control" name="password" placeholder="Password">
                </div>
                <div style="margin-bottom: 3rem;" class="form-group">
                  <input type="submit" value="Sign up" class="btn btn-primary py-3 px-5">
                </div>
                <p><a href="admin-sign-in.php">You already have an account ?<br> Sign in</a></p>
              </form>            
            </div>


