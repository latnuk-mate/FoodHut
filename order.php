<?php
    session_start();
    if(!isset($_SESSION['paymentId'])){
        header('Location: ./error.php');
    }
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
<link rel="icon" href="imgs/logo.png" type="image/png" />
</head>
<body>
<!-- design the order page... put the order details along with the image.     -->
    <div class="container orderPageForUser">
        <h5>Get All Your Order Details!</h5>
    <div class="row">
            <div class="col-lg-7">
                <div class="row g-5">
                    <!-- this for image... -->
                    <div class="col-sm-6">
                        <div class="img--area">
                            <?php 
                                if(isset($_SESSION['productImage'])){
                                    echo '<img src="' . $_SESSION["productImage"] . '" alt="A Product Image">';   
                                }
                            ?>
                        </div>
                    </div>

                    <!-- this for data... -->
                    <div class="col-sm-6">
                        <div class="text--area p-2">

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>



</body>
</html>