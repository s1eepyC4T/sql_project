<?php
require_once("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $m_name = $_POST['m_name'];
    $m_tel = $_POST['m_tel'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_pass'];

    if ($password != $confirm_pass) {
        echo 'Password and Confirm Password is not the same';
        echo'<br>';
        echo "<td><a href='regis_form.php'>Back</a></td>";
        exit();}

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO member(m_name, m_tel, email, username, password)
        VALUES ('$m_name', '$m_tel', '$email', '$username', '$hashedPassword');";
     $insertResult = mysqli_query($connect, $sql);
    if($insertResult){
        $newMember = mysqli_insert_id($connect);
        echo "Member registered successfully.";
        echo "<br>";
        echo "<a href='regis_form.php'>Back</a>";

        header('Location: login.php');
        exit();}   
    else {
        // Error registering member
        echo "Error: " . mysqli_error($connect);
        echo "<br>";
        echo "<a href='regis_form.php'>Back</a>";
    }
}
$connect->close();

?>