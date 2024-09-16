<?php
require_once("connect.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$ac_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$addfav = "CALL add_to_fav('$user_id', '$ac_id')";
mysqli_query($connect,$addfav);
header('Location: user_poolvilla.php');
?>