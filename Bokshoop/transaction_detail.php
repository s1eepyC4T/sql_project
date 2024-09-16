<?php
require_once("connect.php");
require_once("main.php");
?>


        <h2>Transaction details</h2>
        <hr>

        <?php
        // Include the database connection file

        // Check if 'transaction_id' is set in the URL parameters
        if (isset($_GET['transaction_id'])) {
            // Get the transaction ID from the URL
            $transactionId = $_GET['transaction_id'];

            // Retrieve transaction details from the transaction_detail table
            $transactionDetailQuery = "SELECT td.amount, s.book_title, s.author, s.category, s.isbn, s.price
                                    FROM transaction_detail td
                                    INNER JOIN stock s ON td.isbn = s.isbn
                                    WHERE td.transaction_id = '$transactionId'";
            $transactionDetailResult = mysqli_query($connection, $transactionDetailQuery);

            // Retrieve additional details from the transaction table
            $transactionQuery = "SELECT t.*, m.member_name
                                FROM transaction t
                                LEFT JOIN member m ON t.member_id = m.member_id
                                WHERE t.transaction_id = '$transactionId'";
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
                if ($tranMem!="None"){
                    echo "<p>Name: {$transaction['member_name']}</p>";
                }
                echo "<p>Total price: {$transaction['totalprice']}฿</p>";

                // Display the list of books purchased in this transaction
                if ($transactionDetailResult && mysqli_num_rows($transactionDetailResult) > 0) {
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
            } else {
                // Transaction details not found
                echo "Transaction details not found.";
            }
        } else {
            // 'transaction_id' not set in the URL
            echo "Transaction ID not provided.";
        }

        // Close database connection
        mysqli_close($connection);
        ?>

</body>
