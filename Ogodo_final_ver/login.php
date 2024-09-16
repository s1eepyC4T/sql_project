<!DOCTYPE html>
<html>

<head>
    <title>Ogodo_Login</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header {
        background-color: #007bff;
        color: #fff;
        text-align: center;
        padding: 10px;
    }

        h1 a {
            color: white; 
            text-decoration: none;
        }

        h2, h4 {
            color: #003580; 
        }

        

        form {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: left;
        }

        label {
            display: block;
            margin: 10px 0;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #e0e0e0; 
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #003580;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #001f4d; 
        }

        h4 a {
            color: #003580;
            text-decoration: none;
        }

        h4 a:hover {
            color: #001f4d; 
        }
    </style>
</head>

<body>
    <header><h1><a href="home_bf.php">Ogodo</a></h1></header>
    <h2>Login</h2>
    <form action="login_process.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">
    </form>

    <main>

        <h4><a href="regis_form.php">Don't have any account?</a></h4>
    </main>
</body>

</html>
