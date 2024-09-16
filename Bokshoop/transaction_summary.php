<?php
require_once("main.php");
require_once("connect.php");

// Check if the user is logged in
if (!isset($_SESSION['staff_id'])) {
    header('Location: login.html');
    exit();
}
?>

        <h2>Transaction summary</h2>
        <hr>

        <?php

        // Get the transaction ID from the session
        $transactionId = $_SESSION['transaction_id'];

        // Retrieve transaction details from the transaction table
        $transactionQuery = "SELECT * FROM transaction WHERE transaction_id = '$transactionId'";
        $transactionResult = mysqli_query($connection, $transactionQuery);

        if ($transactionResult && mysqli_num_rows($transactionResult) > 0) {
            $transaction = mysqli_fetch_assoc($transactionResult);
            if ($transaction['member_id'] == null){
                $tranMem = "None";
            }
            else {
                $tranMem = $transaction['member_id'];
            }

            // Display transaction details
            echo "<p>Transaction ID: {$transaction['transaction_id']}</p>";
            echo "<p>Date: {$transaction['transaction_time']}</p>";
            echo "<p>Staff ID: {$transaction['staff_id']}</p>";
            echo "<p>Member ID: {$tranMem}</p>";

            // Retrieve member details
            $memberId = $transaction['member_id'];
            $memberQuery = "SELECT * FROM member WHERE member_id = '$memberId'";
            $memberResult = mysqli_query($connection, $memberQuery);

            if ($memberResult && mysqli_num_rows($memberResult) > 0) {
                $member = mysqli_fetch_assoc($memberResult);
                // Display member details
                echo "<p>Member name: {$member['member_name']}</p>";
                echo "<p>Current points: {$member['point']}</p>";
            } else {
                // Member details not found
                echo "Member details not found.";
            }

            echo "<p>Total price: {$_SESSION['totalprice']}฿</p>";
            echo "<p>Discount: {$_SESSION['discount']}฿</p>";
            echo "<p>Net Total price: {$transaction['totalprice']}฿</p>";

            // Retrieve and display the list of books purchased in this transaction
            $transactionDetailQuery = "SELECT td.amount, s.book_title, s.author, s.category, s.isbn, s.price
                                    FROM transaction_detail td
                                    INNER JOIN stock s ON td.isbn = s.isbn
                                    WHERE td.transaction_id = '$transactionId'";
            $transactionDetailResult = mysqli_query($connection, $transactionDetailQuery);

            if ($transactionDetailResult && mysqli_num_rows($transactionDetailResult) > 0) {
                // Display the list of books
                echo '<h3>Books purchased:</h3>';
                echo '<ul style="display: flex; flex-direction: column;">';
                while ($book = mysqli_fetch_assoc($transactionDetailResult)) {
                    echo '<li style = "margin: 5px;">';
                    echo "{$book['book_title']} by {$book['author']}, ISBN: {$book['isbn']}, Price: {$book['price']}฿, Amount: {$book['amount']}";
                    echo '</li>';
                }
                echo '</ul>';
            } else {
                // No books in the transaction yet
                echo "No books purchased in this transaction yet.";
            }

            // Clear the session variables related to the transaction
            unset($_SESSION['transaction_id']);
            unset($_SESSION['member_id']);
            unset($_SESSION['discount']);
            unset($_SESSION['totalprice']);
        } else {
            // No transaction details found
            echo "Transaction details not found.";
            echo "<br>";
            echo "<a href='scanMem.php'>Back</a>";
        }

        // Close database connection
        mysqli_close($connection);
        ?>
