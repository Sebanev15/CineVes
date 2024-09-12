<?php 
    class Conexion{
        public static function conectar(){
            $conexion = new mysqli("localhost", "root", "", "proyectoCine");
            if ($conexion->connect_errno) {
                echo ("Numero de error: ". $conexion->connect_errno . "\n");
                echo ("Error de conexión: " . $conexion->connect_error);
            }
            return $conexion;
        }
    }

?>