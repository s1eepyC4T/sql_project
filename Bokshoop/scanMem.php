<?php
require_once("connect.php");
require_once("main.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>scanMem</title>
</head>
<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f8f8;
    margin: 0;
    padding: 0;
    text-align: center;
}


form {
    max-width: 400px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
    color: #333;
}

input {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: lightskyblue;
    color: #fff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 4px;
    margin-right: 10px;
}

button:hover {
    background-color: lightseagreen;
}

</style>
<body>
    <h1>Check Member</h1>
    <form action="scanMem_process.php" method="post">
            <label for="member_info">Enter member ID or Tel. No.:</label>
            <input type="text" id="member_info" name="member_info"><br>

            <button type="submit" name="confirm">Confirm</button>
            <button type="submit" name="skip">Skip</button>
        </form>
</body>
</html>