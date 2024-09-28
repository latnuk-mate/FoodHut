<?php
// init the session...
     session_start();

// parsing the env file...
$env = parse_ini_file('../.env');

// database creadentials....
$hostname = $env['HOSTNAME'];
$username = $env['USERNAME'];
$password = $env['PASSWORD'];
$dbName =   $env['DATABASE'];
   

    if($_POST){

    //  connect the database...
    $conn = mysqli_connect($hostname, $username, $password, $dbName);

    if(!$conn){
        die('connection failed'.mysqli_connect_error());
    }

        $email = $_POST['email'];
        $password = $_POST['pass'];

        $query = "SELECT name , email , password FROM UserRecord WHERE email = '$email'";

        $result = mysqli_query($conn, $query);
        
        $data = mysqli_fetch_assoc($result);
    

            if($data['email'] == $email and $data['password'] == $password){
                $_SESSION['username'] = $data['name'];
                mysqli_close($conn);
                header('Location: /index.php');
            }
            else{ echo 'something went wrong!';}

     }


 ?>
