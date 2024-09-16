<?php
session_start();

// Include the database connection file
require_once('connect.php');

// Check if the form is submitted to complete the transaction
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete_transaction'])) {
    $transactionId = $_SESSION['transaction_id'];

    // Loop through the posted quantities and update the transaction_detail table
    foreach ($_POST['amount'] as $isbn => $amount) {
        // Validate and sanitize input
        $isbn = mysqli_real_escape_string($connection, $isbn);
        $amount = (int) $amount;

        // Update the amount in the transaction_detail table
        $updateAmountQuery = "UPDATE transaction_detail SET amount = $amount WHERE transaction_id = '$transactionId' AND isbn = '$isbn'";
        $updateResult = mysqli_query($connection, $updateAmountQuery);

        if (!$updateResult) {
            // Error in query execution
            echo "Error updating amount for ISBN '$isbn': " . mysqli_error($connection);
            echo "<br>";
            echo "<a href='transaction.php'>Back</a>";
            exit();
        }
    }

    // Calculate and update totalprice in the transaction table
    $transactionId = (int) $_SESSION['transaction_id'];
    // Total Price
    $calculateTotalPriceQuery = "SELECT cal_price($transactionId) AS 'cal_price';";
    $calculateTotalPriceResult = mysqli_query($connection, $calculateTotalPriceQuery);
    if (!$calculateTotalPriceResult) {
        echo "Error calculating total price: ". mysqli_error($connection);
        echo "<br>";
        echo "<a href='transaction.php'>Back</a>";
        exit();
    } else {
        $totalpriceResult = mysqli_fetch_assoc($calculateTotalPriceResult);
        $totalprice = $totalpriceResult['cal_price'];
        $_SESSION['totalprice'] = $totalprice;
    }
    //Discount
    if (isset($_SESSION['member_id'])) {
        $memberId = $_SESSION['member_id'];
        $calculateDiscountQuery = "SELECT cal_discount($memberId) AS 'cal_discount';";
        $calculateDiscountResult = mysqli_query($connection, $calculateDiscountQuery);
        if (!$calculateDiscountResult) {
            echo "Error calculating discount: ". mysqli_error($connection);
            echo "<br>";
            echo "<a href='transaction.php'>Back</a>";
            exit();
        } else {
            $discountResult = mysqli_fetch_assoc($calculateDiscountResult);
            $discount = $discountResult['cal_discount'];
            $discount = $discount*$totalprice;
            $totalprice = $totalprice - $discount;
            $_SESSION['discount'] = $discount;
        }
    }
    $updateTotalPriceQuery = "UPDATE transaction SET totalprice = '$totalprice' WHERE transaction_id = '$transactionId'";
    $updateTotalPriceResult = mysqli_query($connection, $updateTotalPriceQuery);
    // Update transaction time in transaction table
    $updateTransactionTimeQuery = "UPDATE transaction SET transaction_time = CURRENT_TIMESTAMP() WHERE transaction_id = '$transactionId'";
    $updateTransactionTimeResult = mysqli_query($connection, $updateTransactionTimeQuery);

    // Call update stock (Unused. Already in Trigger)
    /*
    $updateStockQuery = "CALL upd_stock('$transactionId')";
    $updateStockResult = mysqli_query($connection,$updateStockQuery);*/

    if (!$updateTotalPriceResult) {
        // Error in query execution
        echo "Error updating total price: " . mysqli_error($connection);
        echo "<br>";
        echo "<a href='transaction.php'>Back</a>";
        exit();
    }

    if (!$updateTransactionTimeResult) {
        // Error in query execution
        echo "Error updating transaction time: " . mysqli_error($connection);
        echo "<br>";
        echo "<a href='transaction.php'>Back</a>";
        exit();
    }
    /* (Unused. Already in Trigger)
    if (!$updateStockResult) { 
        // Error in query execution
        echo "Error updating stock: " . mysqli_error($connection);
        echo "<br>";
        echo "<a href='transaction.php'>Back</a>";
        exit();
    }*/

    // Update the point column in the member table
    if (isset($_SESSION['member_id'])) {
        $memberId = $_SESSION['member_id'];
        $updatePointQuery = "UPDATE member SET point = point + (SELECT totalprice FROM transaction WHERE transaction_id = '$transactionId') WHERE member_id = '$memberId'";
        $updatePointResult = mysqli_query($connection, $updatePointQuery);
        if (!$updatePointResult) {
            // Error in query execution
            echo "Error updating member points: " . mysqli_error($connection);
            echo "<br>";
            echo "<a href='transaction.php'>Back</a>";
            exit();
        }    
    }
    
    
    // Redirect to the transaction summary page
    header('Location: transaction_summary.php');
    exit();
    
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_transaction'])) {
        $transactionId = $_SESSION['transaction_id'];
        $cancelTransactionQuery = "DELETE FROM transaction WHERE transaction_id = '$transactionId'";
        $cancelTransactionResult = mysqli_query($connection, $cancelTransactionQuery);
        header('Location: scanMem.php');
    } else {
        // Invalid form submission
        echo "Invalid form submission.";
        echo "<br>";
        echo "<a href='transaction.php'>Back</a>";
    }

// Close database connection
mysqli_close($connection);
?>
