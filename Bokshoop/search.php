<?php
require_once("connect.php");
require_once("main.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Books</title>
    <style>


        .user-info {
            display: inline-block;
        }

        .content {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            vertical-align: center;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        hr {
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: lightskyblue;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: lightseagreen;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: #fff;
        }
    </style>
</head>
<body>


    <div class="content">
        <h2>Search books</h2>
        <hr>

        <form action="" method="post">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Search by title, author, category, ISBN" required>
            <button type="submit" name="submit">Search</button>
        </form>

        <?php

        if (isset($_POST['submit'])) {

            $searchTerm = mysqli_real_escape_string($connection, $_POST['search']);
            $searchQuery = "SELECT * FROM stock
                            WHERE isbn = '$searchTerm' 
                            OR book_title LIKE '%$searchTerm%' 
                            OR author LIKE '%$searchTerm%' 
                            OR category LIKE '%$searchTerm%'";

            $searchResult = mysqli_query($connection, $searchQuery);

            if ($searchResult && mysqli_num_rows($searchResult) > 0) {
                echo '<h3>Search Results:</h3>';
                echo '<table>';
                echo '<tr><th>ISBN</th><th>Title</th><th>Author</th><th>Category</th><th>Price</th><th>Amount</th></tr>';
                while ($book = mysqli_fetch_assoc($searchResult)) {
                    echo '<tr>';
                    echo '<td>' . $book['isbn'] . '</td>';
                    echo '<td>' . $book['book_title'] . '</td>';
                    echo '<td>' . $book['author'] . '</td>';
                    echo '<td>' . $book['category'] . '</td>';
                    echo '<td>' . $book['price'] . '</td>';
                    echo '<td>' . $book['amount'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {

                echo "No matching books found.";
            }
        }
        ?>

    </div>
</body>
</html>

