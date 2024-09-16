<?php
        require_once("user_main.php");
        require_once("connect.php");

$_SESSION['ac_id'] = $_GET['id'];
$a =$_SESSION['ac_id'];
$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html>

<head>
    <title>Booking</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    h1 {
        color: #333;
    }

    form {
        width: 300px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: center;
    }

    label {
        display: block;
        margin: 10px 0;
        color: #333;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    p {
        margin-top: 20px;
    }
</style>
</head>

<body>
    <h1>Booking</h1>
    <form action="booking_process.php" method="post">

        

        <label for="check_in_date">Check-in Date:</label>
        <input type="date" name="check_in_date" required><br>

        <label for="check_out_date">Check-out Date:</label>
        <input type="date" name="check_out_date" required><br>

        <label for="num_people">Number of People:</label>
        <input type="number" name="num_p" min="1" required><br>

        <input type="submit" value="Confirm">
        <p></p>
    </form>
</body>

</html>