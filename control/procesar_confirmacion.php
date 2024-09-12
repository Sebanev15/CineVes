<?php
include_once("BoletoControl.php");
include_once("ClienteControl.php");
include_once("PeliculaControl.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Registrar los datos recibidos para depuración
    error_log(print_r($_POST, true));

    // Verificar si las claves existen en $_POST
    if (isset($_POST['cliente_id'], $_POST['cliente_nombre'], $_POST['pelicula_id'], $_POST['pelicula_titulo'], $_POST['horario'], $_POST['sala'], $_POST['dia'])) {
        // Obtener los datos de la solicitud
        $cliente_id = $_POST['cliente_id'];
        $cliente_nombre = $_POST['cliente_nombre'];
        $pelicula_id = $_POST['pelicula_id'];
        $pelicula_titulo = $_POST['pelicula_titulo'];
        $horario = $_POST['horario'];
        $sala = $_POST['sala'];
        $dia = $_POST['dia'];

        // Registrar los datos para depuración
        error_log("Datos recibidos: cliente_id=$cliente_id, cliente_nombre=$cliente_nombre, pelicula_id=$pelicula_id, pelicula_titulo=$pelicula_titulo, horario=$horario, sala=$sala, dia=$dia");

        // Buscar el cliente por ID
        $clienteControl = new ClienteControl();
        $cliente = $clienteControl->obtenerClientePorId($cliente_id);
        if (!$cliente) {
            error_log("Cliente no encontrado: " . $cliente_id);
            echo json_encode(['success' => false, 'message' => 'Cliente no encontrado.']);
            exit();
        }

        // Buscar la película por ID
        $peliculaControl = new PeliculaControl();
        $pelicula = $peliculaControl->obtenerPeliculaPorId($pelicula_id);
        if (!$pelicula) {
            error_log("Película no encontrada: " . $pelicula_id);
            echo json_encode(['success' => false, 'message' => 'Película no encontrada.']);
            exit();
        }

        // Generar el boleto
        $boletoControl = new BoletoControl();
        $resultado = $boletoControl->generarBoleto($cliente_id, $pelicula_id, $dia, $horario, $sala);

        // Registrar el resultado de la generación del boleto
        error_log("Resultado de generarBoleto: " . ($resultado ? 'éxito' : 'fallo'));

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo generar el boleto.']);
        }
    } else {
        // Registrar los datos faltantes para depuración
        $faltantes = [];
        if (!isset($_POST['cliente_id'])) $faltantes[] = 'cliente_id';
        if (!isset($_POST['cliente_nombre'])) $faltantes[] = 'cliente_nombre';
        if (!isset($_POST['pelicula_id'])) $faltantes[] = 'pelicula_id';
        if (!isset($_POST['pelicula_titulo'])) $faltantes[] = 'pelicula_titulo';
        if (!isset($_POST['horario'])) $faltantes[] = 'horario';
        if (!isset($_POST['sala'])) $faltantes[] = 'sala';
        if (!isset($_POST['dia'])) $faltantes[] = 'dia';
        error_log('Datos faltantes: ' . implode(', ', $faltantes));

        echo json_encode(['success' => false, 'message' => 'Datos incompletos.', 'faltantes' => $faltantes]);
    }
    exit();
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit();
}
?>