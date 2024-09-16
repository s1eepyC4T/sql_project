<?php
require_once("connect.php");
require_once("main.php");

$info = $_POST['info'];
if (isset($_POST['Enter'])) {
            
            $searchTerm = mysqli_real_escape_string($connect, $_POST['info']);
            $searchQuery = "SELECT * FROM accommodatiom WHERE ac_name = '$searchTerm'|| address LIKE '%$searchTerm%';";
           
            
            $searchResult = mysqli_query($connect, $searchQuery);
            
            if ($searchResult && mysqli_num_rows($searchResult) > 0) {
                echo "Search Result : $info";
                echo '<table  border="1">';
                echo '<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Address</th>
                <th>Rating</th>
                <th>Booking</th>
                </tr>';
                while ($acc = mysqli_fetch_assoc($searchResult)) {
                    echo '<tr>';
                    echo '<td>' . $acc['ac_id'] . '</td>';
                    echo '<td>' . $acc['ac_name'] . '</td>';
                    echo '<td>' . $acc['ac_type'] . '</td>';
                    echo '<td>' . $acc['address'] . '</td>';               
                    echo '<td>' . $acc['rating'] . '</td>';
                    if (!isset($_POST['user_id'])) {
                    echo "<td><a href='login.php'>Booking</a></td>";
                }
                    else {
                        echo "<td><a href='booking_Form.php?id=".$row['ac_id']."'>Booking</a></td>";
                    }
                    
                    echo '</tr>';
                }
                echo '</table>';
            } else {

                echo "No matching Accomodation found.";
            }
        }
?>




