<?php
require_once("connect.php");
require_once("main.php");

$historyQuery = "SELECT * FROM transaction ORDER BY transaction_time DESC";
$historyResult = mysqli_query($connection, $historyQuery);

if ($historyResult && mysqli_num_rows($historyResult) > 0) {

    echo '<table>';
    echo '<tr><th>Transaction ID</th><th>Staff ID</th><th>Member ID</th><th>Total price</th><th>Date</th><th>Details</th></tr>';
    while ($row = mysqli_fetch_assoc($historyResult)) {
        if ($row['member_id'] == null){
            $member = "None";
        }
        else {
            $member = $row['member_id'];
        }
        echo '<tr>';
        echo '<td>' . $row['transaction_id'] . '</td>';
        echo '<td>' . $row['staff_id'] . '</td>';
        echo '<td>' . $member . '</td>';
        echo '<td>' . $row['totalprice'] . '฿</td>';
        echo '<td>' . $row['transaction_time'] . '</td>';
        echo '<td><a href="transaction_detail.php?transaction_id=' . $row['transaction_id'] . '">View</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {

    echo "No transaction history available.";
}


mysqli_close($connection);
?>