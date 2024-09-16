<?php
$connection = new mysqli("localhost", "root", "root", "bopshook");
if(mysqli_connect_errno()) {
    echo $connection->connect_error.":".$connection->connect_error;
}
?>