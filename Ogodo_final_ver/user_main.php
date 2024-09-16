<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Ogodo</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #007bff;
        color: #fff;
        text-align: center;
        padding: 10px;
    }

    h1 a {
        text-decoration: none;
        color: #fff;
    }

    nav {
        background-color: white;
        overflow: hidden;
    }

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: space-around;
    }

    li {
        display: inline;
    }

    nav a {
        text-decoration: none;
        color: #007bff;
        padding: 14px 16px;
        display: block;
    }

    nav a:hover {
        background-color: whitesmoke;
    }

    form {
        text-align: center;
        margin: 20px 0;
    }

    input[type="text"] {
        padding: 10px;
        font-size: 16px;
    }


    p {
        text-align: center;
        margin-top: 20px;
    }

    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: white;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>
</head>

<body>
    <header>
        <h1><a href="user_home.php">Ogodo</a></h1>
    </header>
    <nav>
        <ul>
            <li><a href="user_hotel.php">Hotel</a></li>
            <li><a href="user_apat.php">Apartment</a></li>
            <li><a href="user_poolvilla.php">Poolvilla</a></li>
            <li><a href="user_house.php">House</a></li>
            <li><a href="fav_page.php">Favorite</a></li>
            <li><a href="myreserve.php">MyReservation</a></li>
            <li><a href="history.php">History Search</a></li>
            <li><a href="editmem.php">Edit Account</a></li>
            <li><a href="logout.php">LogOut</a></li>
        </ul>
    </nav>
    
    <form action="user_search.php" method="post">
            <input type="text" name="info" placeholder="Destination" required>
            <button type="submit" name="Enter">Search</button>
    </form>

</body>

</html>