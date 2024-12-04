<?php

session_start();

if(!isset($_SESSION['username'])){
    header('Location: ../partials/error.php');
}

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
$query = "SELECT * FROM userrecord WHERE name='$user'";

$result = pg_query($conn, $query);


// getting other information...
$bookings = pg_query($conn, "SELECT * FROM booktable WHERE ct_user='$user'");

$orderedItem = pg_query($conn, "SELECT * FROM productData WHERE ct_user='$user'");


if($result){
    // close connection...
    pg_close($conn);
}

$name = "";
$email;
$phone;


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile || User Information!</title>
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
   
    <!-- profile page... -->
     <div class="UserProfile">
     <div class="container">
        <div class="row container--row">
            <div class="col-lg-6">
                <div class="profile--area">
                    <div class="left--side--profile d-none d-md-flex">
                        <h5 class="d-flex align-items-center gap-2">Your Settings 
                            <i class="fa-solid fa-gear"></i>
                        </h5>

                        <h5 class="dancing--script username"><?php echo $_SESSION['username'] ?></h5>
                    </div>
             <div class="right--side--profile">
                    <!-- profile field -->
                <div class="profile--field">
                    <h5>Your Profile Information!</h5>
                            <?php 
                        if(pg_num_rows($result) > 0){
                            while($data = pg_fetch_assoc($result)){
                                $name = $data["name"];
                                $email = $data["email"];
                                $phone = $data["phone"];
                                echo '
                            <div class="user--info">
                                <p>Name:- ' . $data["name"] .'</p>
                                <p>Email:- ' . $data["email"] .'</p>
                                <p>Number:- ' . $data["phone"] .'</p>
                                <p>Registered On:- ' . $data["reg_date"] .'</p>
                            </div>
                        ';
                    }} ?>

            <div class="row mt-4">
                <div class="col-sm-6">
                    <div class="booking--info">
                        <h5 class="title">Table Booked</h5>
                    <h5><?php echo pg_num_rows($bookings); ?></h5>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="order--info">
                        <h5 class="title">Ordered Food</h5>
                    <h5><?php echo pg_num_rows($orderedItem); ?></h5>
                    </div>
                </div>
            </div>

        <div class="action--area mt-5">
            <button onclick="history.back()" class="btn btn-dark px-5 py-2">Back</button>
            <button id="show--form" class="update--btn px-5 py-2">Update Profile</button>
        </div>
        </div>
    <!-- form field... -->
            <div class="form--field">
                <h5 class="form--title">Update Your Information!</h5>
                <form action="profileUpdate.php" method="post" class="shadow-sm p-3">
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text"
                                value="<?php echo $name;?>"
                                class="form-control"
                                name="updateName"
                                placeholder="Your Name..."  
                        />
                    </div>

                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email"
                                value="<?php echo $email;?>"
                                class="form-control"
                                placeholder="Your Email..." 
                                disabled
                        />
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input type="text"
                                value="<?php echo $phone;?>"
                                class="form-control"
                                name="updatePhone"
                                placeholder="Your Number..."  
                        />
                    </div>
                    
                <div class="form--action">
                    <button type="button" class="btn btn-dark px-5 py-2" id="hide--form">Cancel</button>
                    <button type="submit" class="form--submit px-5 py-2">Update</button>
                </div>
        
                </form>
            </div>


</div>
</div>
</div>
</div>
</div>
</div>




<script>
    const toggleHide = document.getElementById("hide--form");
    const toggleShow = document.getElementById("show--form");

    toggleHide.addEventListener('click', ()=>{
        document.querySelector('.form--field').style.cssText = "display: none";
        document.querySelector('.profile--field').style.cssText = "display:block";
    });

    toggleShow.addEventListener('click', ()=>{
        document.querySelector('.profile--field').style.cssText = "display: none";
        document.querySelector('.form--field').style.cssText = "display: block";
    });



</script>
</body>

</html>