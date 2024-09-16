<?php
require_once("connect.php");
require_once("main.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Member</title>
</head>
<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f8f8;
    margin: 0;
    padding: 0;
    text-align: center;
}

h2 {
    color: #333;
}

form {
    max-width: 400px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
    color: #333;
}

input {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: lightskyblue;
    color: #fff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 4px;
}

button:hover {
    background-color: lightseagreen;
}

p {
    color: #4CAF50;
}

</style>
<body>

        <h2>Edit Member Detail</h2>

        <form action="" method="post">
            <label for="member_id">Member ID:</label>
            <input type="text" id="member_id" name="member_id" required><br><br>

            <button type="submit" name="submit">Search</button>
        </form>
        <br>


        <?php
        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Get the member ID from the form
            $memberId = mysqli_real_escape_string($connection, $_POST['member_id']);

            // Query to retrieve member information based on the provided ID
            $selectQuery = "SELECT * FROM member WHERE member_id = '$memberId'";
            $selectResult = mysqli_query($connection, $selectQuery);

            if ($selectResult && mysqli_num_rows($selectResult) > 0) {
                // Display the member information in an editable form
                $member = mysqli_fetch_assoc($selectResult);
                ?>  
                <form action="" method="post">
                    <input type="hidden" name="member_id" value="<?php echo $member['member_id']; ?>">
                    
                    <label for="member_name">Name:</label>
                    <input type="text" id="member_name" name="member_name" value="<?php echo $member['member_name']; ?>"><br><br>
                    
                    <label for="dob">Date of birth:</label>
                    <input type="date" id="dob" name="dob" value="<?php echo $member['dob']; ?>"><br><br>
                    
                    <label for="tel_no">Phone number:</label>
                    <input type="tel" id="tel_no" name="tel_no" value="<?php echo $member['tel_no']; ?>"><br><br>

                    <button type="submit" name="update">Update</button>
                </form>
                <?php
            } else {
                // Member not found
                echo "Member not found.";
            }
        }

        // Check if the update form is submitted
        if (isset($_POST['update'])) {
            // Get updated member information from the form
            $memberId = mysqli_real_escape_string($connection, $_POST['member_id']);
            $memberName = mysqli_real_escape_string($connection, $_POST['member_name']);
            $dob = mysqli_real_escape_string($connection, $_POST['dob']);
            $telNo = mysqli_real_escape_string($connection, $_POST['tel_no']);

            // Update member information in the member table
            $updateQuery = "UPDATE member 
                            SET member_name = '$memberName', dob = '$dob', tel_no = '$telNo' 
                            WHERE member_id = '$memberId'";
            $updateResult = mysqli_query($connection, $updateQuery);

            if ($updateResult) {
                echo "<p>Member information updated successfully!</p>";
            } else {
                echo "Error updating member information: " . mysqli_error($connection);
            }
        }
        ?>

</body>
</html>
