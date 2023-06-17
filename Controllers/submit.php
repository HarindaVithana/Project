<?php 
include "../config.php";

var_dump($_POST);
// Retrieve form data
$NIC = $_POST['inputNIC'];
$Email = $_POST['inputEmail'];
$Date = $_POST['inputDate'];
$medical = $_POST['inputMed'];
$Radios = $_POST['gridRadios'];
$Comment = $_POST['inputComment'];

// Create a new MySQLi instance
$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Prepare the SQL statement
$sql = "INSERT INTO `renewals`(`nic`, `email`, `date`, `medical`, `renewal_type`, `comment`) VALUES ('$NIC','$Email','$Date','$medical','$Radios','$Comment')";

// Execute the query
if ($mysqli->query($sql) === TRUE) {
    echo "Record inserted successfully.";
} else {
    echo "Error: " . $mysqli->error;
}

// Close the connection
$mysqli->close();

?>