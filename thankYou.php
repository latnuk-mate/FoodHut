<?php 
session_start();

// this will redirect to the home by default...
if(!isset($_SESSION['customerName'])){
    header('Location: ./error.php');
}

if(isset($_SESSION['customerName'])){
    $_SESSION['paymentId'] = $_GET['payment_id'];
    $_SESSION['paymentStatus'] = $_GET['payment_status'];
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

// get all the necessary values...




// insert the values into the database.



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thanking Page!</title>
<!-- External styling libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="icon" href="imgs/logo.png" type="image/png" />
</head>
<body>
    <div 
    class="m-auto border text-center p-3 rounded shadow-lg mt-5"
    style="width: 600px;"
    >
    <div class="img--area" >
        <img src="/imgs/paymentSuccess.gif" alt="successfull payment" height="130px">
        <p class="text-black-50">Payment Successfull!</p>
    </div>
        <h4 class="fw-semibold mb-2">
            <?php 
                if(isset($_SESSION['customerName'])){
                  echo "Hurray! " .$_SESSION['customerName'].", Your Food is on the way!";
                }
             ?>
        </h4>
            <div class="d-flex justify-content-around align-items-center pt-2">
            <a href="/" 
           class="text-decoration-none text-primary px-5 py-2 bg-primary text-white rounded-pill">
            Back To Home
           </a>

           <a href="./Menu.php" 
           class="text-decoration-none text-primary px-5 py-2 bg-primary text-white rounded-pill">
            Explore Menu
           </a>
        </div>
    </div>
</body>
</html>