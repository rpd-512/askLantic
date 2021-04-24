<?php
$dbhs = "localhost";
$dbus = ""; //database username
$dbnm = "askLantic";
$dbpw = ""; // database password
$pdo=new PDO('mysql:host='.$dbhs.';port=3306;dbname='.$dbnm.';charset=utf8mb4',$dbus,$dbpw);
?>
