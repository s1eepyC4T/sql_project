<?php
require_once("connect.php");
require_once("main.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        // User clicked on "Confirm"
        $memberInfo = $_POST['member_info'];

        // Check if the member ID exists in the database
        $query = "SELECT * FROM member WHERE member_id = $memberInfo OR tel_no = '$memberInfo'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $member = mysqli_fetch_assoc($result);

            if ($member) {
                // Member found, store member information in session
                $_SESSION['member_id'] = $member['member_id'];
                $_SESSION['member_name'] = $member['member_name'];

                // Redirect to member confirmation page
                header('Location: scanMember_confirmation.php');
            } else {
                // Member not found
                echo "Member not found. Please enter a valid member ID. or Tel No.";
                echo "<br>";
                echo "<a href='scanMem.php'>Back</a>";
            }
        } else {
            // Error in query execution
            echo "Error: " . mysqli_error($connection);
            echo "<br>";
            echo "<a href='scanMem.php'>Back</a>";
        }
    } elseif (isset($_POST['skip'])) {
        // User clicked on "Skip"
        // Create a new blank entry in the transaction table
        $staffId = $_SESSION['staff_id'];
        unset($_SESSION['member_id']);
        unset($_SESSION['member_name']);
        $query = "INSERT INTO transaction (staff_id) VALUES ('$staffId')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Get the ID of the newly inserted transaction
            $transactionId = mysqli_insert_id($connection);

            // Store transaction information in session
            $_SESSION['transaction_id'] = $transactionId;

            // Redirect to the transaction page
            header('Location: transaction.php');
        } else {
            // Error in query execution
            echo "Error: " . mysqli_error($connection);
            echo "<br>";
            echo "<a href='scanMem.php'>Back</a>";
        }
    }
}

// Close database connection
mysqli_close($connection);
?>
