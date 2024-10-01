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

<script>
    const urlParams = new URLSearchParams(location.search)
    const id = urlParams.get('foodId');
    const page = urlParams.get('page');
    

    if(page == 'menu'){
        getMenuItems("./item.json");
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

