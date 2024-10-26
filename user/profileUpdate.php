<?php 
session_start();

   // parsing the env file...
   $env = parse_ini_file('../.env');
   
   // database creadentials....
   $hostname = $env['HOSTNAME'];
   $username = $env['USERNAME'];
   $password = $env['PASSWORD'];
   $dbName =   $env['DATABASE'];

if($_POST){

    $name = $_POST['updateName'];
    $phone = $_POST['updatePhone'];

    $user = $_SESSION['username'];

    //  connect the database...
    $conn = mysqli_connect($hostname, $username, $password, $dbName);

    if(!$conn){
        die('connection failed'.mysqli_connect_error());
    }
    
    
    $query = "UPDATE userrecord SET name='$name' , phone='$phone' WHERE name='$user'";

    if(mysqli_query($conn , $query)){
        mysqli_close($conn);
        $_SESSION['username'] = $name;
        header("Location: /user/profile.php");
    }else{
        die('failed to insert data'.mysqli_error($conn)); 
    }

}

?>