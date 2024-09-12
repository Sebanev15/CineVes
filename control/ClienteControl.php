<?php
include_once("../modelo/conexion.php");

class ClienteControl {
    public function obtenerClientes() {
        $conexion = Conexion::conectar();
        $query = "SELECT cliente_id, nombre FROM cliente";
        $resultado = $conexion->query($query);
        
        $clientes = [];
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $clientes[] = $row;
            }
        }
        
        return $clientes;
    }

    public function obtenerClientePorNombre($nombre) {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT * FROM cliente WHERE nombre = ?");
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $result = $stmt->get_result();
        $cliente = $result->fetch_assoc();
        $stmt->close();
        $conexion->close();
        return $cliente;
    }

    public function obtenerClientePorId($cliente_id) {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT * FROM cliente WHERE cliente_id = ?");
        $stmt->bind_param("i", $cliente_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $cliente = $result->fetch_assoc();
        $stmt->close();
        $conexion->close();
        return $cliente;
    }
}
?>