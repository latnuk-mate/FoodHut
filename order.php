<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: ./error.php');
    }

// parsing the env file...
$env = parse_ini_file('.env');

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

    // Getting all Data from db.
    $query = "SELECT * FROM productData";

    $result = mysqli_query($conn, $query);


    // creating an associative array of the returned data.
    // if(mysqli_num_rows($result) > 0){
    //     while($data = mysqli_fetch_assoc($result)){
    //         echo "Name: " .$data['product_name'];
    //     }
    // }
    // print_r($data);
    // echo count($data);



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Items || Check Your Orders</title>
<!-- External styling libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- For Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- custom styles... -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<!-- icon -->
<link rel="icon" href="imgs/logo.png" type="image/png" />
</head>
<body>
<!-- design the order page... put the order details along with the image.     -->
    <div class="container orderPageForUser">
        <h5 class="fw-bold mb-3 text-center py-2">Get All Your Order Details!</h5>
        <!-- Action button -->
        <a href="/" class="action--btn px-5 py-2">Home</a>
    <div class="row justify-content-center pt-4">
    <div class="col-lg-7">

    <?php 
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            echo '
                <div class="row shadow-lg mb-3 align-items-center">
                    <div class="col-6">
                        <div class="img--area">
                        <img src="' . $data["product_image"] . '" alt="A Product Image">
                        </div>
                    </div>

                    <!-- this for data... -->
                    <div class="col-6">
                        <div class="text--area p-2">
                        <h5 class="fs-5 fw-semibold">Product: ' . $data["product_name"] .'</h5>
                        <h5>Price: ' . $data["product_price"] .'</h5>
                        <h5>Qt. ' . $data["product_count"] .'</h5>

                        <div class="py-1 px-2 px-lg-4 py-lg-2 bg-success text-white rounded">
                        Payment: ' . $data["product_payment_status"] .'  
                        </div>
                        </div>
                    </div>
                </div>
        
            ';
        }
    }
    ?>
    </div>
    </div>
    </div>



</body>
</html>