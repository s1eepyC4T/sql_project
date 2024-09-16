<?php
require_once("connect.php");
require_once("main.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transaction - Bookshop Management System</title>
</head>
<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f8f8;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 20px auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}



form {
    margin-top: 20px;
}

button {
    background-color: lightskyblue;
    color: #fff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    margin-right: 10px;
}



button:hover, a:hover {
    background-color: lightseagreen;
}

p {
    margin-top: 10px;
}

</style>
<body>
    <?php
if (isset($_SESSION['member_id'])) {
            $memberId = $_SESSION['member_id'];

            // Retrieve member information from the database
            $query = "SELECT * FROM member WHERE member_id = '$memberId'";
            $result = mysqli_query($connection, $query);

            if ($result) {
                $member = mysqli_fetch_assoc($result);

                if ($member) {
                    // Display member information
                    echo "<p>Member ID: {$member['member_id']}</p>";
                    echo "<p>Name: {$member['member_name']}</p>";
                    echo "<p>Points: {$member['point']}</p>";
                } else {
                    // Member not found
                    echo "Member not found.";
                }
            } else {
                // Error in query execution
                echo "Error: " . mysqli_error($connection);
            }
        }

        // Retrieve transaction details from transaction_detail table
        if (isset($_SESSION['transaction_id'])) {
            $transactionId = $_SESSION['transaction_id'];

            $query = "SELECT td.isbn, td.amount, s.book_title, s.author, s.category, s.price
                    FROM transaction_detail td
                    INNER JOIN stock s ON td.isbn = s.isbn
                    WHERE td.transaction_id = '$transactionId'";
            $result = mysqli_query($connection, $query);

            if ($result && mysqli_num_rows($result) > 0) {
            echo '<form action="complete_transaction.php" method="post">';
                echo '<table>';
                echo '<tr><th>Title</th><th>Author</th><th>Category</th><th>ISBN</th><th>Price</th><th>Amount</th><th>Remove</th></tr>';
                    
                    // Display transaction details in a table with input fields for quantity adjustment
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['book_title'] . '</td>';
                    echo '<td>' . $row['author'] . '</td>';
                    echo '<td>' . $row['category'] . '</td>';
                    echo '<td>' . $row['isbn'] . '</td>';
                    echo '<td>' . $row['price'] . '฿</td>';
                    echo '<td><input type="number" min="1" name="amount[' . $row['isbn'] . ']" value="' . $row['amount'] . '"></td>';
                    echo '<td><a href="remove_from_cart.php?isbn=' . $row['isbn'] . '">Remove</a></td>';
                    echo '</tr>';
                    }
                    
                echo '</table>';

                echo '<br>';

                // Button for adding more books to the transaction (directs to add_to_cart.php)
                echo '<a href="add_to_cart.php"><button type="button">Add</button></a>';

                echo ' ';

                // Button for completing the transaction
                echo '<button type="submit" name="complete_transaction">Proceed to checkout</button>';

                echo ' ';

                // Button for cancelling the transaction
                echo '<button type="submit" name="cancel_transaction">Cancel</button>';
            echo '</form>';
                
            } else {
                // No books in the transaction yet
                echo "No books added to cart yet.";
                echo '<form action="complete_transaction.php" method="post">';
                    echo '<a href="add_to_cart.php"><button type="button">Add</button></a>';
                    echo ' ';
                    echo '<button type="submit" name="cancel_transaction">Cancel</button>';
                echo '</form>';
            }
        }

        // Close database connection
        mysqli_close($connection);
        ?>
</body>
</html>