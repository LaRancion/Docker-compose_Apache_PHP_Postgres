<!DOCTYPE html>
<html>
<head>
    <title>SQL Injection - Vulnerable Form</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" value="Login">
    </form>

    <?php
    // Database connection settings
    $host = "172.28.0.2";
    $port = "5432";
    $dbname = "itsdb";
    $user = "its";
    $password = "itsITS200";

    // Process the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the submitted username and password
        $input_username = $_POST['username'];
        $input_password = $_POST['password'];

        // Create a connection to the database
        $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

        // Check the connection
        if (!$conn) {
            die("Connection failed");
        }

        // Construct the SQL query (vulnerable to SQL Injection)
        $sql = "SELECT * FROM users WHERE username = '$input_username' AND password = '$input_password'";

        // Execute the query
        $result = pg_query($conn, $sql);

        // Check if a matching user is found
        if (pg_num_rows($result) == 1) {
            // Authentication successful
            echo "Login successful!";
        } else {
            // Authentication failed
            echo "Invalid username or password!";
        }

        // Close the database connection
        pg_close($conn);
    }
    ?>
</body>
</html>
