<?php 

SESSION_START();
if (!isset($_SESSION['usuario'])) {
    header("Location: login");
}

//si existe la variable get cerrar sesion entonces destruir la sesion
if (isset($_GET['cerrar_sesion'])) {
    session_destroy();
    header("Location: login");
}

require_once '../vistas/comunes/header.php';?>

<?php
    require_once '../modelos/db.php';

    if ($conn === false) {
        die("ERROR: No se pudo conectar. " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM pacientes";
    $result = mysqli_query($conn, $sql);
    $pacientes = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $pacientesporpagina = 5;

    //validar el id de la sesion si tiene registros en la tabla progreso
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM progreso WHERE usuario_id = '$id'";
    $result = mysqli_query($conn, $sql);

    $progress = false;
    if($result->num_rows == 0){
        $progress = false;
        // pasar todos los pacientes a la tabla progreso con el id del usuario y el id del paciente
        foreach ($pacientes as $paciente) {
            $id_paciente = $paciente['id'];
            $order = $paciente['orden_tratamiento'];
            $sql = "INSERT INTO progreso (usuario_id, paciente_id, order_eleccion, completed) VALUES ('$id', '$id_paciente', $order, 0)";
            $result = mysqli_query($conn, $sql);
        }

    }else{
        $progress = true;
    }

    // obtener los pacientes con el progreso del usuario
    $sql = "SELECT pacientes.*, progreso.id AS idprogreso, progreso.paciente_id, progreso.order_eleccion, progreso.completed FROM pacientes INNER JOIN progreso ON progreso.paciente_id = pacientes.id WHERE progreso.usuario_id ='$id' AND pacientes.esta_habilitada = 1";
    $result = mysqli_query($conn, $sql);
    $progreso = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $pacientes = $progreso;
?>

<?php require_once '../vistas/stickers.php';?>
<?php require_once '../vistas/comunes/footer.php';?>
<?php mysqli_close($conn);?>