<?php

class GestionAutomovilesAuth {

    public function ConectarMarcas() {
        try {
            $user = "epiz_31283577";  // usuario con el que se va conectar con MySQL
            $pass = "v45ZVIqmHPYfFu";  // contraseña del usuario
            $dbname = "epiz_31283577_coches";  // nombre de la base de datos
            $host = "sql205.epizy.com";  // nombre o IP del host

            $db = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);  //conectar con MySQL y SELECCIONAR LA Base de Datos
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //Manejo de errores con PDOException
            echo "<p>Se ha conectado a la BD $dbname.</p>\n";
            return $db;
        } catch (PDOException $e) {  // Si hubieran errores de conexión, se captura un objeto de tipo PDOException
            print "<p>Error: No se pudo conectar con la BD $dbname.</p>\n";
            print "<p>Error: " . $e->getMessage() . "</p>\n";  // mensaje de excepción

            exit();  // terminar si no hay conexión $db
        }
    }

    public function ObtenerMarcas() {
        $con = $this->ConectarMarcas();

        $marcas = array();
        if ($con) {
            $result = $con->query('select id, marca from marcas');

            while ($row = $result->fetch(PDO::FETCH_ASSOC))
                $marcas[$row['id']] = $row['marca'];
        }
        return $marcas;
    }

    public function ObtenerModelos($marca) {
        $marca = intVal($marca);
        $modelos = array();

        if ($marca !== 0) {
            $con = $this->ConectarMarcas();
            $con->query("SET CHARACTER SET utf8");

            if ($con) {
                $result = $con->query('select id, modelo from modelos ' .
                    'where marca = ' . $marca);

                while ($row = $result->fetch(PDO::FETCH_ASSOC))
                    $modelos[$row['id']] = $row['modelo'];
            }
        }

        return $modelos;
    }

    public static function authenticate($header_params) {

        if($header_params->username == 'ies' && $header_params->password == 'daw') {
            return true;
        }

        else throw new SoapFault('Wrong user/pass combination', 401);
    }

    public function ObtenerMarcasUrl(){
        $con = $this->ConectarMarcas();

        $marcas = array();
        if ($con) {
            $result = $con->query('select url, marca from marcas');

            while ($row = $result->fetch(PDO::FETCH_ASSOC))
                $marcas[$row['marca']] = $row['url'];
        }
        return $marcas;
    }

    public function ObtenerModelosPorMarca($marca){
        $modelos = array();

        if ($marca) {

            $con = $this->ConectarMarcas();

            $con->query("SET CHARACTER SET utf8");

            if ($con) {

                $result = $con->query('select modelos.id, modelos.modelo from modelos join marcas on lower(marcas.marca)=\''. $marca . '\' WHERE marcas.id=modelos.marca');

                while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $modelos[$row['id']] = $row['modelo'];
                }

            }
        }
        return $modelos;
    }
}