<?php
class PeliculaModelo {
    private $conexion;

    public function __construct() {
        require_once('conexion.php');
        $this->conexion = Conexion::conectar();
    }

    public function insertarPelicula($titulo, $director, $genero) {
        $sql = "INSERT INTO pelicula (titulo, director, genero) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
        }
        $stmt->bind_param('sss', $titulo, $director, $genero);
        if (!$stmt->execute()) {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }
        $stmt->close();
    }

    public function obtenerPeliculas() {
        $sql = "SELECT * FROM pelicula";
        $result = $this->conexion->query($sql);
        if (!$result) {
            throw new Exception("Error en la ejecución de la consulta: " . $this->conexion->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPelicula($pelicula_id) {
        $sql = "SELECT * FROM pelicula WHERE pelicula_id = ?";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
        }
        $stmt->bind_param('i', $pelicula_id);
        if (!$stmt->execute()) {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    public function tablaPeliculasMasVistas(){
        $sql = "SELECT pelicula.pelicula_id, pelicula.titulo, COUNT(detalle_boleto.detalle_id) AS cantidad_boletos 
                FROM pelicula 
                INNER JOIN detalle_boleto ON pelicula.pelicula_id = detalle_boleto.pelicula_id 
                GROUP BY pelicula.pelicula_id, pelicula.titulo 
                ORDER BY cantidad_boletos DESC";
        $result = $this->conexion->query($sql);
        if (!$result) {
            throw new Exception("Error en la ejecución de la consulta: " . $this->conexion->error);
        }
        while($pelicula = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$pelicula['titulo']."</td>";
            echo "<td>".$pelicula['cantidad_boletos']."</td>";
            echo "</tr>";
        }
    }
    public function obtener5PeliculasMasVistas() {
        $sql = "SELECT pelicula.pelicula_id, pelicula.titulo, COUNT(detalle_boleto.detalle_id) AS cantidad_boletos 
                FROM pelicula 
                INNER JOIN detalle_boleto ON pelicula.pelicula_id = detalle_boleto.pelicula_id 
                GROUP BY pelicula.pelicula_id, pelicula.titulo 
                ORDER BY cantidad_boletos DESC 
                LIMIT 5";
        $result = $this->conexion->query($sql);
        if (!$result) {
            throw new Exception("Error en la ejecución de la consulta: " . $this->conexion->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function actualizarPelicula($pelicula_id, $titulo, $director, $genero) {
        $sql = "UPDATE pelicula SET titulo = ?, director = ?, genero = ? WHERE pelicula_id = ?";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
        }
        $stmt->bind_param('sssi', $titulo, $director, $genero, $pelicula_id);
        if (!$stmt->execute()) {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }
        $stmt->close();
    }

    public function eliminarPelicula($pelicula_id) {
        $sql = "DELETE FROM pelicula WHERE pelicula_id = ?";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
        }
        $stmt->bind_param('i', $pelicula_id);
        if (!$stmt->execute()) {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }
        $stmt->close();
    }
}
?>