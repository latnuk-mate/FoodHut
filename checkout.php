<?php 
session_start();

if(!isset($_SESSION['username'])){
    header('Location: /partials/error.php');
}

if(isset($_POST['userName'])){
    $user = $_POST['userName'];
    $number = $_POST['customerPhone'];
    $productCount = $_POST['itemCount'];

    $itemPrice = $_GET["price"];
    $itemName = $_GET["item"];
    $itemImage = $_GET['image'];

$_SESSION['customerName'] = $user;
$_SESSION['customerNumber'] = $number;
$_SESSION['productPrice'] = $itemPrice;
$_SESSION['productCount'] = $productCount;
$_SESSION['productName'] = $itemName;
$_SESSION['productImage'] = $itemImage;

header('Location: ./pay.php'); 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buy now or Buy Never!</title>
<!-- External styling libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- For Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="icon" href="/imgs/logo.png" type="image/png" />
</head>
<body>

	<!-- settings page modal --> 
	<?php include("partials/settings.php"); ?>

  <!-- let's design the navbar and the hero section -->
<div class="hero--part menu--part">
<!-- navbar -->
<?php include("partials/navbar.php");  ?>	

    <!-- registration modal section -->
    <?php include("auth/regForm.html");  ?>	

    <!-- login modal section -->
    <?php include("auth/loginForm.html");  ?>

</div> 


<!-- let's design out order details... -->

<div class="order--details">
    <div class="container">
        <div class="row g-5 checkOutFood align-items-center">
             <!-- dynamic data... -->
        </div>   
    </div>
</div>

<!-- footer part... -->
<?php include("partials/footer.html");  ?>	


<!-- script files... -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="js/checkout.js"></script>
</body>
</html>

