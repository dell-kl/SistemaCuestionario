<?php

$server = "localhost";
$username = "dennis";
$password = "dennis";
$db = "CuestionarioDB";

$conexion = new PDO("mysql:dbname=$db", $username, $password);
$conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

?>