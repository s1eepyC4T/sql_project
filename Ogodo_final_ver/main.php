<!DOCTYPE html>
<html>


    <title>Ogodo</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
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

    button {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
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
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
    
</style>


<body>
    <header>
        <h1><a href="home_bf.php">Ogodo</a></h1>
    </header>
    <nav>
        <ul>
            <li><a href="hotel.php">Hotel</a></li>
            <li><a href="apat.php">Apartment</a></li>
            <li><a href="poolvilla.php">Poolvilla</a></li>
            <li><a href="house.php">House</a></li>
            <li><a href="login.php">LogIn</a></li>
        </ul>
    </nav>
    
    <form action="search.php" method="post">
            <input type="text" name="info" placeholder="Destination" required>
            <button type="submit" name="Enter">Search</button>
    </form>

</body>

</html>