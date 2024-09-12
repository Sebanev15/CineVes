<?php
include_once('../control/PeliculaControl.php');
include_once('../control/ClienteControl.php');

// Crear instancias de los controladores
$peliculaControl = new PeliculaControl();
$clienteControl = new ClienteControl();

// Obtener las películas y los clientes
$peliculas = $peliculaControl->obtenerPeliculas();
$clientes = $clienteControl->obtenerClientes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONFIRMACION</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<img src="img/menu.png" onclick="burgerClick()" id="burgerImagen" alt="">
    <header>
        <nav class="mostrar">
            <div class="textoEncabezado">
                <a href="index.php" >INICIO</a>
                <a href="confirmacion.php" class="seleccionado">CONFIRMACION</a>
            </div>
            <a class="contenedorImagen" href="index.php"><img src="img/logo.png" class="logo" alt="logo"></a>
            <div class="textoEncabezado">
                <a href="historial.php" >HISTORIAL</a>
                <a href="estadisticas.php" >ESTADISTICAS</a>
            </div>
        </nav>
    </header>
    <h1>CONFIRMAR RESERVA</h1>
    <div class="contenido">
        <form method="POST" class="formularioBoleto" id="formularioBoleto" action="../control/procesar_confirmacion.php">
            <label for="pelicula">Película</label>
            <select name="pelicula" id="pelicula">
                <?php foreach ($peliculas as $pelicula): ?>
                    <option value="<?= $pelicula['pelicula_id'] ?>" data-titulo="<?= $pelicula['titulo'] ?>" data-imagen="<?= $pelicula['imagen'] ?>">
                        <?= $pelicula['titulo'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <img id="imagenPelicula" src="img/imagenNoEncontrada.png" alt="Imagen no encontrada" style="width: 200px; height: auto; display: block; margin-top: 10px;">
            <label for="cliente">Cliente</label>
            <select name="cliente" id="cliente">
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['cliente_id'] ?>" data-nombre="<?= $cliente['nombre'] ?>">
                        <?= $cliente['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="horario">Horario</label>
            <input type="time" name="horario" id="horario" required>
            <label for="sala">Sala</label>
            <input type="text" name="sala" id="sala" required>
            <label for="dia">Día</label>
            <input type="date" name="dia" id="dia" value="<?= date('Y-m-d') ?>" required>
            <input type="hidden" name="cliente_nombre" id="cliente_nombre">
            <input type="hidden" name="pelicula_titulo" id="pelicula_titulo">
        </form>
    </div>
    <div class="contenedorBoton">
        <button type="submit" form="formularioBoleto" class="botonFormulario">Confirmar Reserva</button>
    </div>
    <!-- Elemento oculto para datos de películas -->
    <div id="peliculasData" style="display: none;"><?= json_encode($peliculas) ?></div>
    <div id="peliculaSeleccionadaId" style="display: none;">null</div>
    <script src="js/confirmacionPopup.js"></script>
    <script src="js/confirmacion.js"></script>
    <script src="js/confirmacionVerificacion.js"></script>
    <script src="js/burgerMenu.js"></script>
</body>
</html>