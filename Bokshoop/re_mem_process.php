<?php
session_start();
require_once("connect.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $memberName = mysqli_real_escape_string($connection, $_POST['member_name']);
    $dob = mysqli_real_escape_string($connection, $_POST['dob']);
    $telNo = mysqli_real_escape_string($connection, $_POST['tel_no']);

    // Insert new member into the member table
    $insertQuery = "INSERT INTO member (member_name, dob, tel_no) 
                    VALUES ('$memberName', '$dob', '$telNo')";
    $insertResult = mysqli_query($connection, $insertQuery);

    if ($insertResult) {
        // Member registered successfully
        $newMemberId = mysqli_insert_id($connection);
        echo "Member registered successfully. The member ID is: $newMemberId";
        echo "<br>";
        echo "<a href='re_mem.php'>Back</a>";
        header('Location: scanMem.php');
        exit();
    } else {
        // Error registering member
        echo "Error: " . mysqli_error($connection);
        echo "<br>";
        echo "<a href='re_mem.php'>Back</a>";
    }
}

// Close database connection
mysqli_close($connection);
?>
