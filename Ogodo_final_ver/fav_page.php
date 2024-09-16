<?php
require_once("connect.php");
require_once("user_main.php");
$user_id = $_SESSION['user_id'];
echo"Your Favorite Accommodation";
$q = " SELECT f.ac_id, a.ac_name, a.ac_type, a.address, a.rating, a.price FROM favorite f JOIN accommodatiom a ON f.ac_id = a.ac_id WHERE m_id ='$user_id' ;";

$result = mysqli_query($connect, $q);
if ($result && mysqli_num_rows($result) > 0) {
echo '<table  border="1">';
echo '<tr>
                <th>Name</th>
                <th>Type</th>
                <th>Address</th>
                <th>Rating</th>
                <th>Price</th>
                <th>Unfavorite</th>
                </tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['ac_name'] . '</td>';
                    echo '<td>' . $row['ac_type'] . '</td>';
                    echo '<td>' . $row['address'] . '</td>';               
                    echo '<td>' . $row['rating'] . '</td>';  
                    echo '<td>' . $row['price'] . '</td>';  
                    echo "<td><a href='unFav.php?id=".$row['ac_id']."'>Unfavorite</a></td>";              
                    echo '</tr>';
                }
                echo '</table>';
} else {
    echo ": you didn't have any favorite accommodation.";
            }
?>
