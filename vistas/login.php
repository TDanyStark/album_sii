<div class="containerform">
    <form>
    <div class="mb-3">
        <label for="cedula" class="form-label">Cedula:</label>
        <input type="text" name="cedula" class="form-control" id="cedula">
    </div>
    <div class="mb-3 d-none">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="nombre" id="nombre">
    </div>
    <div class="mb-3 d-none">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="mb-3 form-check d-none">
        <input type="checkbox" class="form-check-input" id="terminos">
        <label class="form-check-label" for="terminos">Aceptar terminos y condiciones</label>
    </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</div>

<script>
    const formulario = document.querySelector('form');
    const cedula = document.querySelector('#cedula');
    const nombre = document.querySelector('#nombre');
    const email = document.querySelector('#email');
    const terminos = document.querySelector('#terminos');

    formulario.addEventListener('submit', (e) => {
        e.preventDefault();

        if (cedula.value === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingrese su cedula',
            });
        } else if (nombre.value === '' && terminos.checked === false) {
            // fetch to modelos/validar_cedula.php
            const data = new FormData();
            data.append('cedula', cedula.value);

            fetch('modelos/validar_cedula.php', {
                method: 'POST',
                body: data
            })
            .then(res => res.json())
            .then(data => {
                if (data === false) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Cedula no encontrada, para continuar por favor registrese',
                    });
                    nombre.parentNode.classList.remove('d-none');
                    terminos.parentNode.classList.remove('d-none');
                    email.parentNode.classList.remove('d-none');
                }else{
                    location.href = 'home';
                }
                if (data === 'admin') {
                    location.href = 'dashboard';
                }
            })
        }else{
            if(cedula.value === '' || nombre.value === '' || email.value === '' || terminos.checked === false){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Por favor llene todos los campos',
                });
                return;
            }

            // fetch to modelos/insertar_usuario.php
            const data = new FormData();
            data.append('cedula', cedula.value);
            data.append('nombre', nombre.value);
            data.append('email', email.value);
            data.append('terminos', terminos.checked);
            data.append('insertar_usuario', true);

            fetch('modelos/insertar_usuario.php', {
                method: 'POST',
                body: data
            })
            .then(res => {
                console.log(res);
                return res.json();
            })
            .then(data => {
                console.log(data);
                if (data === false) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al registrar usuario',
                    });
                
                }else{
                    location.href = 'home';
                }
            }).catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al registrar usuario',
                });
                console.log(err);
            });


        
        }
    });
</script>