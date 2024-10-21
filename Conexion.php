<?php

$server = "localhost";
$user = "root";
$pass = "";
$db = "prueba";

$conexion = new mysqli($server,$user,$pass,$db);

if ($conexion->connect_error) {
    die("Conexion Fallida". $conexion->connect_error);
}else {
    
}
?>