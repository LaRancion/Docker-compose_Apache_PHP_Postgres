<?php
// Retrieve the insecure cookie value
$insecure_cookie = $_COOKIE["insecure_cookie"] ?? "";

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted name
    $name = $_POST['name'];

    // Set the insecure cookie with the submitted name
    setcookie("insecure_cookie", $name, time() + (86400 * 30), "/");

    // Redirect to the same page to display the updated cookie value
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insecure Cookie Form</title>
</head>
<body>
    <h2>Enter your name</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <input type="submit" value="Submit">
    </form>

    <h2>Insecure Cookie Value</h2>
    <?php
    // Display the insecure cookie value
    echo "Insecure Cookie: " . $insecure_cookie;
    ?>
</body>
</html>
