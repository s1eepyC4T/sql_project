<?php
require_once("connect.php");
require_once("main.php");
// Check if the user is logged in
?>

<!DOCTYPE html>
<html>
<head>
   <title>Add to Cart</title>
</head>
<body>
    <h2>Add to cart</h2>
    <hr>

    <form action="add_to_cart_process.php" method="post">
        <label for="isbn">Enter ISBN:</label>
        <input type="text" id="isbn" name="isbn" required>
        <button type="submit">Add</button>
    </form>

    <br>
    <a href="transaction.php">Back</a>


</body>
</html>
