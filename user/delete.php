<?php 
   session_start();

   if(isset($_SESSION['username'])){
    $name = $_SESSION['username'];
   }

   // parsing the env file...
    $env = parse_ini_file('../.env');
   
// database credentials for postgreSQL...
$connString = $env['CONNECTION_STRING'];


       //  connect the database...
$conn = pg_connect($connString);

if(!$conn){
    die('connection failed'.pg_last_error());
}

$queryUser = "DELETE FROM userrecord WHERE name='$name'";
$queryProduct = "DELETE FROM productData WHERE ct_user='$name'";
$queryTable = "DELETE FROM booktable WHERE ct_user='$name'";

$queryList = array($queryUser, $queryProduct, $queryTable);

function deleteUser($list, $conn){
    try{
        foreach($list as $query){
            pg_query($conn , $query);
        }

    }catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }

    return true;
}


    if(deleteUser($queryList, $conn)){
            pg_close($conn);
        
        // delete the session record..
            $_SESSION = array();
            session_destroy();

        // on successfull response redirects to ....
        header('Location: /');
    }else{
        die('failed to insert data'.pg_last_error($conn)); 
    }

?>