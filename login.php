<?php

session_start(); 
 require_once('encrypt_function.php');

 $login_successful = false;  // Initialize $login_successful as false

 // Database configuration
 $host = "localhost";
 $username = "root";
 $password = "";
 $dbname = "database";
 
 // Create a database connection
 $conn = new mysqli($host, $username, $password, $dbname);
 
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 
 if (isset($_POST['username']) && isset($_POST['password'])) {
     $username = $_POST['username'];
     $password = $_POST['password'];
 
     // Encrypt the password
     $encryptedPassword = caesarEncrypt($password, 5); // Use the Caesar cipher with a shift of 5
 
     // Check if the username and encrypted password match in the database
     $sql = "SELECT username FROM users WHERE username = '$username' AND encrypted_password = '$encryptedPassword'";
     $result = $conn->query($sql);
 
     if ($result->num_rows == 1) {
           // Login is successful
           $login_successful = true;
           // Store the logged-in username in a session variable 
           $_SESSION['loggedInUsername'] = $username;
     } else {
           // Login failed
           $login_successful = false;
}
}

// Close the database connection
$conn->close();

if ($login_successful) {
// Redirect to profile.php
header("Location: profile.php");
exit;
} else {
echo " ";
}
?>
