<?php
require_once("connect.php");
require_once("main.php");
// Check if the book ISBN is provided
if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    $transactionId = $_SESSION['transaction_id'];

    // Remove the book from the transaction_detail table
    $removeBookQuery = "DELETE FROM transaction_detail WHERE transaction_id = '$transactionId' AND isbn = '$isbn'";
    $result = mysqli_query($connection, $removeBookQuery);

    if ($result) {
        // Redirect back to the transaction.php page
        header('Location: transaction.php');
        exit();
    } else {
        // Error in query execution
        echo "Error removing book from the cart: " . mysqli_error($connection);
        echo "<br>";
            echo "<a href='transaction.php'>Back</a>";
    }
} else {
    // ISBN not provided
    echo "ISBN not provided.";
    echo "<br>";
    echo "<a href='transaction.php'>Back</a>";
}

// Close database connection
mysqli_close($connection);
?>
