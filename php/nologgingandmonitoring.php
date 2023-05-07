<?php
// PostgreSQL database connection settings
$host = '172.28.0.2';
$port = 5432;
$dbname = 'itsdb';
$user = 'its';
$password = 'itsITS200';

// Establish a database connection
$conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the credentials
    $query = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Successful login
        logEvent('Login', 'Successful login by: ' . $username);
        echo "Welcome, " . $username . "!";
    } else {
        // Failed login
        logEvent('Login', 'Failed login attempt with username: ' . $username);
        echo "Invalid username or password!";
    }
}

// Function to log security events
function logEvent($event, $details) {
    // You can implement your preferred logging mechanism here (e.g., writing to a log file, inserting into a database, etc.)
    // For simplicity, we'll just display the log message
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] [$event] $details" . PHP_EOL;
    echo $logMessage;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insufficient Logging and Monitoring Vulnerable Form</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" value="Log in">
    </form>
</body>
</html>
