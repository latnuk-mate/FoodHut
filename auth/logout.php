<?php 
// Get the session ready...
session_start();


// unsetting all the variables...
$_SESSION = array();

// finally destroy the session..
session_destroy();

header("Location: /index.php");

?>