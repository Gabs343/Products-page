<?php
    require_once "model/Producto.php";
    class ProductDetailsModelo extends Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function getProducto(){
            $producto = null;
            try{
                $query = "SELECT producto.ID, producto.Nombre, Precio,
                 producto.Descripcion, Ruta, marca.Nombre AS Nombre_Marca
                            FROM producto
                            join marca
                            inner join imagen on producto.ID = imagen.ID_Producto
                            WHERE producto.ID = $_GET[id]";
                $con = $this->db->connect();
                $con = $con->query($query)->fetch();
                
                $producto = new Producto();
                $producto->id = $con["ID"];
                $producto->nombre = $con["Nombre"];
                $producto->precio = $con["Precio"];
                $producto->marca = $con["Nombre_Marca"];
                $producto->descripcion = $con["Descripcion"];
                $producto->imagen = $con["Ruta"];

                $especificaciones = array();

                $query = "SELECT especificacion.Nombre, esp_descripcion.Descripcion FROM esp_descripcion
                INNER JOIN especificacion ON especificacion.ID = ID_Especificacion 
                WHERE ID_Producto =  $_GET[id]";

                $con = $this->db->connect();
                $con = $con->query($query);   
                
                while($row = $con->fetch()){
                    array_push($especificaciones, $row);
                }

                $producto->especificaciones = $especificaciones;

                return $producto;
            }catch(PDOException $e){
                return $producto;
            }
        }

        public function InsertComment($datos){
            $query = "INSERT INTO comentario (ID, Comentario, Valoracion, Fecha, ID_Producto, ID_Cliente, Ip, Mostrar) VALUES
                        (:ID, :Comentario, :Valoracion, now(), :ID_Producto, :ID_Cliente, :Ip, 0)";
            $con = $this->db->connect();
            $con = $con->prepare($query);

            if($con->execute($datos)){
                return true;
            }else{
                return false;
            }
        }

        public function getComments(){
            $comentarios = [];
            try{
                $query = "SELECT ID, cliente.Nombre, Comentario, Valoracion, Fecha, Mostrar FROM comentario
                        INNER JOIN cliente ON ID_Cliente = cliente.DNI 
                        WHERE ID_Producto =  $_GET[id]";

                if(empty($_SESSION)){
                    $query = $query." AND Mostrar = 1";
                }else{
                    if($_SESSION["Perfil"] <= 2){
                        $query = $query." AND Mostrar = 1";    
                    }else{
                        if(isset($_GET["estado"])){
                            $query = $query." AND Mostrar = $_GET[estado]";
                        }                    
                    }
                }
                $con = $this->db->connect();
                $con = $con->query($query);

                while($row = $con->fetch(PDO::FETCH_ASSOC)){
                    array_push($comentarios, $row);
                }
                return $comentarios;
            }catch(PDOException $e){
                return [];
            }

        }
        public function getFiltro($filtro){
            $filtros = [];
            try{    
                $query = "SELECT $filtro.ID, $filtro.Nombre FROM $filtro";
                $con = $this->db->connect();
                $con = $con->query($query);

                while($row = $con->fetch(PDO::FETCH_ASSOC)){
                    array_push($filtros, $row);
                }
                return $filtros;
            }catch(PDOException $e){
                return [];
            }
        }

        public function actualizarComentario($estado){  
            $exito = false;
            $query = "UPDATE comentario SET Mostrar = $estado[Mostrar] WHERE ID = $estado[ID]";
            $con = $this->db->connect();
            if($con = $con->query($query)){
                $exito = true;
            }
            return $exito;
        }

        public function actualizarProducto($datos){
            $exito = false;
            $query = "UPDATE producto SET Nombre = '$datos[nombre]', 
                                        Descripcion = '$datos[descripcion]',
                                        Precio = $datos[precio],
                                        ID_Marca = $datos[marca],
                                        ID_Categoria = $datos[categoria],
                                        ID_Condicion = $datos[condicion]
                    WHERE ID = $_GET[id]";
            $con = $this->db->connect();
            if($con->query($query)){
                $exito = true;
            }
            return $exito;
        }
// AGREGANDO AGREGAR PRODUCTOS
        public function agregarProducto($datos){
            $query = "INSERT INTO producto (ID, Nombre, Precio, Descripcion, ID_Marca, ID_Categoria, ID_Condicion)
            VALUES (:id, :nombre, :precio, :descripcion, :marca, :categoria, :condicion)";
            $con = $this->db->connect();
            $con = $con->prepare($query);

            if($con->execute($datos)){
                return true;
            }else{
                return false;
            }
        }
    }
?>