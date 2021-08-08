<?php
    require_once "model/Producto.php";
    class MainModelo extends Model{
        public function __construct(){
            parent::__construct();
        }

        public function getProductos($condicion){
            $productos = [];
            try{
                $query = "SELECT producto.ID, producto.Nombre, Precio, ruta FROM producto
                inner join imagen on producto.ID = imagen.ID_Producto
                inner join condicion ON ID_Condicion = condicion.ID
                WHERE condicion.Nombre = '$condicion'";

                if(empty($_SESSION)){
                    $query = $query." AND Activo = 1";
                }else{
                    if($_SESSION["Perfil"] <= 2){
                        $query = $query." AND Activo = 1";    
                    }
                }
                $con = $this->db->connect();
                $con = $con->query($query);
                
                while($row = $con->fetch()){
                    $producto = new Producto();
                    $producto->id = $row["ID"];
                    $producto->nombre = $row["Nombre"];
                    $producto->precio = $row["Precio"];
                    $producto->imagen = $row["ruta"];
                    array_push($productos, $producto);
                }
                return $productos;
            }catch(PDOException $e){
                return [];
            }
        }

        public function getBanners(){
            $banners = [];
            try{
                $query = "SELECT ruta FROM banners";
                $con = $this->db->connect();
                $con = $con->query($query);
                while($row = $con->fetch()){
                    $banner = $row["ruta"];
                    array_push($banners, $banner);
                }
                return $banners;
            }catch(PDOException $e){
                return [];
            }
        }

        public function getClientes(){
            $clientes = [];
            try{
                $query = "SELECT DNI, cliente.Nombre, Apellido, Correo, perfil.Nombre AS Perfil FROM cliente
                            INNER JOIN perfiL WHERE ID_Perfil = perfil.ID";
                $con = $this->db->connect();
                $con = $con->query($query);

                while($row = $con->fetch(PDO::FETCH_ASSOC)){
                    array_push($clientes, $row);
                }
                return $clientes;
            }catch(PDOException $e){
                return [];
            }
        }

        public function getPerfiles(){
            $perfiles = [];
            try{
                $query = "SELECT * FROM perfil";
                $con = $this->db->connect();
                $con = $con->query($query);

                while($row = $con->fetch(PDO::FETCH_ASSOC)){
                    array_push($perfiles, $row);
                }
                return $perfiles;
            }catch(PDOException $e){
                return [];
            }
        }

        public function getFiltro($filtro){
            $filtros = [];
            try{    
                $query = "SELECT * FROM $filtro";
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

        public function actualizarPerfil($perfil){
            $exito = false;
            $query = "UPDATE cliente SET ID_Perfil = $perfil[perfil] WHERE DNI = $perfil[key]";
            $con = $this->db->connect();
            try{
                if($con->query($query)){
                    $exito = true;
                }
            }catch(PDOException $e){
                return $exito;
            }
            return $exito;
        }

        public function mostrarFiltro($estado){
            $exito = false;
            $query = "UPDATE $estado[Tabla] SET Mostrar = $estado[Activo] WHERE ID = $estado[ID]";
            $con = $this->db->connect();
            if($con = $con->query($query)){
                $exito = true;
            }
            return $exito;
        }

        public function cambiarFiltro($nombre){
            $exito = false;
            $query = "UPDATE $nombre[Tabla] SET Nombre = '$nombre[Nombre]' WHERE ID = $nombre[ID]";
            $con = $this->db->connect();
            if($con->query($query)){
                $exito = true;
            }
            return $exito;
        }

        public function nuevoFiltro($nuevo){
            $exito = false;
            $query = "INSERT INTO $nuevo[Tabla] (Nombre) VALUES ('$nuevo[Nombre]')";
            $con = $this->db->connect();
            if($con->query($query)){
                $exito = true;
            }
            return $exito;
        }
    }

?>