<?php 
// import external file..
require 'verifyPay.php';

session_start();

// store payId in the session..
$_SESSION["pay_id"] = $_GET["payment_id"];

// get the current user..
$username = $_SESSION['username'];


// parsing the env file...
$env = parse_ini_file('../.env');

// getting api details...
  $api_key = $env['API_KEY'];
  $api_token = $env['API_TOKEN'];

// database credentials for postgreSQL...
$connString = $env['CONNECTION_STRING'];


// getting the response...
$res = verifyPayment($_SESSION["pay_id"], $api_key, $api_token);

//  connect the database...
$conn = pg_connect($connString);

if(!$conn){
    die('connection failed'.pg_last_error());
}

// get all the necessary values...
    $productName = $_SESSION['productName'];
    $productPrice = $_SESSION['productPrice'];
    $productCount = $_SESSION['productCount'];
    $productImage = $_SESSION['productImage'];
    $productPayStatus = $_GET['payment_status'];


// insert the values into the database.
    $query = "INSERT INTO ProductData (ct_user , product_name, product_price, product_count, product_image, product_payment_status)
    VALUES('$username' , '$productName', '$productPrice' , '$productCount', '$productImage', '$productPayStatus')";

    if($res && $res['payment']['status'] === "Credit"){
        if(pg_query($conn , $query)){
            pg_close($conn);
       }
       else{
       die('failed to insert data'.pg_last_error($conn));  
       } 

        // setting the value as null;
       unset($_SESSION["pay_id"]);

        // creating another session value..
        $_SESSION['status'] = $res['payment']['status'];

       header("Location: ./thankYou.php");
       exit();
    }

?>