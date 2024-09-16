<?php
    require_once("connect.php");
    require_once("user_main.php");

    $se = $_GET['id'];
    $m_id = $_SESSION['user_id'];
    
    $q = "DELETE FROM history_search WHERE time = '$se' AND m_id = $m_id;";
    $reuslt=mysqli_query($connect, $q);
    header('Location: history.php');
?>