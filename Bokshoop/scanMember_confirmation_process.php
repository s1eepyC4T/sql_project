<?php
    require_once("connect.php");
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_transaction'])) {
        // Get member ID from the form submission
        $memberId = $_POST['member_id'];
    
        // Create a new entry in the transaction table
        $staffId = $_SESSION['staff_id'];
    
        $insertTransactionQuery = "INSERT INTO transaction (staff_id, member_id) VALUES ('$staffId', '$memberId')";
        $result = mysqli_query($connection, $insertTransactionQuery);
    
        if ($result) {
            // Get the ID of the newly inserted transaction
            $transactionId = mysqli_insert_id($connection);
    
            // Store transaction information in session
            $_SESSION['transaction_id'] = $transactionId;
    
            // Redirect to the transaction page
            header('Location: transaction.php');
            exit();
        } else {
            // Error in query execution
            echo "Error creating transaction: " . mysqli_error($connection);
            echo "<br>";
            echo "<a href='scanMem.php'>Back</a>";
        }
    } else {
        // Invalid form submission
        echo "Invalid form submission.";
        echo "<br>";
        echo "<a href='scanMem.php'>Back</a>";
    }
    
    
    
?>