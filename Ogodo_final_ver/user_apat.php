<?php
        require_once("user_main.php");
        require_once("connect.php");
        echo"List of Apartment";

        
        $q = "SELECT * FROM accommodatiom WHERE ac_type='Apartment' ORDER BY rating DESC;";
        
        if($result= $connect->query($q)){
           echo'<table border="1">';
           echo'<tr>
           <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Address</th>
                <th>Rating</th>
                <th>Price per person</th>
                <th>Booking</th>
                <th>Favorite</th>
                </tr>';
           
           while($row= $result->fetch_array()){
               echo"<tr>";
               echo "<td>".$row["ac_id"]."</td>";
               echo "<td>".$row["ac_name"]."</td>";
               echo "<td>".$row["ac_type"]."</td>";
               echo "<td>".$row["address"]."</td>";
               echo "<td>".$row["rating"]."</td>";
            echo "<td>".$row["price"]."</td>";
               echo "<td><a href='booking.php?id=".$row['ac_id']."'>Booking</a></td>";
               echo "<td><a href='fav_apt.php?id=".$row['ac_id']."'>Favorites</a></td>";
               echo"</tr>";
           }
           echo '</table>';
           $result->free();
           }else{
               echo"Retrieval failed: ".$connect->error;
           }
 ?>



