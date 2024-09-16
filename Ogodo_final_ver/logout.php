<?php
session_start();
session_destroy();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

header('Location: home_bf.php');
exit();
?>