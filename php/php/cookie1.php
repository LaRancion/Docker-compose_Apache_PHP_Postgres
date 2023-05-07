<?php
// Set the insecure cookie
setcookie("insecure_cookie", "This is an insecure cookie", time() + (86400 * 30), "/");

// Retrieve the insecure cookie value
$insecure_cookie = $_COOKIE["insecure_cookie"] ?? "";

// Display the cookie value
echo "Insecure Cookie: " . $insecure_cookie;
?>
