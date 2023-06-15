<?php
 

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'dlrs';
    

    // Establishing a database connection
    $con = mysqli_connect($host, $username, $password, $database);
    if (!$con) {
        die('Failed to connect to the database: ' . mysqli_connect_error());
    }

?>
