<?php
// Database connection settings
$host = "localhost";
$port = "5432";
$dbname = "your_database";
$user = "your_username";
$password = "your_password";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Create a connection to the database
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

    // Check the connection
    if (!$conn) {
        die("Connection failed");
    }

    // Prepare the SQL statement
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

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
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
</body>
</html>
