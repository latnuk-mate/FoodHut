<?php 
session_start();

if(!isset($_SESSION['username'])){
    header('Location: ./error.php');
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
                  <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./Menu.php">Menu</a>
                </li>
                   <li class="nav-item">
                  <a class="nav-link" href="./index.php#booking">Book A Table</a>
                </li>
                  <li class="nav-item">
                  <a class="nav-link" href="./index.php#contactPage">Contact</a>
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
             <a href="" class="nav-link">
                 <i class="fa fa-cart-shopping"></i>
             </a>
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

<div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <h1 class="modal-title dancing--script" id="exampleModalLabel">Create an Account!</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  <div class="modal-body">
          <form class="signUpForm" action="registration.php" method="post" name="signUpForm">
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
                <form class="loginForm" name="loginForm" action="login.php" method="post">
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


<!-- script files... -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    const urlParams = new URLSearchParams(location.search)
    const id = urlParams.get('foodId');
    const page = urlParams.get('page');
    

    if(page == 'menu'){
        getMenuItems("https://www.themealdb.com/api/json/v1/1/search.php?s=");
    }else{
        getMenuItems('./data.json');
    }

function getMenuItems(url){
    fetch(url)
    .then(response => response.json())
    .then((data) => {
        const items = data.meals;
        items.map((item, index)=>{
            if(index == id){
                renderElements(item, index)
            }
        })
    })
    .catch(err => console.log(err.code));
}


    function renderElements(item, index){
            const parentElement = document.querySelector('.checkOutFood');
            parentElement.innerHTML = `
                <div class="col-md-6 shadow-lg order-2 order-md-1">
                    <div class="p-3">
                     <div class="img--box">
                        <img src="${item.strMealThumb}" alt="Ordering food">
                    </div>
                    <div class="mt-3 fst-italic leading-2 fs-5">
                            ${item['description'] ?? ""}
                    </div>
                </div>
             </div>

             <div class="col-md-6 order-1 order-md-2">
                    <div class="order--text--area">
                         <h5 class="mb-3">${item.strMeal}</h5>
                        <h5 class="price">Price : &#8377;${item['discountPrice'] || (80 + index)*3}</h5>
                    <form action="./checkout.php?item=${item.strMeal}&price=${item['discountPrice'] || (80 + index)*3}&image=${item.strMealThumb}" method="post">
                    <div class="form-group mb-1">
						<label for="customerName">Your Name</label>
						<input type="text"
						 name="userName" 
						 class="form-control"
						 required 
						 />
					</div>
                	<div class="form-group mb-1">
						<label for="customerPhone">Phone Number</label>
						<input type="text"
						 name="customerPhone" 
						 class="form-control"
						 id="customerPhone"
						 required 
						 />

                		<div class="form-group mb-3">
						<label for="customerDate">Select Table For</label>
						<select name="itemCount" class="form-control" required>
							<option value="">Number of Items?</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
                         <button class="d-flex align-items-center gap-2 px-5 py-2 justify-content-center" type="submit">
                            <i class="fa fa-cart-shopping"> </i>
                        Buy Now</button>
                    </form>
                    </div>
             </div>
            
            `
    }

</script>
</body>
</html>

