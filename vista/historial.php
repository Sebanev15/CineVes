<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HISTORIAL</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<img src="img/menu.png" onclick="burgerClick()" id="burgerImagen" alt="">
    <header>
        <nav class="mostrar">
            <div class="textoEncabezado">
                <a href="index.php" >INICIO</a>
                <a href="confirmacion.php">CONFIRMACION</a>
            </div>
            <a class="contenedorImagen" href="index.php"><img src="img/logo.png" class="logo" alt="logo"></a>
            <div class="textoEncabezado">
                <a href="historial.php" class="seleccionado" >HISTORIAL</a>
                <a href="estadisticas.php" >ESTADISTICAS</a>
            </div>
        </nav>
    </header>
    <h1>HISTORIAL DE COMPRAS</h1>
    <div class="contenido">
        <div id="historialCompras">
            <!-- El contenido se llenará con JavaScript -->
        </div>
    </div>
    <script src="js/historial.js"></script>
    <script src="js/burgerMenu.js"></script>
</body>
</html>