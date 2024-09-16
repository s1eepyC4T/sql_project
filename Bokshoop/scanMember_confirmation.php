<?php
require_once("connect.php");
require_once("main.php");
?>


<!DOCTYPE html>
<html>
<head>
    <title>confirm member</title>
</head>
<body>
</body>
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

            // Create a new entry in the transaction table with this member ID
            echo '<form action="scanMember_confirmation_process.php" method="post">';
                echo '<input type="hidden" name="member_id" value="' . $memberId . '">';
                echo '<button type="submit" name="confirm_transaction">Confirm</button>';
            echo '</form>';
        } else {
            // Member not found
            echo "Member not found.";
            echo "<br>";
            echo "<a href='scanMem.php'>Back</a>";
        }
    } else {
        // Error in query execution
        echo "Error: " . mysqli_error($connection);
        echo "<br>";
        echo "<a href='scanMem.php'>Back</a>";
    }
} else {
    // Member ID not found in session
    echo "Member ID not found.";
    echo "<br>";
    echo "<a href='scanMem.php'>Back</a>";
}

?>


</html>