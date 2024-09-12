<?php
class ClienteModelo {
    private $conexion;

    public function __construct() {
        require_once('conexion.php');
        $this->conexion = Conexion::conectar();
    }

    public function insertarCliente($nombre, $correo, $telefono) {
        $sql = "INSERT INTO cliente (nombre, correo, telefono) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
        }
        $stmt->bind_param('sss', $nombre, $correo, $telefono);
        if (!$stmt->execute()) {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }
        $stmt->close();
    }

    public function obtenerClientes() {
        $sql = "SELECT * FROM cliente";
        $result = $this->conexion->query($sql);
        if (!$result) {
            throw new Exception("Error en la ejecución de la consulta: " . $this->conexion->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerCliente($cliente_id) {
        $sql = "SELECT * FROM cliente WHERE cliente_id = ?";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
        }
        $stmt->bind_param('i', $cliente_id);
        if (!$stmt->execute()) {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function actualizarCliente($cliente_id, $nombre, $correo, $telefono) {
        $sql = "UPDATE cliente SET nombre = ?, correo = ?, telefono = ? WHERE cliente_id = ?";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
        }
        $stmt->bind_param('sssi', $nombre, $correo, $telefono, $cliente_id);
        if (!$stmt->execute()) {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }
        $stmt->close();
    }

    public function eliminarCliente($cliente_id) {
        $sql = "DELETE FROM cliente WHERE cliente_id = ?";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
        }
        $stmt->bind_param('i', $cliente_id);
        if (!$stmt->execute()) {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }
        $stmt->close();
    }
}
?>