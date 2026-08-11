<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "test_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$location = $_POST['location'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if username exists
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: customer.html?error=userexists&username=$username&location=$location");
    exit();
}

// Check password match
if ($password != $confirm_password) {
    header("Location: customer.html?error=passmismatch&username=$username&location=$location");
    exit();
}

// Insert if valid
$insert = "INSERT INTO users (username, location, password)
           VALUES ('$username', '$location', '$password')";

if ($conn->query($insert) === TRUE) {
    header("Location: login.html");
    exit();
} else {
    echo "Database Error: " . $conn->error;
}

$conn->close();
?>