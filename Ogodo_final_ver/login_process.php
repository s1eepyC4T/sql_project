<?php
require_once("connect.php");

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM member WHERE username = '$username'";
$result = mysqli_query($connect, $query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['user_id'] = $row['m_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['m_name'];
        
        header('Location: user_home.php');
    } else {
            echo "Invalid username or password";
            echo "<br>";
            echo "<a href='login.php'>Back</a>";
    } 
} else {
        echo "Error: " . mysqli_error($connect);
        echo "<br>";
        echo "<a href='login.php'>Back</a>";
    }
        
?>