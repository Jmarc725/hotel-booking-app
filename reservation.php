
<?php 
// print_r($_COOKIE);

require 'include/connectdb.php';
include 'include/head.php';

session_start();
if(!isset($_SESSION['loggedIn'])){
  header('Location: user-sign-up.php');
} else {
  $user_Id = $_SESSION['id'];

// Query multiple tables
$sql6 = "SELECT users.fname, users.lname, users.Email, 
Reservation.Checkin, Reservation.Checkout, Reservation.Number_Guest, 
Room.Room_Id, Room.Room_Type, Room.Room_Price, Room.Room_Number, Reservation.Reservation_Id 
FROM users
INNER JOIN Reservation ON Reservation.users_Id = users.Id
INNER JOIN Room ON Room.Room_Id = Reservation.Room_Id
WHERE users.Id = '$user_Id'";

$statement6 = $pdo->query($sql6);
$reservations = $statement6->FETCHALL(PDO::FETCH_ASSOC);
}

?>



<!-- --------------------------------------------------- Nav -->
            <nav class="bg-light">
              <ul class="nav d-flex justify-content-end align-items-center shadow p-3 mb-5 bg-body">
                <li class="nav-item navbar-brand mr-auto"><a href="index.php" class="nav-link">Deluxe</a></li>
                <li class="nav-item"><a href="user-sign-out.php" class="nav-link">Sign out</a></li>
              </ul>
            </nav>
            <div class="text-center">
              <h1 class="navbar-brand bg-body">Hello <?= $reservations[0]['fname'] . ' ' . $reservations[0]['lname'] ?></h1>     
            </div>
<!-- --------------------------------------------------- Table reservation -->

<div class="col">
<table class="table table-hover mx-auto" style="width:75%;">
  <thead>
    <tr>
      <th scope="col">Full name</th>
      <th scope="col">Number guests</th>
      <th scope="col">Room number</th>
      <th scope="col">Room type</th>
      <th scope="col">Room price</th>
      <th scope="col">Checkin</th>
      <th scope="col">Checkout</th>
      <th scope="col" colspan="2"></th>
    </tr>
  </thead>

<?php
foreach ($reservations as $reservation){ 
  ?>
<tbody>
    <tr>
        <td><?= $reservation['fname'] . ' ' . $reservation['lname']?></td>    
        <td scope="row"><?= $reservation['Number_Guest']?></td>    
        <td><?= $reservation['Room_Number']?></td>    
        <td><?= $reservation['Room_Type']?></td>    
        <td><?= $reservation['Room_Price']?></td>    
        <td><?= $reservation['Checkin']?></td>    
        <td><?= $reservation['Checkout']?></td> 
        <td>
          <form action="user-delete.php" method="POST">
            <input type="hidden" name="id" value="<?= $reservation['Reservation_Id'] ?>">
            <input type="submit" value="Cancel" class="btn btn-danger">
          </form>
        </td>
        <td><button id='<?= $reservation['Reservation_Id']?>' onclick="toggleUpadating(this.id)" class="btn btn-primary">Edit</button></td>
    </tr>
</tbody>


<!--------------------- Edit Form ------------------------->
<div id="toggle<?= $reservation['Reservation_Id']?>" style="display:none;" class="container input-group">      
  <div class="row">

    <form  action="user-edit.php" method="POST">

    <div class="col">

        <div class="card-header">
          My reservation
        </div>
        <ul class="list-group list-group-flush"> 
          <li><input type="hidden" name="id" value="<?= $reservation['Reservation_Id']?>"></li>
         
          <li class="list-group-item"><input id="room-id" type="hidden" name="room-id"></li>
          <li class="list-group-item"><input type="text" name="fname" value="<?= $reservation['fname']?>"></li>
          <li class="list-group-item"><input type="text" name="lname" value="<?= $reservation['lname']?>"></li>
          <li class="list-group-item"><input type="text" name="email" value="<?= $reservation['Email']?>"></li>
          <li class="list-group-item">
          
          <li class="list-group-item">
            <select class="form-control" name="n-guest" value="<?= $reservation['Number_Guest']?>"> 
			          <option value="1">1</option>
			          <option value="2">2</option>
			          <option value="3">3</option>
			          <option value="4">4</option>
			      </select>
          </li> 
      
    </div>

    <div class="col">

          <li id="room-number" class="list-group-item"> <input type="text" name="roomN" disabled value="Room number: <?= $reservation['Room_Number']?>"></li>

          <li class="list-group-item">
              <select id="room-type" name="roomT" value="<?= $reservation['Room_Type']?>" class="form-control">
								  <option value="Economic room">Economic room</option>
			            <option value="Classic room">Classic room</option>
								  <option value="Suite room">Suite room</option>
			            <option value="Family room">Family room</option>
			            <option value="Deluxe room">Deluxe room</option>
			            <option value="Luxury room">Luxury room</option>
			        </select>
          </li>

          <li class="list-group-item" id="room-price"><input type="text" name="roomP" disabled value="$CAD: <?= $reservation['Room_Price']?>"></li>
          <li class="list-group-item"><input type="date" name="checkin" value="<?= $reservation['Checkin']?>"></li>
          <li class="list-group-item"><input type="date" name="checkout" value="<?= $reservation['Checkout']?>"></li>
          <li class="list-group-item"><input type="submit" value="Update" class="btn btn-secondary">
          <span><button id="close" onclick="closeForm(this.id)" class="btn btn-danger">Cancel</button></span></li>
        </ul>

    </div>    
    </form>

  </div>
</div>
  
<?php } ?>

</table>
</div>

<script>

    function toggleUpadating(id){

    let form = document.getElementById('toggle'+id)

    if(form.style.display == 'none'){
      form.style.display ='table-row'
    } else {
      form.style.display = 'none'
    }
    }

    function closeForm(){
      let close = document.getElementById('toggle')
      form.style.display = 'none'

    }

    
    // Room objects ----------------------------

    roomType_Price = {
      "Classic room": 180,
      "Deluxe room": 250,
      "Luxury room": 300,
      "Suite room": 200,
      "Family room": 220,
      "Economic room": 120    
    }

    roomNumber_Type = {
      "Classic room": [201, 208, 211],
      "Deluxe room": [202, 204],
      "Luxury room": [203, 207],
      "Suite room": [205, 212],
      "Family room": [206, 213, 214],
      "Economic room": [209, 210, 215, 216]
    }

    roomIdNumber = {
      "201": 1,
      "202": 2,
      "203": 3,
      "204": 4,
      "205": 5,
      "206": 6,
      "207": 7,
      "208": 8,
      "209": 9,
      "210": 10,
      "211": 11,
      "212": 15,
      "213": 16,
      "214": 17,
      "215": 18,
      "216": 19
    }

    
    // Variables to edit in function of the click
    let roomType = document.getElementById('room-type')
    let allRoomType = document.querySelectorAll('#room-type')
    let roomNumber = document.getElementById('room-number')
    let roomId = document.getElementById('room-id')
    let roomPrice = document.getElementById('room-price')
    let newA

    
    // Random number in array
    let randomNumberRoom = function(arr){
      return arr[Math.floor(Math.random() * arr.length)]
    }

    function updateFields(e, array){
        let resultRandom = randomNumberRoom(roomNumber_Type[array])
        roomPrice.innerText = '$CAD: ' + roomType_Price[array]
        roomNumber.innerText = 'Room number: ' + resultRandom;
        let rId = roomIdNumber[resultRandom]
        roomId.value = rId
        array = e.target.innerText
      }

    // For loop
    for(let i = 0; i < allRoomType.length; i++){
      // console.log(allRoomType[i]) 
      allRoomType[i].addEventListener('click', function(e) {

      
      switch(e.target.innerText){
        
        case 'Family room':
          updateFields(e, 'Family room')
          break;

        case 'Economic room':
          updateFields(e, 'Economic room')
          break;

        case 'Classic room':
          updateFields(e, 'Classic room')
        break;

        case 'Suite room':
          updateFields(e, 'Suite room')
          break;

        case 'Deluxe room':
          updateFields(e, 'Deluxe room')
          break;

        case 'Luxury room':
          updateFields(e, 'Luxury room')
          break;        
      }
    })
    }
      // Check different cases
      // switch(e.target.innerText){
        
      //   case 'Family room':
      //     updateFields('Family room')
      //     break;

      //   case 'Economic room':
      //     updateFields('Economic room')
      //     break;

      //   case 'Classic room':
      //     updateFields('Classic room')
      //   break;

      //   case 'Suite room':
      //     updateFields('Suite room')
      //     break;

      //   case 'Deluxe room':
      //     updateFields('Deluxe room')
      //     break;

      //   case 'Luxury room':
      //     updateFields('Luxury room')
      //     break;        
      // }


  
    







 // function updateFields(array){
      //   let resultRandom = randomNumberRoom(roomNumber_Type[array])
      //   roomPrice.innerText = '$CAD: ' + roomType_Price[array]
      //   roomNumber.innerText = 'Room number: ' + resultRandom;
      //   let rId = roomIdNumber[resultRandom]
      //   roomId.value = rId
      // }   

</script>

