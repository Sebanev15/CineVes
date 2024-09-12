<?php
include_once('../modelo/PeliculaModelo.php');

class PeliculaControl {
    private $peliculaModelo;

    public function __construct() {
        $this->peliculaModelo = new PeliculaModelo();
    }

    public function insertarPelicula($titulo, $director, $genero) {
        try {
            $this->peliculaModelo->insertarPelicula($titulo, $director, $genero);
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al insertar película: " . $e->getMessage();
        }
    }

    public function obtenerPeliculas() {
        try {
            $peliculas = $this->peliculaModelo->obtenerPeliculas();
            foreach ($peliculas as &$pelicula) {
                $imagen = 'img/' . $pelicula['titulo'] . '.png';
                $pelicula['imagen'] = file_exists($imagen) ? $imagen : 'img/imagenNoEncontrada.png';
            }
            return $peliculas;
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al obtener películas: " . $e->getMessage();
            return [];
        }
    }

    public function mostrarPeliculas() {
        try {
            $peliculas = $this->obtenerPeliculas();
            foreach ($peliculas as $pelicula) {
                echo $this->generarHtmlPelicula($pelicula);
            }
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al mostrar películas: " . $e->getMessage();
        }
    }

    public function obtener5PeliculasMasVistas() {
        try {
            $peliculas = $this->peliculaModelo->obtener5PeliculasMasVistas();
            if (!$peliculas) {
                return [];
            }
            return array_slice($peliculas, 0, 5);
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al obtener las 5 películas más vistas: " . $e->getMessage();
            return [];
        }
    }

    public function tablaPeliculasMasVistas(){
        try {
            $peliculas = $this->peliculaModelo->tablaPeliculasMasVistas();
            if (!$peliculas) {
                return [];
            }
            return $peliculas;
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al obtener las películas más vistas: " . $e->getMessage();
            return [];
        }
    }
    public function obtenerPelicula($pelicula_id) {
        try {
            return $this->peliculaModelo->obtenerPelicula($pelicula_id);
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al obtener película: " . $e->getMessage();
            return null;
        }
    }

    public function obtenerPeliculaPorTitulo($titulo) {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT * FROM pelicula WHERE titulo = ?");
        $stmt->bind_param("s", $titulo);
        $stmt->execute();
        $result = $stmt->get_result();
        $pelicula = $result->fetch_assoc();
        $stmt->close();
        $conexion->close();
        return $pelicula;
    }

    public function obtenerPeliculaPorId($pelicula_id) {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT * FROM pelicula WHERE pelicula_id = ?");
        $stmt->bind_param("i", $pelicula_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $pelicula = $result->fetch_assoc();
        $stmt->close();
        $conexion->close();
        return $pelicula;
    }

    public function actualizarPelicula($pelicula_id, $titulo, $director, $genero) {
        try {
            $this->peliculaModelo->actualizarPelicula($pelicula_id, $titulo, $director, $genero);
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al actualizar película: " . $e->getMessage();
        }
    }

    public function eliminarPelicula($pelicula_id) {
        try {
            $this->peliculaModelo->eliminarPelicula($pelicula_id);
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al eliminar película: " . $e->getMessage();
        }
    }

    public function generarHtmlPelicula($pelicula) {
        $imagen = 'img/' . $pelicula['titulo'] . '.png';
        $imagenSrc = file_exists($imagen) ? $imagen : 'img/imagenNoEncontrada.png';
        $html = "<div class='pelicula'>
                    <img src='$imagenSrc' id='" . $pelicula["pelicula_id"] . "' alt='" . $pelicula["titulo"] . "'>
                    <div class='hover'>
                        <div class='tituloPelicula'>" . $pelicula["titulo"] . "</div>
                        <a href='confirmacion.php?pelicula_id=" . $pelicula["pelicula_id"] . "' class='botonReserva'>Reservar</a>
                    </div>
                </div>";
        return $html;
    }
}
?>