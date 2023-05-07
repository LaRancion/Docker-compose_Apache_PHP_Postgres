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
    $userId = $_POST['user_id'];

    // Query the database using the provided user ID
    $query = "SELECT * FROM users WHERE id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':user_id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Display the user's information
        echo "User ID: " . $user['id'] . "<br>";
        echo "Username: " . $user['username'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
    } else {
        // User not found
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insecure Direct Object Reference Vulnerable Form with PostgreSQL</title>
</head>
<body>
    <h2>View User Information</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" id="user_id" required><br>

        <input type="submit" value="View">
    </form>

    <p>Ensure proper access controls and validation to prevent unauthorized access to sensitive data.</p>
</body>
</html>
