<?php
// Class definition for serialized object
class User {
    public $username;
    public $isAdmin;

    public function __construct($username, $isAdmin) {
        $this->username = $username;
        $this->isAdmin = $isAdmin;
    }

    public function __toString() {
        return "Username: " . $this->username . "<br>" .
            "Is Admin: " . ($this->isAdmin ? "Yes" : "No");
    }
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['data'];

    // Deserialize the data
    $user = unserialize($data);

    if ($user instanceof User) {
        // Display the deserialized user object
        echo $user;
    } else {
        // Invalid data
        echo "Invalid data!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insecure Deserialization Vulnerable Form</title>
</head>
<body>
    <h2>Deserialize Object</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="data">Serialized Object:</label>
        <textarea name="data" id="data" required></textarea><br>

        <input type="submit" value="Deserialize">
    </form>

    <p>Ensure proper input validation and implement secure deserialization practices to mitigate insecure deserialization vulnerabilities.</p>
</body>
</html>
