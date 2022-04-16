<?php 

require 'include/connectdb.php';
include 'include/head.php';

$sql = 'SELECT * FROM Room';
$statement = $pdo->query($sql);
$rooms = $statement->fetchAll(PDO::FETCH_ASSOC);

$sql1 = 'SELECT * FROM users';
$statement1 = $pdo->query($sql1);
$users = $statement1->fetchAll(PDO::FETCH_ASSOC);

$sql2 = 'SELECT * FROM Employee';
$statement2 = $pdo->query($sql2);
$employees = $statement2->fetchAll(PDO::FETCH_ASSOC);

$sql3 = 'SELECT * FROM Service';
$statement3 = $pdo->query($sql3);
$services = $statement3->fetchAll(PDO::FETCH_ASSOC);

$sql4 = 'SELECT Reservation.Number_Guest, Reservation.Checkin, Reservation.Checkout, Room.Room_Number, Room.Room_Type, users.Id, users.fname
FROM Reservation
JOIN Room ON Room.Room_Id = Reservation.Room_Id
JOIN users ON users.Id = Reservation.users_Id';
$statement4 = $pdo->query($sql4);
$reservations = $statement4->fetchAll(PDO::FETCH_ASSOC);
?>


<!--------------------------------------------------------- HTML --->

<body>

          <nav class="bg-light">
              <ul class="nav d-flex justify-content-end align-items-center shadow p-3 mb-5 bg-body">
                <li class="nav-item navbar-brand mr-auto"><a href="index.php" class="nav-link">Deluxe</a></li>
                <li class="nav-item"><a href="admin-sign-out.php" class="nav-link active">Sign out</a></li>
              </ul>
            </nav>

            

    <!--------------------------- Table Rooms ---------------------->
<div class="d-flex justify-content-between w-75 mx-auto">
    <h2 class="navbar-brand text-secondary">Rooms</h2>
    <div>
      <button id='add-room' onclick="toggleAdding(this.id)" class="btn btn-primary">Add room</button>
    </div>
</div>
    <table class="table table-hover mx-auto" style="width:75%; margin-bottom: 5rem;">
        <?php if ($errorsRoom['warning']){?>
          <p> <?php echo $errorsRoom['warning'] ?></p>
          <?php } ?>
          
          <form action="admin-add.php" method="POST">
            <tr id="toggleadd-room" style="display:none;">
              <td><input type="text" name="roomN" style="width:130px;"></td>
              <td><input type="text" name="roomT" style="width:160px;"></td>
              <td><input type="text" name="roomP" style="width:130px;"></td>
              <td><input type="text" name="desc" style="width:300px;"></td>
              <td><input type="text" name="avail" style="width:50px;"></td>
              <td><input type="submit" value="Add" class="btn btn-secondary"></td>
            </tr>
          </form>

        <tr>
          <th>Room number</th>
          <th>Room type</th>
          <th>Room price</th>
          <th>Description</th>
        </tr>

      <?php if($rooms){foreach ($rooms as $room){?>

      <tr>
        <td><?= $room['Room_Number']?></td>
        <td><?= $room['Room_Type']?></td>    
        <td>$<?= $room['Room_Price']?></td>    
        <td><?= $room['Description']?></td>    
      </tr>
        <!-- <td>
          <form action="admin-delete.php" method="POST">
            <input type="hidden" name="id" value="<?= $room['Room_Id'] ?>">
            <input type="submit" value="Delete" class="btn btn-danger">
          </form>
        </td> -->
        <!-- <td><button id='<?= $room['Room_Id']?>' onclick="toggleUpadating(this.id)" class="btn btn-primary">Edit</button></td> -->

          <form  action="admin-edit.php" method="POST">
            <tr style="display:none;" id="toggle<?= $room['Room_Id']?>"> 
              <input type="hidden" name="id" value="<?= $room['Room_Id']?>">
              <td><input type="text" name="roomN" value="<?= $room['Room_Number']?>"></td>
              <td><input type="text" name="roomT" value="<?= $room['Room_Type']?>"></td>
              <td><input type="text" name="roomP" value="<?= $room['Room_Price']?>"></td>
              <td><input type="text" name="desc" value="<?= $room['Description']?>"></td>
              <td><input type="submit" value="Update" class="btn btn-secondary"></td>
            </tr>
          </form>
      
    <?php }} ?>

  </table>

  <!----------------------------------- Table users ---------------------------------->
  <div class="w-75 mx-auto">
    <h2 class="navbar-brand text-secondary">Guests</h2>
  </div>       
    <table class="table table-hover mx-auto" style="width:75%; margin-bottom: 5rem;">

        <tr>
          <th>Full name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Notes</th>
        </tr>

        <?php if($users){foreach ($users as $user){?>

        <tr> 
          <td><?= $user['fname'] . ' ' . $user['lname']?></td>
          <td><?= $user['Email']?></td>
          <td><?= $user['Phone']?></td>  
          <td><?= $user['Address']?></td>    
          <td><?= $user['Note']?></td>    
          <!-- <td>
              <form action="admin-delete.php" method="POST">
                <input type="hidden" name="id-user" value="<?= $user['Id'] ?>">
                <input type="submit" value="Delete" class="btn btn-danger">
              </form>
          </td> -->
          <!-- <td><button id='<?= $reservation['Reservation_Id']?>' onclick="toggleUpadating(this.id)" class="btn btn-primary">Edit</button></td>   -->
        </tr>
      <?php }} ?>
    </table> 


  <!--------------------------------- Table reservations ----------------------->
  
  <div class="w-75 mx-auto">
    <h2 class="navbar-brand text-secondary">Reservations</h2>
  </div>       
    <table class="table table-hover mx-auto" style="width:75%; margin-bottom: 5rem;">

        <tr>
          <th>Name</th>
          <th>Room number</th>
          <th>Room type</th>
          <th>Number guest</th>
          <th>Check in</th>
          <th colspan="3">Check out</th>
        </tr>

        <?php if($reservations){foreach ($reservations as $reservation){?>

        <tr> 
          <td><?= $reservation['fname']?></td>
          <td><?= $reservation['Room_Number']?></td>
          <td><?= $reservation['Room_Type']?></td>  
          <td><?= $reservation['Number_Guest']?></td>    
          <td><?= $reservation['Checkin']?></td>    
          <td><?= $reservation['Checkout']?></td>  
          <td>
          <form action="admin-delete.php" method="POST">
            <input type="hidden" name="id-res" value="<?= $reservation['Reservation_Id'] ?>">
            <input type="hidden" name="id-user" value="<?= $user['Id'] ?>">
            <input type="submit" value="Delete" class="btn btn-danger">
          </form>
          </td>
          <!-- <td><button id='<?= $reservation['Reservation_Id']?>' onclick="toggleUpadating(this.id)" class="btn btn-primary">Edit</button></td>   -->
        </tr>
      <?php }} ?>
    </table> 


    <!------------------------------------- Table Employees -------------------------------->
<div class="d-flex justify-content-between w-75 mx-auto">
    <h2 class="navbar-brand text-secondary">Employees</h2>
    <div>
      <button id='add-employee' onclick="toggleAdding(this.id)" class="btn btn-primary">Add employee</button>
    </div>
</div>
<table class="table table-hover mx-auto" style="width:75%; margin-bottom: 5rem;">

          <form action="admin-add.php" method="POST">
            <tr id="toggleadd-employee" style="display:none;">
              <td><input type="text" name="f-name" style="width:160px;"></td>
              <td><input type="text" name="l-name" style="width:160px;"></td>
              <td><input type="text" name="email-emp" style="width:250px;"></td>
              <td><input type="text" name="phone-emp" style="width:160px;"></td>
              <td><input type="submit" value="Add" class="btn btn-secondary"></td>
            </tr>
          </form>

        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th colspan="5"></th>
        </tr> 
        <?php if($employees){foreach ($employees as $employee){?>
      <tr>
        <td ><?= $employee['First_Name']?></td>
        <td ><?= $employee['Last_Name']?></td>    
        <td><?= $employee['Email']?></td>    
        <td ><?= $employee['Phone']?></td>   
        <td>
          <form action="admin-delete.php" method="POST">
            <input type="hidden" name="emp_id" value="<?= $employee['Employee_Id'] ?>">
            <input type="submit" value="Delete" class="btn btn-danger">
          </form>
        </td>
        <td><button id='<?= $employee['Employee_Id']?>' onclick="toggleUpadating(this.id)" class="btn btn-primary">Edit</button></td>
      </tr>

        <form  action="admin-edit.php" method="POST">
            <tr style="display:none;" id="toggle<?= $employee['Employee_Id']?>"> 
              <input type="hidden" name="id" value="<?= $employee['Employee_Id']?>">
              <td><input type="text" name="email" value="<?= $employee['Email']?>"></td>
              <td><input type="text" name="phone" value="<?= $employee['Phone']?>"></td>
            </tr>
        </form>
      
      <?php }} ?>
    </table>



<script>

    function toggleUpadating(id){

    let form = document.getElementById('toggle'+id)

    if(form.style.display == 'none'){
      form.style.display ='table-row'
    } else {
      form.style.display = 'none'
      }
    }

    function toggleAdding(id){

    let button = document.getElementById('toggle'+id)

    if(button.style.display == 'none'){
      button.style.display ='table-row'
    } else {
      button.style.display = 'none'
      }
    }

</script>

<?php include 'include/footer.php'; ?>
