<?php
require_once("connect.php");
require_once("user_main.php");
$a = $_GET['id'];
$b = $_SESSION['user_id'];
echo"$a";
echo"<br>";
echo "$b";
$q = "DELETE FROM favorite WHERE ac_id = $a AND m_id = $b;";
$reuslt=mysqli_query($connect, $q);
header('Location: fav_page.php');
?>  