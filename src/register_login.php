<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "user_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        $user_id = $_POST['user_id'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (user_id, email, password) VALUES ('$user_id', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "New record created successfully";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
            $_SESSION['message_type'] = "error";
        }
    }

    if (isset($_POST['login'])) {
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE user_id='$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['message'] = "Login successful";
                $_SESSION['message_type'] = "success";
                header("Location: interfata.php");
                exit();
            } else {
                $_SESSION['message'] = "Invalid password";
                $_SESSION['message_type'] = "error";
            }
        } else {
            $_SESSION['message'] = "No user found with that ID";
            $_SESSION['message_type'] = "error";
        }
    }

    header("Location: login.php");
    exit();
}

$conn->close();
