<?php
include_once('conexion.php');

class BoletoModelo {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function insertarBoleto($cliente_id, $dia, $horario) {
        $stmt = $this->db->prepare("INSERT INTO boleto (cliente_id, fecha_compra, hora_funcion) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $cliente_id, $dia, $horario);
        $stmt->execute();
        $boleto_id = $stmt->insert_id;
        $stmt->close();
        return $boleto_id;
    }

    public function insertarDetalleBoleto($boleto_id, $pelicula_id, $sala) {
        $stmt = $this->db->prepare("INSERT INTO detalle_boleto (boleto_id, pelicula_id, sala) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $boleto_id, $pelicula_id, $sala);
        $stmt->execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
    }
}
?>