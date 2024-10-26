<?php 
session_start();

// parsing the env file...
 $env = parse_ini_file('../.env');

// database creadentials....
$hostname = $env['HOSTNAME'];
$username = $env['USERNAME'];
$password = $env['PASSWORD'];
$dbName =   $env['DATABASE'];

if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_SESSION['username'])){

    // data created...
    $name = $_POST['bookedCustomerName'];
    $phone = $_POST['bookedCustomerPhone'];
    $date = $_POST['bookedCustomerDate'];
    $count = $_POST['bookedCustomerCount'];

    // create a session variable..
    $user = $_SESSION['username'];


    //  connect the database...
$conn = mysqli_connect($hostname, $username, $password, $dbName);

if(!$conn){
    die('connection failed'.mysqli_connect_error());
}


// inserting data into table...
$query = "INSERT INTO BookTable (user, user_name, user_phone, user_count, user_date)
VALUES('$user' , '$name', '$phone' , '$count', '$date')";

if(mysqli_query($conn , $query)){
mysqli_close($conn);

// on successfull response redirects to ....
header('Location: /user/bookings.php');
}
else{
die('failed to insert data'.mysqli_error($conn));  
} 

}else{
    header("Location: /partials/error.php");
}

?>

