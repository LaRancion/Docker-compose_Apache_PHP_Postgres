<?php
// PostgreSQL database connection settings
$host = 'ip';
$port = 5432;
$dbname = 'dbname';
$user = 'user';
$password = 'password';

// Establish a database connection
$conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id'];
    $newEmail = $_POST['new_email'];

    // Update the user's email
    $query = "UPDATE users SET email = :new_email WHERE id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':user_id', $userId);
    $stmt->bindValue(':new_email', $newEmail);
    $stmt->execute();

    echo "Email updated successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CSRF Vulnerable Form with PostgreSQL</title>
</head>
<body>
    <h2>Update Email</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="user_id" value="1">
        <!-- Replace "1" with the actual user ID of the logged-in user -->

        <label for="new_email">New Email:</label>
        <input type="email" name="new_email" id="new_email" required><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
