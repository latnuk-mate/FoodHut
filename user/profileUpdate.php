<?php 
session_start();

   // parsing the env file...
   $env = parse_ini_file('../.env');
   
// database credentials for postgreSQL...
$connString = $env['CONNECTION_STRING'];

if($_POST){

    $name = $_POST['updateName'];
    $phone = $_POST['updatePhone'];

    $user = $_SESSION['username'];

    //  connect the database...
    $conn = pg_connect($connString);

    if(!$conn){
        die('connection failed'.pg_last_error());
    }
    
    
    $query = "UPDATE userrecord SET name='$name' , phone='$phone' WHERE name='$user'";

    if(pg_query($conn , $query)){
        pg_close($conn);
        $_SESSION['username'] = $name;
        header("Location: /user/profile.php");
    }else{
        die('failed to insert data'.pg_last_error($conn)); 
    }

}

?>