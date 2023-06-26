<main class="main">
    <section class="informacion">
        <div class="contenedorlegales">
            <a href="legales">
                <img src="public/img/logos/clinicos.png" alt="legales">
            </a>
        </div>
        <p class="paddr-10">Para conocer las opciones del portafolio que en SII lo tiene todo, debe <b>arrastrar la foto de cada perfil</b> de paciente <b>a la casilla del tratamiento</b> que usted considera adecuado.</p>
        <h1 class="text-white seleccion">SELECCIÓN <span class="SII">SII</span></h1>
    </section>
    
    <section class="stickers" id="stickers">
    <div class="pacientes">

        <?php
            $contador = 1;
            foreach ($pacientes as $paciente) {
                if ($contador > $pacientesporpagina) {
                    if($paciente['completed'] == 0){
                        echo '<div class="contenedorsticker d-none">';
                        echo '<h2>'.$paciente['nombre_paciente'].'</h2>';
                        echo '<img draggable="true" data-order="'.$paciente['order_eleccion'].'" data-idprogreso="'.$paciente['idprogreso'].'" data-tratamiento="' . $paciente['tratamiento_correcto'] . '" data-id="' . $paciente['nombre_paciente'] . '" src="public/img/pacientes/' . $paciente['nombre_paciente'] . '.webp" alt="'.$paciente['nombre_paciente'].'">';
                        echo '</div>';
                    }else{
                        echo '<div class="contenedorsticker completedsticker d-none">';
                        echo '<h2>'.$paciente['nombre_paciente'].'</h2>';
                        echo '</div>';
                    }
                } else {
                    if($paciente['completed'] == 0){
                        echo '<div class="contenedorsticker">';
                        echo '<h2>'.$paciente['nombre_paciente'].'</h2>';
                        echo '<img draggable="true" data-order="'.$paciente['order_eleccion'].'" data-idprogreso="'.$paciente['idprogreso'].'"    data-tratamiento="' . $paciente['tratamiento_correcto'] . '" data-id="' . $paciente['nombre_paciente'] . '" src="public/img/pacientes/' . $paciente['nombre_paciente'] . '.webp" alt="'.$paciente['nombre_paciente'].'">';
                        echo '</div>';
                    }else{
                        echo '<div class="contenedorsticker completedsticker">';
                        echo '<h2>'.$paciente['nombre_paciente'].'</h2>';
                        echo '</div>';
                    }
                }
                $contador++;
            }
        ?>
        
    </div>
    <div class="tratamientos">

    <?php
        $contador = 1;
        foreach ($pacientes as $paciente) {
            if ($contador > $pacientesporpagina) {
                if($paciente['completed'] == 0){
                    echo '<div style="order:'.$paciente['order_eleccion'].'" data-idprogreso="'.$paciente['idprogreso'].'" data-order="'.$paciente['order_eleccion'].'" class="cardtratamiento d-none" data-tratamiento="' . $paciente['tratamiento_correcto'] . '">';
                    echo '<img src="public/img/tratamientos_sticker/' . $paciente['tratamiento_correcto'] . '.png" alt="">';
                    echo '</div>';
                }else{
                    echo '<div style="order:'.$paciente['order_eleccion'].'" data-idprogreso="'.$paciente['idprogreso'].'" data-order="'.$paciente['order_eleccion'].'" class="cardtratamiento ocupado d-none" data-tratamiento="' . $paciente['tratamiento_correcto'] . '">';
                    echo '<img draggable="false" data-tratamiento="' . $paciente['tratamiento_correcto'] . '" data-id="' . $paciente['nombre_paciente'] . '" src="public/img/pacientes/' . $paciente['nombre_paciente'] . '.webp" alt="'.$paciente['nombre_paciente'].'">';
                    echo '</div>';
                }
            } else {
                if($paciente['completed'] == 0){
                    echo '<div style="order:'.$paciente['order_eleccion'].'" data-idprogreso="'.$paciente['idprogreso'].'" data-order="'.$paciente['order_eleccion'].'" class="cardtratamiento" data-tratamiento="' . $paciente['tratamiento_correcto'] . '">';
                    echo '<img src="public/img/tratamientos_sticker/' . $paciente['tratamiento_correcto'] . '.png" alt="">';
                    echo '</div>';
                }else{
                    echo '<div style="order:'.$paciente['order_eleccion'].'" data-idprogreso="'.$paciente['idprogreso'].'" data-order="'.$paciente['order_eleccion'].'" class="cardtratamiento ocupado">';
                    echo '<img draggable="false" data-tratamiento="' . $paciente['tratamiento_correcto'] . '" data-id="' . $paciente['nombre_paciente'] . '" src="public/img/pacientes/' . $paciente['nombre_paciente'] . '.webp" alt="'.$paciente['nombre_paciente'].'">';
                    echo '</div>';
                }
            }
            $contador++;
        }
    ?>
    </div>
    </section>
    <section class="paginas">
        <ul class="pagination">
            <?php
                $pacientesporpagina = $pacientesporpagina;
                $cantidad = count($pacientes);
                $paginas = ceil($cantidad / $pacientesporpagina);

                for ($i = 1; $i <= $paginas; $i++) {
                    if ($i == 1) {
                        echo '<li class="page-item active"><a class="page-link" href="#stickers">' . $i . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="#stickers">' . $i . '</a></li>';
                    }
                }

            ?>
        </ul>
        <h2 class='text-white'>PÁGINAS</h2>
    </section>
    
</main>

<?php
    require_once 'popups.php';
?>

<script>
    const tratamientos = document.querySelector('.tratamientos');
    const pacientes = document.querySelector('.pacientes');

    let cardtratamiento = null;

    document.addEventListener('dragstart', function(event) {
        // si el elemento arrastrado es una imagen, lo guardamos en la propiedad dataTransfer
        if (event.target.tagName.toLowerCase() == 'img') {
            // capturar el data-id del elemento
            event.dataTransfer.setData('text/plain', event.target.dataset.id);
        }
    });

    document.addEventListener('dragover', function(event) {
        // cancelamos el evento para que el navegador no abra la imagen
        event.preventDefault();
        // cancelamos el evento para que el navegador sepa que podemos soltar el elemento
        event.preventDefault();
        if (event.target.classList.contains('cardtratamiento') || event.target.parentNode.classList.contains('cardtratamiento')) {
            let padre = event.target.classList.contains('cardtratamiento') ? event.target : event.target.parentNode;
            padre.classList.add('hover');
        }
    });

    document.addEventListener('dragleave', function(event) {
        if (event.target.classList.contains('cardtratamiento') || event.target.parentNode.classList.contains('cardtratamiento')) {
            let padre = event.target.classList.contains('cardtratamiento') ? event.target : event.target.parentNode;
            padre.classList.remove('hover');
        }
    });

    document.addEventListener('drop', function(event) {
        // obtenemos los datos del elemento arrastrado
        let id = event.dataTransfer.getData('text');
        // creamos una imagen con el id del elemento arrastrado
        let imgOriginal = document.querySelector('img[data-id="' + id + '"]');
        
        
        // añadimos la imagen al contenedor
        let padre = event.target.classList.contains('cardtratamiento') ? event.target : event.target.parentNode;
        let tratamiento_imagen_original = imgOriginal.dataset.tratamiento;
        let tratamiento_imagen_destino = padre.dataset.tratamiento;

        // si padre ya tiene una imagen, no podemos agregar otra 
        if (padre.classList.contains('ocupado')) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ya has seleccionado un tratamiento para este paciente',
            })
            padre.classList.remove('hover');
            return;
        }

        console.log('tratamiento_imagen_original:', tratamiento_imagen_original, 'tratamiento_imagen_destino:', tratamiento_imagen_destino);

        // si tratamiento_imagen_destino es undefined hacer return
        if (tratamiento_imagen_destino == undefined) return;

        if (tratamiento_imagen_original != tratamiento_imagen_destino) {
            let $again = document.getElementById('AGAIN');
            $again.classList.remove('d-none');
            padre.classList.remove('hover');

            cardtratamiento = document.getElementById('AGAIN');
            return;
        }

        padre.classList.remove('hover');
        padre.classList.add('ocupado');


        let idprogreso = imgOriginal.getAttribute('data-idprogreso');
        let order = padre.getAttribute('data-order');
        let id_progresopadre = padre.getAttribute('data-idprogreso');
        let orderpadre = imgOriginal.getAttribute('data-order');
        let tratamiento = padre.getAttribute('data-tratamiento'); 

        // esto para evitar dobles consultas en la base de datos, entonces actualizamos el data-order que es el que nos guia para saber en que orden esta cada imagen
        tratamientos.querySelector('div[data-idprogreso="' + idprogreso + '"]').setAttribute('data-idprogreso', id_progresopadre);
        pacientes.querySelector('img[data-idprogreso="' + id_progresopadre + '"]').setAttribute('data-order', orderpadre);


        console.log('idprogreso:',idprogreso, 'order:', order, 'id_progresopadre:', id_progresopadre, 'orderpadre:', orderpadre, 'tratamiento:', tratamiento);
        let data = new FormData();
        data.append('registrar_progreso', true);
        data.append('id_progreso', idprogreso);
        data.append('order_eleccion', order);
        data.append('id_progresopadre', id_progresopadre);
        data.append('orderpadre', orderpadre);


        fetch('modelos/actualizar_progreso.php', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })

        imgOriginal.parentNode.classList.add('completedsticker')
        // eliminar el contenido del contenedor
        padre.innerHTML = '';
        padre.appendChild(imgOriginal);

        //quitarle el draggable a la imagen
        imgOriginal.draggable = false;

        cardtratamiento = document.getElementById(tratamiento);
        cardtratamiento.classList.remove('d-none');
        document.body.classList.add('no-scroll');

        cardtratamiento.querySelector('.texto-titulo').textContent = '¡MUY BIEN!';
    });

    // Obtener los elementos de las tarjetas
    const tarjetas = document.querySelectorAll('.contenedorsticker');
    const tarjetasTratamientos = document.querySelectorAll('.tratamientos .cardtratamiento');

    // Asignar un evento de clic a la página 2 de la paginación
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('page-link') || e.target.classList.contains('btn-nav')) {
            
            let active = document.querySelector('.active');
            active.classList.remove('active');

            let totalporpagina = <?php echo $pacientesporpagina; ?>;
            let pagina = parseInt(e.target.innerHTML);
            let inicio = (pagina - 1) * totalporpagina;
            let fin = inicio + totalporpagina;

            for (let i = 0; i < tarjetas.length; i++) {
                if (i >= inicio && i < fin) {
                    tarjetas[i].classList.remove('d-none');
                    tarjetasTratamientos[i].classList.remove('d-none');
                } else {
                    tarjetas[i].classList.add('d-none');
                    tarjetasTratamientos[i].classList.add('d-none');
                }
            }            
            e.target.classList.add('active');
            }
            if (e.target.closest('.btn-cerrar')){
                cardtratamiento.classList.add('d-none');
                document.body.classList.remove('no-scroll');
            };
        });

</script>