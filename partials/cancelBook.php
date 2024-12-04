<?php
session_start();

if(isset($_GET['id'])){
   $id = $_GET['id']; 
}

$_SESSION['CancelStatus'] = "Your Booking was cancelled!";

// parsing the env file...
$env = parse_ini_file('../.env');

// database credentials for postgreSQL...
$connString = $env['CONNECTION_STRING'];

//  connect the database...
$conn = pg_connect($connString);

if(!$conn){
    die('connection failed'.pg_last_error());
}

$query = "DELETE FROM booktable WHERE booking_id='$id'";

if(pg_query($conn, $query)){
    pg_close($conn);
}

header("Location: /user/bookings.php");
?>