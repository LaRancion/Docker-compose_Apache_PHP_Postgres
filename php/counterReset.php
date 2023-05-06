<?php
session_start();
if (!isset($_SESSION['auth'])) {
header("Location:index.php");
exit;
}
$_SESSION['counter'] = 1;
header("Location:page1.php");