<?php
include_once "Conexion.php";

// Comprobar si los datos han sido enviados a través de POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recepcionar los datos usando $_POST
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Encriptar la contraseña con MD5
    $password = md5($password);
	
    // Consulta segura usando consultas preparadas
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Inicializar un flag para la autenticación
    $authenticated = false;

    // Iterar sobre los resultados
    while ($row = $result->fetch_assoc()) {
        // Verificar la contraseña encriptada con MD5
        if ($password == $row['contraseña']) {
            session_start();
            $_SESSION['nombres'] = $row["nombres"];
            $_SESSION['rol'] = $row["id_rol"];
            header("Location: index.php");
            exit();
        }
    }

    // Si no se autenticó, mostrar mensaje de error
   header("Location: login.html");
    exit();

} else {
    header("Location: login.html");
    exit();
}
?>