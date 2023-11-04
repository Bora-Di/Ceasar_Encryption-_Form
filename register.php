<?php

session_start(); 
 require_once('encrypt_function.php');
 
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
 
 if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
     $username = $_POST['username'];
     $password = $_POST['password'];
     $email = $_POST['email'];
 
     // Encrypt the password
     $encryptedPassword = caesarEncrypt($password, 5); // Use the Caesar cipher with a shift of 5
 
     // Insert user data into the database
     $sql = "INSERT INTO users (username, email, encrypted_password) VALUES ('$username', '$email', '$encryptedPassword')";
 
     if ($conn->query($sql) === true) {
         // Store the logged-in username in a session variable
         $_SESSION['loggedInUsername'] = $username;
         echo "Registration successful";
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }
 }
 
 // Close the database connection
 $conn->close();
 ?>
 