<?php
function caesarEncrypt($plaintext, $shift) {
    $encryptedText = '';
    $textLength = strlen($plaintext);

    for ($i = 0; $i < $textLength; $i++) {
        $char = $plaintext[$i];
        $isUppercase = false; // Initialize to false by default
        $charCode = ord($char); // Initialize charCode with the ASCII value of the character

        if (ctype_alpha($char)) {
            $isUppercase = ctype_upper($char);
            $char = strtolower($char);
            $charCode = ord($char);
            $charCode = (($charCode - ord('a') + $shift) % 26) + ord('a');
        } elseif (ctype_digit($char)) {
            $charCode = ord('0') + (($charCode - ord('0') + $shift) % 10);
        }

        if ($isUppercase) {
            $char = strtoupper(chr($charCode));
        } else {
            $char = chr($charCode);
        }

        $encryptedText .= $char;
    }

    return $encryptedText;
}


// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "encryted_from";

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Encrypt the password
    $encryptedPassword = caesarEncrypt($password, 3); // Use the Caesar cipher with a shift of 3

    // Insert user data into the database
    $sql = "INSERT INTO usertest (username, encrypted_password) VALUES ('$username', '$encryptedPassword')";

    if ($conn->query($sql) === true) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
    <title>Form</title>
</head>
<body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">

          <form action="post" class="sign-in-form">

            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" nmae="password" placeholder="Password" />
            </div>
            <input type="submit" value="Login" class="btn solid" />

            <p class="social-text">Or Sign in with social platforms</p>

            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>

          <form action="post" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" />
            </div>
            
            <input type="submit" class="btn" value="Sign up" />
            
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
              ex ratione. Aliquid!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="script.js"></script>
  </body>
</html>