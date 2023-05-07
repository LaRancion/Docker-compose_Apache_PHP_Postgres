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
    // Handle file upload
    $targetDir = 'uploads/';
    $fileName = basename($_FILES['file']['name']);
    $targetPath = $targetDir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetPath)) {
        echo "File already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES['file']['size'] > 500000) {
        echo "File size is too large.";
        $uploadOk = 0;
    }

    // Allow only specific file types
    if ($imageFileType !== 'jpg' && $imageFileType !== 'png' && $imageFileType !== 'jpeg' && $imageFileType !== 'gif') {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // If file upload is valid, move the file and save its details to the database
    if ($uploadOk) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            // Save file details to the database
            $query = "INSERT INTO files (filename, filepath) VALUES (:filename, :filepath)";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':filename', $fileName);
            $stmt->bindValue(':filepath', $targetPath);
            $stmt->execute();

            echo "File uploaded successfully!";
        } else {
            echo "Error uploading the file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload Vulnerable Form with PostgreSQL</title>
</head>
<body>
    <h2>Upload a File</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <input type="file" name="file" required><br>

        <input type="submit" value="Upload">
    </form>

    <p>Implement proper file upload validation and restrict file types to mitigate file upload vulnerabilities.</p>
</body>
</html>
