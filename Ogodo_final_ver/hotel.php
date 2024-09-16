<?php
        require_once("main.php");
        require_once("connect.php");
        echo"List of Hotel";
        $q = "SELECT ac_id,ac_name, ac_type, address, rating FROM accommodatiom WHERE ac_type='Hotel' ORDER BY rating DESC;";
        
        if($result= $connect->query($q)){
           echo'<table border="1">';
           echo'<tr>
           <th>id</th>
           <th>name</th>
           <th>type</th>
           <th>address</th>
           <th>rating</th>
           <th>booking</th>
           </tr>';
           
           while($row= $result->fetch_array()){
               echo"<tr>";
               echo "<td>".$row["ac_id"]."</td>";
               echo "<td>".$row["ac_name"]."</td>";
               echo "<td>".$row["ac_type"]."</td>";
               echo "<td>".$row["address"]."</td>";
               echo "<td>".$row["rating"]."</td>";
           
               echo "<td><a href='login.php'>Booking</a></td>";
               echo"</tr>";
           }
           echo '</table>';
           $result->free();
           }else{
               echo"Retrieval failed: ".$connect->error;
           }
           ?>
        



