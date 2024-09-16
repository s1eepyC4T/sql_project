<?php
session_start();
//์์Navigation Bar 
if (!isset($_SESSION['staff_id'])) {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bopshook</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: lightskyblue;
            color:white;
            text-align: center;
            padding: 20px 0;
        }

        h1 {
            margin: 0;
            font-size: 32px;
        }

        nav {
            padding: 10px;
            background-color: white;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        li {
            margin: 0 10px;
        }

        a {
            text-decoration: none;
            color: lightseagreen;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #4caf50;
        }
    </style>
</head>

<body>
    <header>
        <h1>BopShook</h1>
    </header>
    <nav>
        <ul>
            <li><a href="scanMem.php">Scan</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="re_mem.php">Register Member</a></li>
            <li><a href="ed_mem.php">Edit Member</a></li>
            <li><a href="history.php">Transaction History</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        
    </nav>
</body>

</html>
