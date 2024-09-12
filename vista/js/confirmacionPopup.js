function mostrarImagenPelicula() {
    const selectPelicula = document.getElementById('pelicula');
    const imagenPelicula = document.getElementById('imagenPelicula');
    const peliculasDataElement = document.getElementById('peliculasData');
    const peliculas = peliculasDataElement ? JSON.parse(peliculasDataElement.textContent) : [];

    selectPelicula.addEventListener('change', function() {
        const peliculaSeleccionada = peliculas.find(pelicula => pelicula.pelicula_id == this.value);
        if (peliculaSeleccionada) {
            imagenPelicula.src = peliculaSeleccionada.imagen;
            imagenPelicula.alt = peliculaSeleccionada.titulo;
        } else {
            imagenPelicula.src = 'img/imagenNoEncontrada.png';
            imagenPelicula.alt = 'Imagen no encontrada';
        }
    });

    // Seleccionar automáticamente la película si hay una preseleccionada
    const peliculaSeleccionadaIdElement = document.getElementById('peliculaSeleccionadaId');
    const peliculaSeleccionadaId = peliculaSeleccionadaIdElement ? JSON.parse(peliculaSeleccionadaIdElement.textContent) : null;
    if (peliculaSeleccionadaId) {
        selectPelicula.value = peliculaSeleccionadaId;
        const evento = new Event('change');
        selectPelicula.dispatchEvent(evento);
    }
}

function confirmarReserva(event) {
    event.preventDefault(); // Evitar el envío del formulario

    const selectPelicula = document.getElementById('pelicula');
    const selectCliente = document.getElementById('cliente');
    const inputHorario = document.getElementById('horario');
    const inputDia = document.getElementById('dia');
    const inputSala = document.getElementById('sala');

    const peliculaSeleccionada = selectPelicula.options[selectPelicula.selectedIndex].text;
    const clienteSeleccionado = selectCliente.options[selectCliente.selectedIndex].text;
    const horarioSeleccionado = inputHorario.value;
    const diaSeleccionado = inputDia.value;
    const salaSeleccionada = inputSala.value;

    Swal.fire({
        title: 'CONFIRMACION DE RESERVA',
        html: `
            <p><strong>Usuario de nombre:</strong> ${clienteSeleccionado}</p>
            <p><strong>Película:</strong> ${peliculaSeleccionada}</p>
            <p><strong>Horario:</strong> ${horarioSeleccionado}</p>
            <p><strong>Día:</strong> ${diaSeleccionado}</p>
            <p><strong>Sala:</strong> ${salaSeleccionada}</p>
            <p>¿Estás seguro de que deseas confirmar la reserva?</p>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, confirmar',
        cancelButtonText: 'Cancelar',
        customClass: {
            popup: 'custom-popup',
            title: 'custom-title',
            htmlContainer: 'custom-html',
            confirmButton: 'custom-confirm-button',
            cancelButton: 'custom-cancel-button'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Crear un objeto con los datos de la reserva
            const nuevaCompra = {
                cliente_id: selectCliente.value,
                cliente_nombre: clienteSeleccionado,
                pelicula_id: selectPelicula.value,
                pelicula_titulo: peliculaSeleccionada,
                horario: horarioSeleccionado,
                dia: diaSeleccionado,
                sala: salaSeleccionada
            };

            // Convertir el objeto a una cadena de consulta
            const params = new URLSearchParams(nuevaCompra).toString();

            // Depuración: Registrar los datos que se están enviando
            console.log('Datos enviados:', nuevaCompra);

            // Enviar los datos al servidor para almacenarlos en la base de datos usando AJAX
            $.ajax({
                url: '../control/procesar_confirmacion.php',
                type: 'POST',
                data: params,
                contentType: 'application/x-www-form-urlencoded',
                success: function(data) {
                    // Depuración: Registrar la respuesta del servidor
                    console.log('Respuesta del servidor:', data);

                    if (data.success) {
                        // Almacenar los datos de la reserva en localStorage
                        let historialCompras = JSON.parse(localStorage.getItem('historialCompras')) || [];
                        historialCompras.push(nuevaCompra);
                        localStorage.setItem('historialCompras', JSON.stringify(historialCompras));

                        // Enviar el formulario si se confirma
                        document.getElementById('formularioBoleto').submit();
                    } else {
                        Swal.fire('Error', data.message || 'No se pudo confirmar la reserva. Inténtalo de nuevo.', 'error');
                    }
                },
                error: function(error) {
                    // Depuración: Registrar el error
                    console.error('Error:', error);
                    Swal.fire('Error', 'Ocurrió un error al procesar la reserva. Inténtalo de nuevo.', 'error');
                }
            });
        }
    });
}

window.onload = function() {
    mostrarImagenPelicula();
    document.getElementById('formularioBoleto').addEventListener('submit', confirmarReserva);
};