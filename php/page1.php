<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location:index.php");
    exit;
}

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}

echo $_SESSION['auth'] . ", sei nella pagina 1";
echo "<br><br>contatore visualizzazione pagine: " . $_SESSION['counter'] . "<br><br>";
$_SESSION['counter'] += 1;

echo "<br><br><a href='counterReset.php'>Resetta contatore</a>";
echo "<br><br><a href=\"page2.php\">Pagina 2</a>";
echo "&nbsp;&nbsp;<a href=\"logout.php\">Logout</a>";
