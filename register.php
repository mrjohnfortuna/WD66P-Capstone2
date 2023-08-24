<!DOCTYPE html>
<html lang="en">
  <head>
    <script>
      function validateForm() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if (username === "" || password === "") {
          alert("Please fill in all fields.");
          return false;
        }

        return true;
      }
    </script>
  </head>
  <body>
    <form action="register.php" method="post" onsubmit="return validateForm();">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required />
      <br />
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required />
      <br />
      <button type="submit" name="register">Register</button>
    </form>

    <?php
    // Include the registration logic from your login.php file
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["register"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        registerUser($pdo, $username, $password);
        loginUser($pdo, $username, $password);
    }
    ?>
  </body>
</html>
