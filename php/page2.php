<?php
session_start();
if (!isset($_SESSION['auth'])) {
header("Location:index.php");
exit;
}
echo $_SESSION['auth'] .", sei nella pagina 2";
echo "<br><br>contatore visualizzazione pagine: ".$_SESSION['counter']."<br><br>";
$_SESSION['counter'] += 1;

echo "<br><br><a href='counterReset.php'>Resetta contatore</a>";
echo "<br><br>" ."<a href=\"page1.php\">Pagina 1</a>";
echo " &nbsp;&nbsp;<a href=\"logout.php\">Logout</a>";
