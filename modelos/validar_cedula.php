<?php
require_once 'db.php';

if ($conn === false) {
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}

$cedula = $_POST['cedula'];

if ($cedula === 'admin23 2023@;'){
    SESSION_START();
    $_SESSION['usuario'] = $cedula;
    $_SESSION['id'] = 0;
    echo json_encode('admin');
    exit;
}

$sql = "SELECT * FROM usuarios WHERE cedula = '$cedula'";
$result = mysqli_query($conn, $sql);
$usuario = mysqli_fetch_assoc($result);

// if ($usuario) return true;
// else return false;

if ($usuario){
    SESSION_START();
    $_SESSION['usuario'] = $cedula;
    $_SESSION['id'] = $usuario['id'];

    echo json_encode($usuario['nombre']);
} else {
    echo json_encode(false);
}
mysqli_close($conn);
?>