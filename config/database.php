<?php

class Conexion{

    public function getConnection(){
        $SERVER = "localhost:3306";
        $USER = "root";
        $PASS = "";
        $DATABASE = "db_generate_certificate";
        try {
            $con = new mysqli($SERVER, $USER, $PASS, $DATABASE);
            //echo 'DB conected';
            return $con;
        } catch (Exception $e) {
            echo 'Error al Conectar '.$e->getMessage();
        }
    }

}

//$conexion = new Conexion();
//$conexion->getConnection();

?>