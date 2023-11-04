<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>

    <?php
require_once ('encrypt_function.php');
require_once ('login.php');

    // Check if the user is logged in (based on the session variable)
    if (isset($_SESSION['loggedInUsername'])) {
        $loggedInUsername = $_SESSION['loggedInUsername'];

        // Database configuration
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "database"; // Corrected database name

        // Create a database connection
        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve user data (username, email, and encrypted password) from the database
        $sql = "SELECT username, email, encrypted_password FROM users WHERE username = '$loggedInUsername'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $email = $row['email'];
            $encryptedPassword = $row['encrypted_password'];

            // Display user data
            echo "<p>Username: $username</p>";
            echo "<p>Email: $email</p>";
            echo "<p>Encrypted Password: $encryptedPassword</p>";
        } else {
            echo "User not found or an error occurred.";
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "You are not logged in. Please log in to view your profile.";
    }
    ?>
</body>
</html>
