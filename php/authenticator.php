<?php
session_start();

$row[0] = "";

$connStr = "host=172.23.0.2 port=5432 dbname=itsdb user=its password=itsITS200";

if (!$conn = pg_connect($connStr)) {
    echo "errore di connessione al DB";
    exit;
};

$query =  "SELECT  username FROM users  WHERE username='".
        $_POST['login']."' and password='".
        $_POST['password']."'";

$result = pg_query($conn, $query);

$row = pg_fetch_row($result);


if (!empty($row[0])) {
  $_SESSION['auth'] = $row[0];
  header("Location:page1.php");
  exit;
}


header("Location:index.php");
exit;
