document.addEventListener('DOMContentLoaded', function() {
    const historialCompras = JSON.parse(localStorage.getItem('historialCompras')) || [];
    const historialDiv = document.getElementById('historialCompras');

    if (historialCompras.length === 0) {
        historialDiv.innerHTML = '<p>No hay compras en el historial.</p>';
    } else {
        // Ordenar las compras por fecha (del más nuevo al más antiguo)
        historialCompras.sort((a, b) => {
            const fechaA = new Date(a.dia + ' ' + a.horario);
            const fechaB = new Date(b.dia + ' ' + b.horario);
            return fechaB - fechaA;
        });

        historialCompras.forEach(compra => {
            const compraDiv = document.createElement('div');
            compraDiv.classList.add('compra');
            compraDiv.innerHTML = `
                <p><strong>Cliente:</strong> ${compra.cliente_nombre || 'N/A'}</p>
                <p><strong>Película:</strong> ${compra.pelicula_titulo || 'N/A'}</p>
                <p><strong>Horario:</strong> ${compra.horario}</p>
                <p><strong>Día:</strong> ${compra.dia}</p>
                <p><strong>Sala:</strong> ${compra.sala}</p>
            `;
            historialDiv.appendChild(compraDiv);
        });
    }
});