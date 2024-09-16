<?php
require_once("connect.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$ac_id = $_SESSION['ac_id'];
$check_in_date = $_POST['check_in_date'];
$check_out_date = $_POST['check_out_date'];
$user_id = $_SESSION['user_id'];
$num_p = $_POST['num_p'];
$q ="select price from accommodatiom where ac_id =$ac_id";


$acc = mysqli_fetch_assoc(mysqli_query($connect,$q));
$price =$acc['price'];
    echo"$ac_id";
    echo'<br>';
    echo"$check_in_date";
    echo'<br>';
    echo"$check_out_date";
    echo'<br>';
    echo"$user_id";
    echo'<br>';
    echo"$num_p";
    echo "<br>";
    echo "$price";

$addbk = "CALL booking('$ac_id', '$check_in_date ', '$check_out_date', '$user_id', '$num_p', '$price')";
mysqli_query($connect,$addbk);
header('Location: myreserve.php');
?>