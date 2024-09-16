<?php
$connect = new mysqli("localhost", "root", "root", "ogodo");
if(mysqli_connect_errno()) {
    echo $connect->connect_error.":".$connect->connect_error;
}
?>
