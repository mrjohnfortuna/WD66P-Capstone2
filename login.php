<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$registeredUsers = array();

function registerUser($username, $password) {
    global $registeredUsers;
    $registeredUsers[$username] = $password;
}

$defaultUsername = 'admin';
$defaultPassword = 'password';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["login"])) {

        $username = $_POST["username"];
        $password = $_POST["password"];


        if ($username === $defaultUsername && $password === $defaultPassword) {

            $_SESSION['authenticated'] = true;


            header("Location: dashboard.php");
            exit();
        } elseif (isset($registeredUsers[$username]) && $registeredUsers[$username] === $password) {
           
            $_SESSION['authenticated'] = true;

            header("Location: dashboard.php");
            exit();
        } else {

            header("Location: index.html?error=1");
            exit();
        }
    } elseif (isset($_POST["register"])) {

        $username = $_POST["username"];
        $password = $_POST["password"];


        registerUser($username, $password);


        header("Location: dashboard.php");
        exit();
    }
}
?>
