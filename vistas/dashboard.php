<div class="checkpacientes">
    <?php
        foreach($pacientes as $paciente){
            echo '<div class="checkpaciente">';
            echo '<p class="p-namepaciente">'.$paciente['nombre_paciente'].'</p>';

            if ($paciente['esta_habilitada'] == 1){
                echo '<input class="input" type="checkbox" id="'.$paciente['id'].'" value="'.$paciente['esta_habilitada'].'" checked>';
            }else{
                echo '<input class="input" type="checkbox" id="'.$paciente['id'].'" value="'.$paciente['esta_habilitada'].'">';
            }
            echo '</div>';
        }
    ?>
</div>
<div class="tabla">

<div class="table-responsive">
    <table class="table" id="tabla-usuarios">
        <thead>
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Cedula</th>
            <?php
                foreach($pacientes as $paciente){
                    echo '<th scope="col">'.$paciente['nombre_paciente'].'</th>';
                }
            ?>
            </tr>
        </thead>
        <tbody>
        <?php
            // $progresoUser= 0;
            // foreach($usuarios as $usuario){
                
            //     echo '<tr>';
            //     echo '<td>'.$usuario['nombre'].'</td>';
            //     echo '<td>'.$usuario['cedula'].'</td>';
            //     for ($progresoUser; $progresoUser <= count($progresos) - 1 ; $progresoUser++){

            //         if ($progresos[$progresoUser]['nombre'] != $usuario['nombre']){
            //             break;
            //         }

            //         if($progresos[$progresoUser]['completed'] == 1){
            //             echo '<td>'.$progresos[$progresoUser]['fecha_interaccion'].'</td>';
            //         }else{
            //             echo '<td>Incompleto</td>';
            //         }
            //     };

            //     echo '</tr>';
            // }
            $progresoUser= 0;
            $progresoProgreso= 0;
            $progresoUserName = '';

            $contador = 0;
            // Guarda el tiempo de inicio
            $tiempoInicio = microtime(true);

            for($progresoUser ; $progresoUser <= count($progresos) - 1 ; $progresoUser++){
                $contador++;
                if($progresoUserName == $progresos[$progresoUser]['nombre']){
                    continue;
                };
                echo '<tr>';
                echo '<td>'.$progresos[$progresoUser]['nombre'].'</td>';
                echo '<td>'.$progresos[$progresoUser]['cedula'].'</td>';


                for ($progresoProgreso; $progresoProgreso <= count($progresos) - 1 ; $progresoProgreso++){
                    $contador++;

                    if ($progresos[$progresoProgreso]['nombre'] != $progresos[$progresoUser]['nombre']){
                        break;
                    }

                    if($progresos[$progresoProgreso]['completed'] == 1){
                        echo '<td>'.$progresos[$progresoProgreso]['fecha_interaccion'].'</td>';
                    }else{
                        echo '<td>Incompleto</td>';
                    }

                };
                echo '</tr>';
                $progresoUserName = $progresos[$progresoUser]['nombre'];
            };
            

            // Guarda el tiempo de finalización
            $tiempoFin = microtime(true);

            // Calcula la duración en segundos
            $duracion = $tiempoFin - $tiempoInicio;

            // Imprime la duración en segundos
            echo "El proceso tardó: " . $duracion . " segundos";
            echo $contador;

        ?>
        </tbody>
    </table>
</div>
</div>

<script>
    let myTable = document.getElementById('tabla-usuarios');
    let dataTable = new DataTable(myTable);

    let inputs = document.querySelectorAll('.input');

    document.addEventListener('click', function(e){
        if(e.target.classList.contains('input')){
            let id = e.target.id;
            let value = e.target.value;

            id = parseInt(id);
            
            

            let cambio = value == 1 ? 0 : 1;
            console.log(id);
            console.log(cambio);

            let data = new FormData();
            data.append('actualizar_estado', true);
            data.append('id', id);
            data.append('cambio', cambio);

            fetch('modelos/actualizar_estado.php', {
                method: 'POST',
                body: data
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
            })
        }
    })
    
</script>