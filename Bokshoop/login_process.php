<?php
require_once("connect.php");

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM staff WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['staff_id'] = $row['staff_id'];
            $_SESSION['staff_name'] = $row['staff_name'];
            header('Location: scanMem.php');
        } else {
            echo "Invalid username or password";
            echo "<br>";
            echo "<a href='login.html'>Back</a>";
    } 
    } else {
        echo "Error: " . mysqli_error($connection);
        echo "<br>";
        echo "<a href='login.html'>Back</a>";
    }
        
?>