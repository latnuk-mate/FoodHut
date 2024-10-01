<?php 
    session_start();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FoodHut Menu | Food Restro</title>

<!-- External styling libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- For Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- carousel library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="icon" href="imgs/logo.png" type="image/png" />
</head>
<body>

<!-- let's design the navbar and the hero section -->

<div class="hero--part menu--part">

	<!-- navbar -->
	<nav class="navbar navbar-expand-lg custom-nav">
		<div class="container">
			<a class="navbar-brand dancing--script" href="/">FoodHut</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarList" aria-controls="navbarList" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		  <div class="collapse navbar-collapse" id="navbarList">
		  	 <ul class="navbar-nav">
			        <li class="nav-item">
			          <a class="nav-link" aria-current="page" href="/">Home</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link active" href="./menu.php">Menu</a>
			        </li>
			       	<li class="nav-item">
			          <a class="nav-link" href="/#booking">Book A Table</a>
			        </li>
			      	<li class="nav-item">
			          <a class="nav-link" href="/#contactPage">Contact</a>
			        </li>
		     </ul>
		     <div class="social--links">
                <?php 
                    if(isset($_SESSION['username'])){
                        echo '<a href="./user.php" class="nav-link">'.$_SESSION['username'].'<i class="fa fa-user ms-1"></i></a>';
                    }else{
                        echo '<a href="#" class="nav-link"><i class="fa fa-user"></i></a>';
                    }
                
                ?>
			<?php
				if(isset($_SESSION['username'])){
					echo "<a href='./order.php' class='nav-link'>
						<i class='fa fa-cart-shopping'></i>
						</a>";
				}else{
					echo '<a href="#" class="nav-link"><i class="fa fa-cart-shopping"></i></a>';
				}
			
			 ?>
                
                <?php 
                    if(isset($_SESSION['username'])){
                        echo '<a href="./auth/logout.php" class="px-5 py-2 text-decoration-none text-white bg-warning" style="border-radius: 100px">Sign Out</a>';
                    }else{
                        echo '<button class="px-5 py-2" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign Up</button>';
                    }
                ?>
                
		     </div>
		  </div>
		</div>
	</nav>

    	<!-- registration modal section -->
		<?php include("auth/regForm.html");  ?>

<!-- login modal section -->
	<?php include("auth/loginForm.html");  ?>

</div>




<div class="menu--area">
	<h5 class="dancing--script menu--title">Explore Our Menu</h5>
	<div class="container">
		<div class="insert--item row g-5 pt-4">
			<!-- dynamic content -->
		</div>
	</div>
	
</div>



<!-- footer part... -->
<?php include("partials/footer.html");  ?>


<!-- External Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/index.js"></script>

</body>
</html>