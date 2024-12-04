<?php
require "../partials/toast.php";

session_start();

if(!isset($_SESSION['username'])){
    header('Location: ../partials/error.php');
}

// Getting the current user...
$user = $_SESSION['username'];

// parsing the env file...
$env = parse_ini_file('../.env');

// database credentials for postgreSQL...
$connString = $env['CONNECTION_STRING'];


//  connect the database...
$conn = pg_connect($connString);

if(!$conn){
    die('connection failed'.pg_last_error());
}

// Getting all Data from db.
$query = "SELECT * FROM booktable WHERE ct_user='$user'";

$result = pg_query($conn, $query);

if($result){
    // close connection...
    pg_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your Bookings || Your Tables!</title>
<!-- External styling libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- For Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- custom styles... -->
<link rel="stylesheet" type="text/css" href="/css/main.css">
<!-- icon -->
<link rel="icon" href="/imgs/logo.png" type="image/png" />
</head>
<body>
    <!-- for rendering toast message... -->
    <?php 
        if(isset($_SESSION["CancelStatus"])){
            toastMessage($_SESSION["CancelStatus"]);
            unset($_SESSION["CancelStatus"]);
        }
    ?>

    <div class="booking--area">
    <div class="container">
        <h5 class="booking--title dancing--script">Get Your all bookings!</h5>
        <a href="/" class="btn btn-light mb-3 rounded-pill px-5 py-2">Home</a>
        <div class="row">
     <?php 
    if(pg_num_rows($result) > 0){
        while($data = pg_fetch_assoc($result)){
            echo '
                <div class="col-lg-3 g-4">
                    <div class="info--area">
                        <div class="text">
                            <h5>Name:- ' . $data["user_name"] .'</h5>
                            <h5>Contact No:- ' . $data["user_phone"] .'</h5>
                            <h5>Members:- ' . $data["user_count"] .'</h5>
                            <h5>Booked Date:- ' . $data["user_date"] .'</h5>
                        </div>
                    <a href="/partials/cancelBook.php?id='. $data["booking_id"] .'" class="cancel--btn px-5 py-2">Cancel</a>
                    </div>
                </div>
            ';
        }
    }
    ?>

    </div>
    </div>
    </div>


<script type="text/javascript" src="/js/toast.js"></script>
</body>
</html>