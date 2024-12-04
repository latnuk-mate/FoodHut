<?php 
require '../partials/checkMailDomain.php';

// initializing the session..
 session_start();

// parsing the env file...
 $env = parse_ini_file('../.env');

// database credentials for postgreSQL...
$connString = $env['CONNECTION_STRING'];


function sanitizeInputs($input , $filter){
    $data = filter_var(trim($input) , $filter);
    if($data == false){
        return false;
    }

    return $data;
}


if($_POST){

// connect PostgreSQL DB...
$conn = pg_connect($connString);

if(!$conn){
    die('connection failed'.pg_last_error());
}

$name = sanitizeInputs($_POST['username'], FILTER_UNSAFE_RAW);
$email = sanitizeInputs($_POST['email'], FILTER_VALIDATE_EMAIL);
$password = $_POST['pass'];
$phone = sanitizeInputs($_POST['phone'], FILTER_VALIDATE_INT);

// this is for checking inside the db...
    $query_for_phone = "SELECT phone FROM UserRecord";
    $result = pg_query($conn, $query_for_phone);

    function isInsideDB($phone, $result){
            while($data = pg_fetch_assoc($result)){
                if($data['phone'] == $phone){
                    return false;
                }else{
                    return true;
                }
            }
    }


   $query = "INSERT INTO UserRecord (name, password, email, phone)
                VALUES('$name', '$password' , '$email', '$phone')";

if(checkMail($email)){ // checking the mail domain records...

    if(isInsideDB($phone, $result)){

        $_SESSION['username'] = $name; // creating user session...

        if(pg_query($conn , $query)){
            pg_close($conn);
 
         header('Location: /');
     }
     else{
       die('failed to insert data'.pg_last_error($conn));  
     }

    }else{
        $_SESSION['invalidPhone'] = "Phone Number is already in the record!";
        header("Location: /");
    }      
}else{
    $_SESSION['invalidEmail'] = "Email does not have a valid domain!";
    header("Location: /");
}

}

?>