<?php
require_once("connect.php");
require_once("user_main.php");
        
        echo"History of searching";
        echo"<br>";
        echo"<br>";
        $a = $_SESSION['user_id'];
        
        $Query = "SELECT * FROM history_search WHERE m_id = $a;";
        $result = mysqli_query($connect, $Query);

        if (mysqli_num_rows($result) == 0) {
            echo"You haven't search anything";
        }else{
            echo '<table  border="1">'; 
                echo '<tr>
                <th>Search History</th>
                <th>Date & time</th>
                <th>Remove</th>
                </tr>';
                while ($acc = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $acc['search_detail'] . '</td>';
                    echo '<td>' . $acc['time'] . '</td>'; 
                    echo "<td><a href='remove.php?id=".$acc['time']."'>remove</a></td>";     
                      
                    echo '</tr>';
                }
                echo '</table>';
        }
        ?>  



