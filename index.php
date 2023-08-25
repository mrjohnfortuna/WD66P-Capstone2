<?php
session_start();

// Establish database connection here
$host = "localhost";
$username = "root";
$password = "";
$dbname = "user_auth";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = ?"; // Use a prepared statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['authenticated'] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Unsuccessful Login. Please check your credentials.";
        }
    } else {
        $error_message = "Unsuccessful Login. Please check your credentials.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>IBI Applicant Tracking System Login or Signup</title>
    
    <!-- Custom Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap"
      rel="stylesheet"
    />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="index.css" />
</head>
<body>
    <!-- Your existing content -->
    <form method="post" action="">
        <!-- Your form fields -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required /><br /><br />

        <label for="password">Password:</label>
        <input
            type="password"
            id="password"
            name="password"
            required
        /><br /><br />

        <button type="submit" name="login">Login</button>
        <a href="register.php">Register</a>
    </form>
    
    <?php
    // Display error message if set
    if (isset($error_message)) {
        echo '<div class="error-message">' . $error_message . '</div>';
    }
    ?>
    
</body>
</html>
