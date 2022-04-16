
<?php 

require 'include/connectdb.php';
include 'include/header.php';


	  $roomtype = $_POST["room"];
	  $checkin = $_POST["checkin"];
	  $checkout = $_POST["checkout"];
	  $numberAdult = $_POST["numberAdult"];
	  
	  setcookie("roomType", $roomtype);
	  setcookie("checkinDate", $checkin);
	  setcookie("checkoutDate", $checkout);
	  setcookie("nAdult", $numberAdult);

    $sql = "SELECT * FROM Reservation WHERE Reservation.Checkin = '$checkin' AND Reservation.Checkout = '$checkout'";
    // looks to see if a reservation exists for a roomtype, and if it does then omit room ID from the search
    
    $statement1 = $pdo->query($sql);
    $reservations = $statement1->fetchAll(PDO::FETCH_ASSOC);
    // $arraylength = count($reservations);
    
    if ($reservations){
      foreach ($reservations as $reservation) {
      
      $ommitthisroom = $reservation["Room_Id"];
    
      $sql2 = "SELECT * FROM Room WHERE Room_Id != '$ommitthisroom' AND Room_type = '$roomtype'";
      $statement2 = $pdo->query($sql2);
      $rooms = $statement2->fetchAll(PDO::FETCH_ASSOC);
      } 
    }
    
    else {
      $sql3 = "SELECT * FROM Room WHERE Room_type ='$roomtype'";
      $statement3 = $pdo->query($sql3);
      $rooms = $statement3->fetchAll(PDO::FETCH_ASSOC);
    
    }
	?>


<!---------------------------------- HTML -------->

    <div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          	<div class="text">
	            <!-- <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home</a></span> <span>About</span></p> -->
	            <h1 class="mb-4 bread">Rooms</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
	        <div class="col-lg-9">
		    		<div class="row">
    
<?php 
      
	  
    foreach ($rooms as $room) {
  	if(isset($rooms)){
    
    $rprice =  $room['Room_Price'];
    $rtype =  $room['Room_Type'];
    $rnumber =  $room['Room_Number'];
    $rdesc = $room['Description'];

?>
             
		    			<div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    				<div class="room">
		    					<a href="#" class="img d-flex justify-content-center align-items-center" style="background-image: url(images/room-6.jpg);">
		    						<div class="icon d-flex justify-content-center align-items-center">
		    							<span class="icon-search2"></span>
		    						</div>
		    					</a>

								
		    					<div class="text p-3 text-center">
		    						<h3 class="mb-3"><a href="#"><?php echo $rtype;?></a></h3>
                      <p><span class="price mr-2"><?php echo $rprice ?></span> <span class="per">per night</span></p>
                        <ul class="list">
                          <li>Room number: <?php echo $rnumber; ?></li>
                          <li><?php echo $rdesc; ?></li>
                        </ul>
                      <hr>
                      <p><a href="user-sign-up.php?Room_Number=<?php echo $rnumber; ?>">Book now</a></p>
	  						
							    </div>
		    			</div>
		    			</div>
            
              <?php }} ?>
              
		    		</div>
		    	</div>


	        </div>
		    </div>
    	</div>
    </section>


    <!-- Section instagram ---->
    <section class="instagram pt-5">
      <div class="container-fluid">
        <div class="row no-gutters justify-content-center pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2><span>Instagram</span></h2>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-1.jpg" class="insta-img image-popup" style="background-image: url(images/insta-1.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-2.jpg" class="insta-img image-popup" style="background-image: url(images/insta-2.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-3.jpg" class="insta-img image-popup" style="background-image: url(images/insta-3.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-4.jpg" class="insta-img image-popup" style="background-image: url(images/insta-4.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-5.jpg" class="insta-img image-popup" style="background-image: url(images/insta-5.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

   <?php include 'include/footer.php'; ?>