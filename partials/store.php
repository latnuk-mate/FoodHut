<?php 
// import external file..
require 'verifyPay.php';

session_start();

// store payId in the session..
$_SESSION["pay_id"] = $_GET["payment_id"];


// parsing the env file...
$env = parse_ini_file('../.env');

// getting api details...
  $api_key = $env['API_KEY'];
  $api_token = $env['API_TOKEN'];

// database creadentials....
$hostname = $env['HOSTNAME'];
$username = $env['USERNAME'];
$password = $env['PASSWORD'];
$dbName =   $env['DATABASE'];



// getting the response...
$res = verifyPayment($_SESSION["pay_id"], $api_key, $api_token);

//  connect the database...
$conn = mysqli_connect($hostname, $username, $password, $dbName);

if(!$conn){
    die('connection failed'.mysqli_connect_error());
}

// get all the necessary values...
    $productName = $_SESSION['productName'];
    $productPrice = $_SESSION['productPrice'];
    $productCount = $_SESSION['productCount'];
    $productImage = $_SESSION['productImage'];
    $productPayStatus = $_GET['payment_status'];


// insert the values into the database.
    $query = "INSERT INTO ProductData (product_name, product_price, product_count, product_image, product_payment_status)
    VALUES('$productName', '$productPrice' , '$productCount', '$productImage', '$productPayStatus')";

    if($res && $res['payment']['status'] === "Credit"){
        if(mysqli_query($conn , $query)){
            mysqli_close($conn);
       }
       else{
       die('failed to insert data'.mysqli_error($conn));  
       } 

        // setting the value as null;
       unset($_SESSION["pay_id"]);

        // creating another session value..
        $_SESSION['status'] = $res['payment']['status'];

       header("Location: ./thankYou.php");
       exit();
    }

?>