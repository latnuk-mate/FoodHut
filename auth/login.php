<?php
// init the session...
     session_start();

// parsing the env file...
$env = parse_ini_file('../.env');

// database credentials for postgreSQL...
$connString = $env['CONNECTION_STRING'];
   

    if($_POST){

    //  connect the database...
    $conn = pg_connect($connString);

    if(!$conn){
        die('connection failed'.pg_last_error());
    }

        $email = $_POST['email'];
        $password = $_POST['pass'];

        $query = "SELECT name , email , password FROM UserRecord WHERE email = '$email'";

        $result = pg_query($conn, $query);
        
        $data = pg_fetch_assoc($result);
    

            if($data['email'] == $email and $data['password'] == $password){
                $_SESSION['username'] = $data['name'];
                pg_close($conn);
                header('Location: /');
            }
            else{ echo 'something went wrong!';}

     }


 ?>
