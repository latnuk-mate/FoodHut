<?php 
require '../partials/checkMailDomain.php';

// initializing the session..
 session_start();

// parsing the env file...
 $env = parse_ini_file('../.env');

// database creadentials....
$hostname = $env['HOSTNAME'];
$username = $env['USERNAME'];
$password = $env['PASSWORD'];
$dbName =   $env['DATABASE'];

function sanitizeInputs($input , $filter){
    $data = filter_var(trim($input) , $filter);
    if($data == false){
        return false;
    }

    return $data;
}


if($_POST){

//  connect the database...
$conn = mysqli_connect($hostname, $username, $password, $dbName);

if(!$conn){
    die('connection failed'.mysqli_connect_error());
}

$name = sanitizeInputs($_POST['username'], FILTER_UNSAFE_RAW);
$email = sanitizeInputs($_POST['email'], FILTER_VALIDATE_EMAIL);
$password = $_POST['pass'];
$phone = sanitizeInputs($_POST['phone'], FILTER_VALIDATE_INT);

// this is for checking inside the db...
    $query_for_phone = "SELECT phone FROM UserRecord";
    $result = mysqli_query($conn, $query_for_phone);

    function isInsideDB($phone, $result){
            while($data = mysqli_fetch_assoc($result)){
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

        if(mysqli_query($conn , $query)){
         mysqli_close($conn);
 
         header('Location: /');
     }
     else{
       die('failed to insert data'.mysqli_error($conn));  
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