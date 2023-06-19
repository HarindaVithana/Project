<?php 
include "../config.php";

// var_dump($_POST);
// Retrieve form data
$target_dir = "../Uploads"; // Added by Vithana94
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // Added by Vithana94
$uploadOk = 1; // Added by Vithana94
$pdfFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // Added by Vithana94

$NIC = $_POST['inputNIC'];
$Email = $_POST['inputEmail'];
$Date = $_POST['inputDate'];
$medical = $_POST['inputMed'];
$Radios = $_POST['gridRadios'];
$Comment = $_POST['inputComment'];

// Added by Vithana94
if(isset($_POST["submit"])) 
{
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
}

if ($uploadOk == 0) 
{
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
}
// -----------------

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
    // Close the connection
    $mysqli->close();
    echo '<script type="text/javascript">'; 
    echo 'alert("Your Renewal form submitted");'; 
    echo 'window.location.href = "../index.php";';
    echo '</script>';
} else {
    echo "Error: " . $mysqli->error;

    // Close the connection
    $mysqli->close();
}




?>