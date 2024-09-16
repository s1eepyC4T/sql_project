<?php
session_start();
require_once("connect.php");
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ISBN from the form submission
    $isbn = $_POST['isbn'];

    // Check if the book with the given ISBN exists in the inventory
    $checkBookQuery = "SELECT * FROM stock WHERE isbn = '$isbn'";
    $checkBookResult = mysqli_query($connection, $checkBookQuery);

    if ($checkBookResult) {
        $book = mysqli_fetch_assoc($checkBookResult);

        if ($book) {
            // Book found in the inventory, add it to the transaction_detail table
            $transactionId = $_SESSION['transaction_id'];
            $insertTransactionDetailQuery = "INSERT INTO transaction_detail (transaction_id, isbn, amount) VALUES ('$transactionId', '$isbn', 1)";
            $insertResult = mysqli_query($connection, $insertTransactionDetailQuery);

            if ($insertResult) {
                // Redirect back to the transaction.php page
                header('Location: transaction.php');
                exit();
            } else {
                // Error in query execution
                echo "Error adding book to the cart: " . mysqli_error($connection);
                echo "<br>";
                echo "<a href='transaction.php'>Back</a>";
            }
        } else {
            // Book not found in the inventory
            echo "Book with ISBN '$isbn' not found in the inventory.";
            echo "<br>";
            echo "<a href='transaction.php'>Back</a>";
        }
    } else {
        // Error in query execution
        echo "Error checking book in the inventory: " . mysqli_error($connection);
        echo "<br>";
        echo "<a href='transaction.php'>Back</a>";
    }
}

// Close database connection
mysqli_close($connection);
?>
