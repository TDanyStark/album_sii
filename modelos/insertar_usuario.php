<?php
require_once '../modelos/db.php';
if ($conn === false) {
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}
SESSION_START();
if (isset($_SESSION['usuario'])) {
    header("Location: home");
}
//insertar usuario
if (isset($_POST['insertar_usuario'])) {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $terminos = $_POST['terminos'];

    $sql = "INSERT INTO usuarios (cedula, nombre, email, terminos) VALUES ('$cedula', '$nombre', '$email', '$terminos')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['usuario'] = $cedula;
        $_SESSION['id'] = mysqli_insert_id($conn);
        
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
}
mysqli_close($conn);
?>