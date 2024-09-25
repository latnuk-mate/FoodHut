<?php 
    // init the database...

    // database creadentials....
    $hostname = 'localhost';
    $username = 'root';
    $password = 'Kuntal@2001';
    $dbName = 'foodhut';

    //  connect the database...
$conn = mysqli_connect($hostname, $username, $password, $dbName);
if($conn){
    echo "database connected!";
}else{
    echo "connection failed!".mysqli_connect_error();
}

// creating a table...
    $query = "CREATE TABLE UserRecord (
            user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            phone VARCHAR(15) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

    if(mysqli_query($conn , $query)){
        echo "table created successfull!";
    }else{
        echo "Table creation failed!";
    }

// // close the connection...
    mysqli_close($conn);


?>