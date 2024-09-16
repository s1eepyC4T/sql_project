<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
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

        h2, h3 {
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

        h3 a {
            color: #003580;
            text-decoration: none;
        }

        h3 a:hover {
            color: #001f4d; 
        }
    </style>
</head>

<body>
<header> <h1><a href="home_bf.php">Ogodo</a></h1></header>
   
    <h2>User Registration</h2>
    <form action="regis_Process.php" method="post">
        <label for="m_name">Name:</label>
        <input type="text" name="m_name" required><br>

        <label for="m_tel">Telephone Number:</label>
        <input type="tel" name="m_tel" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="confirm_pass">Confirm Password:</label>
        <input type="password" name="confirm_pass" required><br>

        <input type="submit" value="Register">
    </form>
    <h3><a href="login.php">Already have an account?</a></h3>
</body>

</html>
