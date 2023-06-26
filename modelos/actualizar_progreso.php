<?php
require_once '../modelos/db.php';
if ($conn === false) {
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}

SESSION_START();

// registrar progreso con las 2 variables que vienen por post
if (isset($_POST['registrar_progreso'])) {
    $id = $_SESSION['id'];
    $id_progreso = $_POST['id_progreso'];
    $order_eleccion = $_POST['order_eleccion'];
    $id_progresopadre = $_POST['id_progresopadre'];
    $orderpadre = $_POST['orderpadre'];


    $sql = "UPDATE progreso SET order_eleccion = '$order_eleccion', completed = 1, fecha_interaccion = CURRENT_TIME() WHERE usuario_id = '$id' AND id = '$id_progreso'";
    $result = mysqli_query($conn, $sql);

    $rta = array();

    if ($id_progreso != $id_progresopadre && $order_eleccion != $orderpadre) {
        $sql2 = "UPDATE progreso SET order_eleccion = '$orderpadre' WHERE usuario_id = '$id' AND id = '$id_progresopadre'";
        $result2 = mysqli_query($conn, $sql2);
        $rta['sql2'] = true;
    }else{
        $rta['sql2'] = false;
    }

    if ($result) {
        $rta['sql'] = true;
        echo json_encode($rta);
    } else {
        $rta['sql'] = false;
        echo json_encode($rta);
    } 
}
?>