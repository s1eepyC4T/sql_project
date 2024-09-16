<?php
require_once("user_main.php");
require_once("connect.php");
echo"My reservation";
$m_id = $_SESSION['user_id'];
        $q = "SELECT b.b_id, a.ac_name, a.ac_type, a.address, b.check_in_date, b.check_out_date, b.num_p, b.r_price FROM booking b JOIN accommodatiom a ON b.ac_id = a.ac_id  WHERE b.m_id = $m_id ;";
        $result= $connect->query($q);
        if (mysqli_num_rows($result) == 0) {
            echo"You haven't book anything accommodation";
        }
        else{
        
           echo'<table border="1">';
           echo'<tr>
           <th>User</th>
           <th>Name</th>
           <th>Type</th>
           <th>Address</th>
           <th>Check in date</th>
           <th>Check out date</th>
           <th>Number of People</th>
           <th>Total Price</th>s
           </tr>';
           
           while($row= $result->fetch_array()){
               echo"<tr>";
               //echo "<td>".$row["b_id"]."</td>";
               echo "<td>".$_SESSION['name']."</td>";
               echo "<td>".$row["ac_name"]."</td>";
               echo "<td>".$row["ac_type"]."</td>";
               echo "<td>".$row["address"]."</td>";
               echo "<td>".$row["check_in_date"]."</td>";
               echo "<td>".$row["check_out_date"]."</td>";
               echo "<td>".$row["num_p"]."</td>";
               echo "<td>".($row["r_price"])."</td>";
               echo"</tr>";
           }
           echo '</table>';
           $result->free();
           }
           
?>