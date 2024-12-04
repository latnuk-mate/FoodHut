<?php 
session_start();

// parsing the env file...
 $env = parse_ini_file('../.env');

// database credentials for postgreSQL...
$connString = $env['CONNECTION_STRING'];


if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_SESSION['username'])){

    // data created...
    $name = $_POST['bookedCustomerName'];
    $phone = $_POST['bookedCustomerPhone'];
    $date = $_POST['bookedCustomerDate'];
    $count = $_POST['bookedCustomerCount'];

    // create a session variable..
    $user = $_SESSION['username'];


    //  connect the database...
$conn = pg_connect($connString);

if(!$conn){
    die('connection failed'.pg_last_error());
}


// inserting data into table...
$query = "INSERT INTO BookTable (ct_user, user_name, user_phone, user_count, user_date)
VALUES('$user' , '$name', '$phone' , '$count', '$date')";

if(pg_query($conn , $query)){
pg_close($conn);

// on successfull response redirects to ....
header('Location: /user/bookings.php');
}
else{
die('failed to insert data'.pg_last_error($conn));  
} 

}else{
    header("Location: /partials/error.php");
}

?>

