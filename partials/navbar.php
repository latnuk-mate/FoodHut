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
                        echo '<a href="#" title="Profile" class="nav-link" data-bs-toggle="modal" data-bs-target="#settingModal">'.$_SESSION['username'].'<i class="fa fa-user ms-1"></i></a>';
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