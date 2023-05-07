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
    $redirectUrl = $_POST['redirect_url'];

    // Validate and sanitize the redirect URL
    // In this example, we'll simply check if the URL starts with "http://" or "https://"
    if (strpos($redirectUrl, 'http://') === 0 || strpos($redirectUrl, 'https://') === 0) {
        // Redirect the user to the provided URL
        header("Location: " . $redirectUrl);
        exit;
    } else {
        echo "Invalid redirect URL!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Unvalidated Redirects and Forwards Vulnerable Form with PostgreSQL</title>
</head>
<body>
    <h2>Redirect to URL</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="redirect_url">URL:</label>
        <input type="text" name="redirect_url" id="redirect_url" required><br>

        <input type="submit" value="Redirect">
    </form>
</body>
</html>
