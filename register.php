<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h1>User Registration</h1>
    <?php
    session_start();
    include('dbcon.php'); 

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["register"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("ss", $username, $hashedPassword);
        
        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Registration failed. Please try again.";
        }
    }
    ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>
