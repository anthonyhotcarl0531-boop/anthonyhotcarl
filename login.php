<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);	

$conn = new mysqli("localhost", "root", "", "test_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Result</title>
    <style>
        body {
            font-family: Arial;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0f172a;
            color: white;
        }
        .box {
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            width: 350px;
        }
        .success {
            background: #22c55e;
        }
        .error {
            background: #ef4444;
        }
        a {
            color: white;
            display: block;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="box">

<?php

if ($result->num_rows > 0) {

    echo "<div class='success'>
            <h1>Welcome $username!</h1>
          </div>";

} else {

    
    $checkUser = "SELECT * FROM users WHERE username='$username'";
    $userResult = $conn->query($checkUser);

    if ($userResult->num_rows > 0) {
        echo "<div class='error'>
                <h2>Username and password are incorrect.</h2>
                <a href='login.html'>Try Again</a>
              </div>";
    } else {
        echo "<div class='error'>
                <h2>User not found. Please sign up.</h2>
                <a href='customer.html'>Register</a>
              </div>";
    }
}

$conn->close();
?>

</div>

</body>
</html>