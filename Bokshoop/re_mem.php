<?php
require_once("connect.php");
require_once("main.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Member</title>
</head>
<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h2 {
    color: #333;
    text-align: center;
}

hr {
    border: 1px solid #ddd;
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
    margin-bottom: 8px;
    color: #333;
}

input {
    width: 100%;
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
}

button:hover {
    background-color: lightseagreen;
}

/* Add more styles based on your specific requirements */
</style>
<body>
    
        <h2>Register new member</h2>
        <hr>

        <form action="re_mem_process.php" method="post">
            <label for="member_name">Name:</label>
            <input type="text" id="member_name" name="member_name"><br><br>

            <label for="dob">Date of birth:</label>
            <input type="date" id="dob" name="dob"><br><br>

            <label for="tel_no">Phone number:</label>
            <input type="tel" id="tel_no" name="tel_no"><br><br>

            <button type="submit">Register</button>
        </form>


</body>
</html>
