<?php
require_once("connect.php");
require_once("user_main.php");

if (isset($_POST["info"])) {
    $_SESSION['info'] = $_POST['info'];}
    

$info = $_SESSION['info'];
$user_id = $_SESSION['user_id'];
if (isset($_POST['Enter'])) {
            
            $searchTerm = mysqli_real_escape_string($connect, $_POST['info']);
            $a=$_POST['info'];
            $searchQuery = "SELECT * FROM accommodatiom WHERE ac_name = '$searchTerm'|| address LIKE '%$searchTerm%';";
            
            $searchResult = mysqli_query($connect, $searchQuery);
            $hi = "CALL history('$user_id', '$info')";
            mysqli_query($connect,$hi);
            
                
            if ($searchResult && mysqli_num_rows($searchResult) > 0) {
                echo "Search Result : $a";
                echo '<table  border="1">';
                echo '<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Address</th>
                <th>Rating</th>
                <th>Price per person</th>
                <th>Booking</th>
                <th>Favorite</th>
                </tr>';
                while ($acc = mysqli_fetch_assoc($searchResult)) {
                    echo '<tr>';
                    echo '<td>' . $acc['ac_id'] . '</td>';
                    echo '<td>' . $acc['ac_name'] . '</td>';
                    echo '<td>' . $acc['ac_type'] . '</td>';
                    echo '<td>' . $acc['address'] . '</td>';               
                    echo '<td>' . $acc['rating'] . '</td>';
                    echo '<td>' . $acc['price'] . '</td>';
                    echo "<td><a href='booking.php?id=".$acc['ac_id']."'>Booking</a></td>";
                    echo "<td><a href='user_fav.php?id=".$acc['ac_id']."'>Favorites</a></td>";
                    
                    echo '</tr>';
                }
                echo '</table>';
            } else {

                echo "No matching Accomodation found.";
            }
        }
        else{
            $searchTerm = mysqli_real_escape_string($connect,$_SESSION['info']);
            $searchQuery = "SELECT * FROM accommodatiom WHERE ac_name = '$searchTerm'|| address LIKE '%$searchTerm%';";
            $a=$_SESSION['info'];
            $searchResult = mysqli_query($connect, $searchQuery);
            
            if ($searchResult && mysqli_num_rows($searchResult) > 0) {
                echo "Search Result : $a";
                echo '<table  border="1">';
                echo '<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Address</th>
                <th>Rating</th>
                <th>Booking</th>
                <th>Favorite</th>
                </tr>';
                while ($acc = mysqli_fetch_assoc($searchResult)) {
                    echo '<tr>';
                    echo '<td>' . $acc['ac_id'] . '</td>';
                    echo '<td>' . $acc['ac_name'] . '</td>';
                    echo '<td>' . $acc['ac_type'] . '</td>';
                    echo '<td>' . $acc['address'] . '</td>';               
                    echo '<td>' . $acc['rating'] . '</td>';   
                    echo "<td><a href='booking.php?id=".$acc['ac_id']."'>Booking</a></td>";
                    echo "<td><a href='fav_search.php?id=".$acc['ac_id']."'>Favorites</a></td>";
                    echo '</tr>';
                }
                echo '</table>';
            } else {

                echo "No matching Accomodation found.";
            }
        }
?>




