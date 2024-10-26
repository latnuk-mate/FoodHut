<?php
session_start();

if(isset($_GET['id'])){
   $id = $_GET['id']; 
}

$_SESSION['CancelStatus'] = "Your Booking was cancelled!";

// parsing the env file...
$env = parse_ini_file('../.env');

// database creadentials....
$hostname = $env['HOSTNAME'];
$username = $env['USERNAME'];
$password = $env['PASSWORD'];
$dbName =   $env['DATABASE'];

//  connect the database...
$conn = mysqli_connect($hostname, $username, $password, $dbName);

if(!$conn){
    die('connection failed'.mysqli_connect_error());
}

$query = "DELETE FROM booktable WHERE booking_id='$id'";

if(mysqli_query($conn, $query)){
    mysqli_close($conn);
}

header("Location: /user/bookings.php");
?>