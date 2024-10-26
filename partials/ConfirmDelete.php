<?php
session_start();

if(!isset($_SESSION['username'])){
    header('Location: ../partials/error.php');
}

$user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirm Delete || Delete Consent!</title>
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
   <div class="consentPage m-auto shadow-sm rounded mt-3 border">
        <h5 class="user--title">Hello, <?php echo $user; ?>!</h5>
        <p>Are Your Sure, Deleting Your Account?</p>
        <div class="action--area">
            <button onclick="history.back()" class="btn btn-dark px-5 py-2 rounded-pill">Back</button>
            <a href="/user/delete.php" class="deleteBtn px-5 py-2 btn">Delete</a>
        </div>
   </div> 
</body>
</html>