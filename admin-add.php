<?php 

require 'include/connectdb.php';

$roomAdd = [
'number' => '',
'type' => '',
'price' => '',
'desc' => '',
'avail' => 1
];

$errorsRoom = [
    'roomNumber' => '',
    'roomType' => '',
    'roomPrice' => '',
    'description' => '',
    'warning' => ''
    ];


if($_SERVER['REQUEST_METHOD'] == 'POST'){
$roomAdd['number'] = $_POST['roomN'];
$roomAdd['type'] = $_POST['roomT'];
$roomAdd['price'] = $_POST['roomP'];
$roomAdd['desc'] = $_POST['desc'];
$roomAdd['avail'] = (isset($_POST['avail'])) AND ($_POST['avail'] == 1) ? 1 : 0;

$errorsRoom['roomNumber'] = is_text($roomAdd['number']) ? '' : 'You must enter a room number in this field';
$errorsRoom['roomType'] = is_text($roomAdd['type']) ? '' : 'You must enter a type of room in this field';
$errorsRoom['roomPrice'] = is_text($roomAdd['price']) ? '' : 'You must enter a price in this field';
$errorsRoom['description'] = is_text($roomAdd['desc']) ? '' : 'You must enter a description in this field';

$invalid = implode($errorsRoom);

if ($invalid){
    $errorsRoom['warning'] = 'Please correct errors';
} else {

// echo $roomAdd['number'];
$sql = "INSERT INTO Room (Room_Number,  Room_Type, Room_Price, Description, Availability)
VALUES (:roomN, :roomT, :roomP, :desc, :avail)";

$statement = $pdo->prepare($sql);
$statement->execute([
    ':roomN' => $roomAdd['number'],
    ':roomT' => $roomAdd['type'],
    ':roomP' => $roomAdd['price'],
    ':desc' => $roomAdd['desc'],
    ':avail' => $roomAdd['avail']
]);

}}



// $sql = "INSERT INTO Room (Room_Number,  Room_Type, Room_Price, Description, Availability)
// VALUES (:roomN, :roomT, :roomP, :desc, :avail)";

// $statement = $pdo->prepare($sql);
// $statement->execute([
//     ':roomN' => $_POST['roomN'],
//     ':roomT' => $_POST['roomT'],
//     ':roomP' => $_POST['roomP'],
//     ':desc' => $_POST['desc'],
//     ':avail' => $_POST['avail']
// ]);


// if($statement){
//     header ('Location: adminAccess.php');
// }

?>