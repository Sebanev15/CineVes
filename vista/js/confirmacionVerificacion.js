// Recuperar el ID de la película seleccionada desde la URL
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const peliculaSeleccionadaId = urlParams.get('pelicula_id');
    if (peliculaSeleccionadaId) {
        const selectPelicula = document.getElementById('pelicula');
        selectPelicula.value = peliculaSeleccionadaId;
        actualizarImagenPelicula();
    }
});

// Actualizar la imagen de la película seleccionada
function actualizarImagenPelicula() {
    const selectPelicula = document.getElementById('pelicula');
    const imagenPelicula = document.getElementById('imagenPelicula');
    const peliculaSeleccionada = selectPelicula.options[selectPelicula.selectedIndex];
    const imagenSrc = peliculaSeleccionada.getAttribute('data-imagen');
    imagenPelicula.src = imagenSrc ? imagenSrc : 'img/imagenNoEncontrada.png';
}

// Evento para actualizar la imagen cuando se cambia la selección de la película
document.getElementById('pelicula').addEventListener('change', actualizarImagenPelicula);

// Actualizar los campos ocultos antes de enviar el formulario
document.getElementById('formularioBoleto').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío del formulario
    console.log('Evento submit prevenido'); // Verificar que el evento submit se previene

    const selectCliente = document.getElementById('cliente');
    const selectPelicula = document.getElementById('pelicula');
    const clienteNombre = selectCliente.options[selectCliente.selectedIndex].getAttribute('data-nombre');
    const peliculaTitulo = selectPelicula.options[selectPelicula.selectedIndex].getAttribute('data-titulo');
    document.getElementById('cliente_nombre').value = clienteNombre;
    document.getElementById('pelicula_titulo').value = peliculaTitulo;

    // Llamar a la función confirmarReserva
    confirmarReserva(event);
});