<?php 
   session_start();

   if(isset($_SESSION['username'])){
    $name = $_SESSION['username'];
   }

   // parsing the env file...
    $env = parse_ini_file('../.env');
   
   // database creadentials....
   $hostname = $env['HOSTNAME'];
   $username = $env['USERNAME'];
   $password = $env['PASSWORD'];
   $dbName =   $env['DATABASE']; 


       //  connect the database...
$conn = mysqli_connect($hostname, $username, $password, $dbName);

if(!$conn){
    die('connection failed'.mysqli_connect_error());
}

$queryUser = "DELETE FROM userrecord WHERE name='$name'";
$queryProduct = "DELETE FROM productData WHERE user='$name'";
$queryTable = "DELETE FROM booktable WHERE user='$name'";

$queryList = array($queryUser, $queryProduct, $queryTable);

function deleteUser($list, $conn){
    try{
        foreach($list as $query){
            mysqli_query($conn , $query);
        }

    }catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }

    return true;
}


    if(deleteUser($queryList, $conn)){
            mysqli_close($conn);
        
        // delete the session record..
            $_SESSION = array();
            session_destroy();

        // on successfull response redirects to ....
        header('Location: /');
    }else{
        die('failed to insert data'.mysqli_error($conn)); 
    }

?>