<?php
// PostgreSQL database connection settings
$host = '172.28.0.2';
$port = 5432;
$dbname = 'itsdb';
$user = 'its';
$password = 'itsITS200';

// Establish a database connection
$conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
//$connStr = "host=172.23.0.2 port=5432 dbname=itsdb user=its password=itsITS200";
// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    // Execute the command using the user input
    $command = "ls -l /var/www/uploads/" . $name;
    $output = shell_exec($command);

    echo "<pre>$output</pre>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Command Injection Vulnerable Form with PostgreSQL</title>
</head>
<body>
    <h2>Execute Command</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Filename:</label>
        <input type="text" name="name" id="name" required><br>

        <input type="submit" value="Execute">
    </form>

    <p>Ensure proper input validation and sanitization to prevent command injection vulnerabilities.</p>
</body>
</html>
