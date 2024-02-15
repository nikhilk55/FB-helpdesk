<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="login" value="Login">
    </form>

    <?php
    // PHP code to handle login
    if (isset($_POST['login'])) {
        // Replace with your actual phpMyAdmin credentials
        $servername = "demo.phpmyadmin.net";
        $username = "your_username";
        $password = "your_password";
        $database = "Admin";

        // Create a connection
        $conn = mysqli_connect($servername, $username, $password, $database);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get user input
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Retrieve user data from the database
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                echo "Login successful!";
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }

        mysqli_close($conn);
    }
    ?>
</body>
</html>
