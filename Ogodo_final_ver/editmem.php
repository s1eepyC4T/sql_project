<?php
require_once("connect.php");
require_once("user_main.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Member</title>
</head>
<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f8f8;
    margin: 0;
    padding: 0;
    text-align: center;
}

h2 {
    color: #333;
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
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 4px;
}

button:hover {
    background-color: blue;
}

p {
    color: #4CAF50;
}

</style>
<body>

        <h2>Edit Member Detail</h2>


       
                <form action="edit_process.php" method="post">
                    <input type="hidden" name="m_id" value="<?php echo $member['m_id']; ?>">
                    
                    <label for="m_name">Name:</label>
                    <input type="text" id="m_name" name="m_name" value="<?php echo $member['m_name']; ?>"><br><br>

                    <label for="username">Userame:</label>
                    <input type="text" id="username" name="username" value="<?php echo $member['username']; ?>"><br><br>
            
                    <label for="tel_no">Phone number:</label>
                    <input type="tel"  name="tel_no" value="<?php echo $member['tel_no']; ?>"><br><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $member['email']; ?>"><br><br>
                    

                    <button type="submit" name="update">Update</button>
                </form>
                

</body>
</html>

