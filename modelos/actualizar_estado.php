<?php
require_once '../modelos/db.php';
if ($conn === false) {
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}

if (isset($_POST['actualizar_estado'])) {
    $id = $_POST['id'];
    $cambio = $_POST['cambio'];

    $sql = "UPDATE pacientes SET esta_habilitada = '$cambio' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo json_encode('Success');
    } else {
        echo json_encode('Error');
    }
}
?>