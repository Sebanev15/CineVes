<?php
include_once("../control/PeliculaControl.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIO</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
<img src="img/menu.png" onclick="burgerClick()" id="burgerImagen" alt="">
    <header>
        <nav class="mostrar">
            <div class="textoEncabezado">
                <a href="index.php" class="seleccionado">INICIO</a>
                <a href="confirmacion.php">CONFIRMACION</a>
            </div>
            <a class="contenedorImagen" href="index.php"><img src="img/logo.png" class="logo" alt="logo"></a>
            <div class="textoEncabezado">
                <a href="historial.php" >HISTORIAL</a>
                <a href="estadisticas.php" >ESTADISTICAS</a>
            </div>
        </nav>
    </header>
    <h1>LOS MAS VISTOS</h1>
    <div class="contenido">
        <div class="peliculas">
            <?php
            $peliculaControl = new PeliculaControl();
            try {
                $peliculasMasVistas = $peliculaControl->obtener5PeliculasMasVistas();
                foreach ($peliculasMasVistas as $pelicula) {
                    echo $peliculaControl->generarHtmlPelicula($pelicula);
                }
            } catch (Exception $e) {
                echo "<p>Error al obtener las películas más vistas: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>
    </div>
    <h1>NUESTRO CATALOGO</h1>
    <div class="contenido">
        <div class="peliculas">
            <?php
            try {
                $catalogoPeliculas = $peliculaControl->obtenerPeliculas();
                if (!empty($catalogoPeliculas)) {
                    foreach ($catalogoPeliculas as $pelicula) {
                        echo $peliculaControl->generarHtmlPelicula($pelicula);
                    }
                } else {
                    echo "<p>No hay películas disponibles en el catálogo.</p>";
                }
            } catch (Exception $e) {
                echo "<p>Error al obtener el catálogo de películas: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>
    </div>
    <script>
        // Redirigir a la página de confirmación con el ID de la película en la URL
        document.querySelectorAll('.pelicula').forEach(pelicula => {
            pelicula.addEventListener('click', function() {
                const peliculaId = this.getAttribute('data-pelicula-id');
                window.location.href = `confirmacion.php?pelicula_id=${peliculaId}`;
            });
        });
    </script>
    <script src="js/hoverImagen.js"></script>
    <script src="js/burgerMenu.js"></script>
</body>
</html>