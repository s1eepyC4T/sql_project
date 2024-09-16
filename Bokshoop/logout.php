<?php
session_start();
session_destroy();

if (!isset($_SESSION['staff_id'])) {
    header('Location: login.html');
    exit();
}

header('Location: login.html');
exit();
?>