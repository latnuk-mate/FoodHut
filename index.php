<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FoodHut | Food Restro</title>

<!-- External styling libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- For Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- carousel library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="icon" href="imgs/logo.png" type="image/png" />
</head>
<body>


<!-- let's design the navbar and the hero section -->

<div class="hero--part">
	<div class="img--box">
		<img src="imgs/heroImage.jpg">
	</div>

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
			          <a class="nav-link active" aria-current="page" href="#">Home</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="./menu.php">Menu</a>
			        </li>
			       	<li class="nav-item">
			          <a class="nav-link" href="#booking">Book A Table</a>
			        </li>
			      	<li class="nav-item">
			          <a class="nav-link" href="#contactPage">Contact</a>
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
				if(isset($_SESSION['paymentId'])){
					echo "<a href='./order.php' class='nav-link'>
						<i class='fa fa-cart-shopping'></i>
						</a>";
				}else{
					echo '<a href="#" class="nav-link"><i class="fa fa-cart-shopping"></i></a>';
				}
			
			 ?>
                
                <?php 
                    if(isset($_SESSION['username'])){
                        echo '<a href="./logout.php" class="px-5 py-2 text-decoration-none text-white bg-warning" style="border-radius: 100px">Sign Out</a>';
                    }else{
                        echo '<button class="px-5 py-2" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign Up</button>';
                    }
                ?>
                
		     </div>
		  </div>
		</div>
	</nav>

	<!-- registration modal section -->

<div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
        <h1 class="modal-title dancing--script" id="exampleModalLabel">Create an Account!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body">
      		<form class="signUpForm" action="./registration.php" method="post" name="signUpForm">
      			<div class="form-group mb-3">
      				<input type="text" 
      				name="username"
      				class="form-control"
      				placeholder="Your Name"
      				required />
      			</div>

      			<div class="form-group mb-3">
      				<input type="email" 
      				name="email"
      				class="form-control"
      				placeholder="Your Email"
      				required />
      			</div>

      			<div class="form-group mb-3">
						<input type="text"
						 name="phone" 
						 class="form-control"
						 id="userPhone"
						 placeholder="Phone Number" 
						 required 
						 />
						 <span id="signup--msg--phone"></span>
					</div>

      			<div class="form-group mb-4">
      				<input type="password" 
      				name="pass"
      				class="form-control"
      				id="userPass" 
      				placeholder="Enter PassWord"
      				required />
      			<span id="msg--for--password"></span>
      			</div>
        <button type="submit" class="px-5 py-2 modal--btn form-control mb-2">Sign Up</button>
      		</form>

      		<div class="text-center text-secondary login--toggler">
      			Have an account? Please
      			<a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#signInModal"> Sign In</a>
      		</div>
      </div>
    </div>
  </div>
</div>

<!-- login modal section -->
<div class="modal fade" id="signInModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-title dancing--script" id="exampleModalLabel">Please Log In</div>
    	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    		<div class="modal-body">
    				<form class="loginForm" name="loginForm" action="./login.php" method="post">
    				<div class="form-group mb-3">
    				<input type="email" 
      				name="email"
      				class="form-control"
      				placeholder="Your Email"
      				required />
    				</div>

    				<div class="form-group mb-4">
      				<input type="password" 
      				name="pass"
      				class="form-control"
      				id="password" 
      				placeholder="Enter PassWord"
      				required />
      			</div>

      			<button type="submit" class="form-control modal--btn px-5 py-2">Sign In</button>
    				</form>
    		</div>
    </div>
  </div>
</div>


	<div id="foodHutCarousel" class="carousel slide">
			<div class="carousel-inner">
			    <div class="carousel-item active">
			    	<div class="container">
				    	<div class="row">
				    		<div class="col-lg-8">
				    			<div class="carousel--text--box">
						    		<h5 class="carousel--title dancing--script">
						    			FoodHut Express Lane: Quick and Tasty Treats Await!
						    		</h5>
						    		<p class="fst-italic">
										"FoodHut Express Lane: Quick, Tasty, Done Right! Indulge in speedy satisfaction with our delicious array of treats. From classic burgers to fresh salads, we've got your cravings covered – served swiftly with a smile. Join us and experience the fast lane to flavor!"
									</p>
				    	</div>
				    	<div class="carousel--btn">
				    	  <a href="about.html" class="btn px-5 py-2">Read More</a>
				    	  <a class="px-5 py-2 order--btn" href="#menu_section">Order Food</a>
				    	</div>
				    	</div>
				    	</div>
			    	</div>

			    </div>
			    <div class="carousel-item">
			         	<div class="container">
				    	<div class="row">
				    		<div class="col-lg-8">
				    			<div class="carousel--text--box">
						    		<h5 class="carousel--title dancing--script">
						    			FoodHut Express Lane: Quick Cravings, Faster Flavors!
						    		</h5>
						    		<p class="fst-italic">
										FastBite FastFood offers quick, flavorful meals for busy individuals. From classic burgers to innovative wraps, our menu satisfies cravings without compromising quality. With efficient service and delicious options, we provide a memorable dining experience on the go.
									</p>
				    	</div>
				    	<div class="carousel--btn">
				    	  <a href="about.html" class="btn px-5 py-2">Know Our Taste</a>
				    	  <a class="px-5 py-2 order--btn" href="./menu.php">Grab A Dish</a>
				    	</div>
				    	</div>
				    	</div>
			    	</div>
			    </div>
			    <div class="carousel-item">
			         	<div class="container">
				    	<div class="row">
				    		<div class="col-lg-8">
				    			<div class="carousel--text--box">
						    		<h5 class="carousel--title dancing--script">
						    			FastBite Express Lane: Quick Cravings, Faster Flavors!
						    		</h5>
						    		<p class="fst-italic">
										"FoodHut Express Lane: Quick, Tasty, Done Right! Indulge in speedy satisfaction with our delicious array of treats. From classic burgers to fresh salads, we've got your cravings covered – served swiftly with a smile. Join us and experience the fast lane to flavor!"
									</p>
				    	</div>
				    	<div class="carousel--btn">
				    	  <a href="#menu_section" class="btn px-5 py-2">Explore Menu</a>
				    	  <a class="px-5 py-2 order--btn" href="./menu.php">Order Now</a>
				    	</div>
				    	</div>
				    	</div>
			    	</div>
			    </div>
		  </div>

  <ol class="carousel-indicators">
    <li type="button" data-bs-target="#foodHutCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></li>
    <li type="button" data-bs-target="#foodHutCarousel" data-bs-slide-to="1" aria-label="Slide 2"></li>
    <li type="button" data-bs-target="#foodHutCarousel" data-bs-slide-to="2" aria-label="Slide 3"></li>
  </ol>
</div>
<!-- carousel part is done! -->

</div>

<!-- hero section is also done! -->

<section class="food--menu">
	<div class="container">
		<h5 class="title dancing--script">Explore Dishes</h5>
		<div class="row g-5">
			<div class="col-lg-6">
				<div class="menu--content">
					<div class="row g-5">
						<div class="col-sm-4">
							<div class="img--box">
								<img src="imgs/itemPizzacom.jpg">
							</div>	
						</div>
					<div class="col-sm-8">
						<div class="text--area">
							<h5 class="menu--title dancing--script">Tasty Pizza</h5>
							<p class="fst-italic">Experience a taste sensation that's impossible to resist - every bite of our pizza is a flavor explosion!</p>
							<h5 class="price">&#8377;199<small class="text-white-50"><del>299</del></small></h5>
							<a href="/item/addtocart" class="px-5 py-2 btn">
								<i class="fa fa-cart-shopping"></i>
								Taste It Now
							</a>
						</div>
					</div>
					</div>
				</div>
			</div>

				<div class="col-lg-6">
				<div class="menu--content">
					<div class="row g-5">
						<div class="col-sm-4">
							<div class="img--box">
								<img src="imgs/itemBurgercom.jpg">
							</div>	
						</div>
					<div class="col-sm-8">
						<div class="text--area">
							<h5 class="menu--title dancing--script">Spicy Burger</h5>
							<p class="fst-italic">Indulge in burger bliss with our handcrafted creations, where every bite is a symphony of flavor and texture!</p>
						<h5 class="price">&#8377;149<small class="text-white-50"><del>249</del></small></h5>
							<a href="/item/addtocart" class="px-5 py-2 btn cart--btn2">
								<i class="fa fa-cart-shopping"></i>
								Grab Your Dish
							</a>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- this section is done! -->

<section class="about--section">
	<h5 class="about--title dancing--script">About Us</h5>
	<div class="about--field">
		<div class="container">
			<div class="row g-4 g-lg-2">
			<div class="col-lg-6 order-2 order-lg-1">
				<div class="img--box">
					<img src="imgs/aboutHam.png">
				</div>
			</div>
		<div class="col-lg-6 order-1 order-lg-2">
			<div class="about--text--area">
				<h5 class="about--sub--title dancing--script">At FoodHut</h5>
				<p class="about--details">
Welcome to FoodHut, where fast food meets flavor and convenience! At FoodHut, we're passionate about serving up delicious meals that satisfy your cravings in no time. Whether you're in a rush or simply looking for a quick bite, our diverse menu has something for everyone.</p>
				<a href="about.html" class="btn px-5 py-2">Know More</a>
			</div>
		</div>
		</div>
		</div>
	</div>
</section>

<div class="filtered--dishes" id="menu_section">
	<!-- make filter function to filter out items... -->
	<h5 class="filter--section--title dancing--script">Our Menu</h5>
	<ul class="filter--menu">
		<li data-filter = "all" class="active">All</li>
		<li data-filter = "pizza">Pizza</li>
		<li data-filter = "burger">Burger</li>
		<li data-filter = "pasta">Pasta</li>
		<li data-filter = "fries">Fries</li>
	</ul>
	<div class="container">
		<div class="row pt-4 food--content">
			<!-- dynamic contents go here... -->
		</div>
	</div>
</div>
<!-- filter dish part is done! -->

<!-- table booking section -->
<section class="booking--table" id="booking">
	<h5 class="booktable--title dancing--script">Book A Table</h5>
	<div class="container">
		<div class="row g-5">
			<div class="col-lg-6">
				<form action="booktable.php" name="bookATable" method="post" class="tableForm">
					<div class="form-group mb-2">
						<label for="customerName">Your Name</label>
						<input type="text"
						 name="customerName" 
						 class="form-control"
						 required 
						 />
					</div>
					<div class="form-group mb-2">
						<label for="customerPhone">Phone Number</label>
						<input type="text"
						 name="customerPhone" 
						 class="form-control"
						 id="customerPhone"
						 required 
						 />
						 <span id="msgForPhone"></span>
					</div>
					<div class="form-group mb-2">
						<label for="customerDate">Book A Date</label>
						<input type="date"
						 name="customerDate" 
						 class="form-control"
						 required 
						 />
					</div>
						<div class="form-group mb-3">
						<label for="customerDate">Select Table For</label>
						<select name="customerCount" class="form-control" required>
							<option value="">How many Persons?</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
				<button class="px-5 py-2 submit" type="submit">Book Table</button>
				</form>
			</div>

			<div class="col-lg-6">
				<div id="restaurantVideo">
					<video controls autoplay loop>
						<source src="imgs/restaurantVideoCom.mp4" type="video/mp4">
						This Browser does not support Video
					</video>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Testimony section -->

<section class="testimony">
	<div class="container">
		<h5 class="dancing--script testimony--title">What Say Our Customers!</h5>
		<div class="carousel-wrap row">
				<div class="owl-carousel client--carousel">
				<div class="item">
					<div class="testimonial--box">
						<div class="text--area">
						<h5 class="testimony--subtitle dancing--script">Jhon Doe</h5>
						<p>Absolutely delightful experience at this restaurant! From the moment we walked in, we were greeted warmly and seated promptly. The food was exquisite, bursting with flavor and presented beautifully. The service was top-notch, attentive without being overbearing. Will definitely be returning soon!</p>

						<div class="ratings">
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
					 <small>Wonderful!</small>
					</div>
					</div>

					<div class="img--box">
						<img src="imgs/customer1.jpg" alt="a valuable customer!">
					</div>
					</div>
				</div>

					<div class="item">
					<div class="testimonial--box">
						<div class="text--area">
						<h5 class="testimony--subtitle dancing--script">Katy Parry</h5>
						<p>Absolutely delightful experience at this restaurant! From the moment we walked in, we were greeted warmly and seated promptly. The food was exquisite, bursting with flavor and presented beautifully. The service was top-notch, attentive without being overbearing. Will definitely be returning soon!</p>
					<div class="ratings">
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star"></span>
					 <small>Awesome!</small>
					</div>
					</div>

					<div class="img--box">
						<img src="imgs/customer2.jpg" alt="a valuable customer!">
					</div>
					</div>
				</div>	

		</div>


		</div>
				
	</div>
</section>



<footer class="footer--part" id="contactPage">
	<div class="container">
		<div class="row g-5">
			<div class="col-lg-4">
				<div class="footer--text--area">
					<h5 class="footer--title dancing--script">Contact</h5>
					<div class="mt-2 footer--subtitle">
							<p><i class="fa fa-home me-1"></i>
								Kolkata, India, SaltLake
							</p>
							<p><i class="fa fa-envelope me-1"></i>
								foodhut@yahoo.com
							</p>

							<p><i class="fa fa-phone me-1"></i>
								+91 009-334-878
							</p>
					</div>
				</div>
			</div>


			<div class="col-lg-4">
				<div class="footer--text--area">
				<h5 class="footer--title dancing--script">FoodHut</h5>
				<p class="footer--subtitle">
				At FoodHut, savor the symphony of spices in every bite, where each dish tells a tale of culinary delight.
				</p>
				<div class="footer--social--links">
					<a href="">
						<i class="fab fa-facebook"></i>
					</a>
					<a href="">
						<i class="fab fa-instagram"></i>
					</a>

					<a href="">
						<i class="fab fa-twitter"></i>
					</a>
					<a href="">
						<i class="fab fa-linkedin"></i>
					</a>
				</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="footer--text--area">
				<h5 class="footer--title dancing--script">Opening Hours</h5>
				<p class="footer--subtitle">
				8.00 AM - 8.00 PM
				</p>
				</div>
			</div>
		</div>

		<div class="footer--tail">
		<p class=""> &copy; Copyright <span id="year"></span>FoodHut. All rights reserved. Designed & Developed By <a href="https://github.com/latnuk-mate" class="text-decoration-none text-white-50" target="_blank">@latnuk-mate</a>.</p>
	</div>
	</div>

	
</footer>


<!-- External Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript" src="js/index.js"></script>


</body>
</html>