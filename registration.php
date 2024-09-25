<?php 


// initializing the session..
 session_start();


// database creadentials....
$hostname = 'localhost';
$username = 'root';
$password = 'Kuntal@2001';
$dbName = 'foodhut';

function sanitizeInputs($input , $filter){
    $data = filter_var(trim($input) , $filter);
    if($data == false){
        return false;
    }

    return $data;
}


if($_POST){
 $_SESSION['username'] = $_POST['username'];

//  connect the database...
$conn = mysqli_connect($hostname, $username, $password, $dbName);

if(!$conn){
    die('connection failed'.mysqli_connect_error());
}

$name = sanitizeInputs($_POST['username'], FILTER_UNSAFE_RAW);
$email = sanitizeInputs($_POST['email'], FILTER_VALIDATE_EMAIL);
$password = $_POST['pass'];
$phone = sanitizeInputs($_POST['phone'], FILTER_VALIDATE_INT);

   $query = "INSERT INTO UserRecord (name, password, email, phone)
                VALUES('$name', '$password' , '$email', '$phone')";

    if(mysqli_query($conn , $query)){
        mysqli_close($conn);
        header('Location: ./index.php');
    }
    else{
      die('failed to insert data'.mysqli_error($conn));  
    } 
   
}

?>