<?php
include_once"../Conexion.php";
// Comprobar si los datos han sido enviados a través de POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recepcionar los datos usando $_POST
    $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : '';
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
    $correo =isset($_POST['correo']) ? $_POST['correo'] : '';
    


    header("index.php");
}else{
    header("login.php") ;
}
?>