<?php
require_once("connect.php");
require_once("user_main.php");
        // Check if the form is submitted
            // Get the member ID from the form
            $memberId = $_SESSION['user_id'];

            // Query to retrieve member information based on the provided ID
            //$selectQuery = "SELECT * FROM member WHERE m_id = '$memberId'";
           // $selectResult = mysqli_query($connect, $selectQuery);

        
                // Display the member information in an editable form
           // $member = mysqli_fetch_assoc($selectResult);
               

         
         // Check if the update form is submitted
         if (isset($_POST['update'])) {
             // Get updated member information from the form
             //$memberId = mysqli_real_escape_string($connect, $_SESSSION['user_id']);
             $memberName =  $_POST['m_name'];
             $email = $_POST['email'];
             $telNo = $_POST['tel_no'];
             $usname = $_POST['username'];
 
             // Update member information in the member table
             $updateQuery = "UPDATE member 
                             SET m_name = '$memberName', m_tel = '$telNo', email= '$email' , username = '$usname'
                             WHERE m_id = $memberId;";
            echo"  $updateQuery";
             $updateResult = mysqli_query($connect, $updateQuery);
 
             if ($updateResult) {
                echo "<br>";
                 echo "<p>Member information updated successfully!</p>";
             } else {
                echo "<br>";
                 echo "Error updating member information: " . mysqli_error($connect);
             }
         }
         
         header('Location: editmem.php');
         ?>