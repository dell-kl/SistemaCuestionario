<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "CuestionarioDB";

$conexion = new PDO("mysql:host=$server;dbname=$db", $username, $password);
$conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

?>