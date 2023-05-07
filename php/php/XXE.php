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
    $xmlData = $_POST['xml_data'];

    // Disable external entity parsing to mitigate XXE injection
    libxml_disable_entity_loader(true);

    // Load the XML data
    $xml = simplexml_load_string($xmlData);

    // Extract the values from the XML
    $username = $xml->username;
    $password = $xml->password;

    // Save the data to the database
    $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->execute();

    echo "Data saved successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>XXE Injection Vulnerable Form with PostgreSQL</title>
</head>
<body>
    <h2>Save User Data</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="xml_data">XML Data:</label>
        <textarea name="xml_data" id="xml_data" required></textarea><br>

        <input type="submit" value="Save">
    </form>

    <p>Handle XML input carefully and disable external entity parsing to mitigate XXE injection.</p>
</body>
</html>
