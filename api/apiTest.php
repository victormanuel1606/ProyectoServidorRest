<?php

class Consultas{
    private $conexion;
    private $results;
    private $mysqli;
    
    public function __construct() {
        $this -> conexion = new Conexion();
        $this -> mysqli = $this->conexion->mysqli;
    }

    public function conectado(){
        if ($this -> mysqli -> connect_errno)
            print "ERROR AL CONECTARSE".$this-> mysqli->connect_error;
        else
            print "CONECTADO CORRECTAMENTE";
    }
    
    public function consultar(){
        $query = "SELECT * FROM ubicasion LEFT JOIN pedido ON ubicasion.idPedido = pedido.idPedido";
        $res = $this->mysqli->query($query);
        $this->results = $res->fetch_all(MYSQLI_ASSOC);
        return $this->results;
    }
    
    public function listarProveedor(){
        $query = "SELECT Proveedor FROM ubicasion "
                . "GROUP BY Proveedor ORDER BY Proveedor ASC ";
        $res = $this->mysqli->query($query);
        $this -> results = $res->fetch_all(MYSQLI_ASSOC);
        return $this->results;
    }  

    /*Agregar Generos
    y Canciones a la
    Base de Datos
    */
    public function agregar_ubicasion($idUbicasion, $Ciudad, $Proveedor, $Fecha_llegada, $idPedido){

            $query = "INSERT INTO ubicasion VALUES ('$idUbicasion','$Ciudad', '$Proveedor', '$Fecha_llegada', '$idPedido');";
            $res = $this->mysqli->query($query);
            $this->results = array("dato insertado correctamente");
            return $this->results;
    }

    public function agregar_pedido($Destino, $referencias, $Origen, $Precio, $Nombre_Cliente, $estado_pedido){

            $query = "INSERT INTO pedido (Destino, referencias, Origen, Precio, Nombre_Cliente, estado_pedido) VALUES('$Destino', '$referencias', '$Origen', '$Precio', '$Nombre_Cliente', '$estado_pedido');";
            $res = $this->mysqli->query($query);
            $this->results = array("dato insertado correctamente");
            return $this->results;
        
    } 

/*
listarGeneros
ennumerarCanciones
listar_canciones_por_genero
*/
    public function listarPedidos()
    {
        $query = "SELECT * FROM pedido";
        $res = $this->mysqli->query($query);
        $this->results = $res->fetch_all(MYSQLI_ASSOC);
        return $this->results;
    }

    public function ennumerarUbicaciones($gender)
    {
        $query = $query = "SELECT * FROM ubicasion where idPedido = $gender";
        $res = $this->mysqli->query($query);
        $this->results = $res->num_rows;
        $array = array($this->results);
        //$this->results = $res->fetch_all(MYSQLI_ASSOC);
        return $array;
    }

    public function listar_ubicaciones_por_pedido($idPedido)
    {
        $query = $query = "SELECT * FROM ubicasion where idPedido = $idPedido";
        $res = $this->mysqli->query($query);

        $this->results = $res->fetch_all(MYSQLI_ASSOC);
        return $this->results;
    }

    
}

//$miConsulta = new Consultas();
//$miConsulta->consultar();

