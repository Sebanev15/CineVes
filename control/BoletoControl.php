<?php
include_once('../modelo/BoletoModelo.php');

class BoletoControl {
    private $boletoModelo;

    public function __construct() {
        $this->boletoModelo = new BoletoModelo();
    }

    public function generarBoleto($cliente_id, $pelicula_id, $dia, $horario, $sala) {
        try {
            // Insertar el boleto en la tabla 'boleto'
            $boleto_id = $this->boletoModelo->insertarBoleto($cliente_id, $dia, $horario);
            
            // Verificar si el boleto se insertó correctamente
            if ($boleto_id) {
                // Insertar el detalle del boleto en la tabla 'detalle_boleto'
                $detalleInsertado = $this->boletoModelo->insertarDetalleBoleto($boleto_id, $pelicula_id, $sala);
                
                // Verificar si el detalle del boleto se insertó correctamente
                if ($detalleInsertado) {
                    return true;
                } else {
                    throw new Exception("Error al insertar el detalle del boleto.");
                }
            } else {
                throw new Exception("Error al insertar el boleto.");
            }
        } catch (Exception $e) {
            // Manejo de errores
            error_log("Error al generar boleto: " . $e->getMessage());
            return false;
        }
    }
}
?>