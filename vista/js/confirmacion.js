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

            // Depuración: Registrar los datos que se están enviando
            console.log('Datos enviados:', nuevaCompra);

            // Enviar los datos al servidor para almacenarlos en la base de datos usando AJAX
            $.ajax({
                url: '../control/procesar_confirmacion.php',
                type: 'POST',
                data: nuevaCompra,
                success: function(data) {
                    // Depuración: Registrar la respuesta del servidor
                    console.log('Respuesta del servidor:', data);

                    if (data.success) {
                        // Almacenar los datos de la reserva en localStorage
                        let historialCompras = JSON.parse(localStorage.getItem('historialCompras')) || [];
                        historialCompras.push(nuevaCompra);
                        localStorage.setItem('historialCompras', JSON.stringify(historialCompras));

                        // Mostrar mensaje de éxito y redirigir a otra página o actualizar la página actual
                        Swal.fire('Éxito', 'Reserva confirmada con éxito.', 'success').then(() => {
                            window.location.href = 'historial.php'; // Redirigir a una página de éxito
                        });
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