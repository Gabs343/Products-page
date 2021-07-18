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

                if(!$this->isEmpleado){
                    $query = $query." AND Activo = 1";  
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

        public function getPermisos(){
            $permisos = [];
            try{
                $query = "SELECT * FROM permiso";
                $con = $this->db->connect();
                $con = $con->query($query);

                while($row = $con->fetch(PDO::FETCH_ASSOC)){
                    array_push($permisos, $row);
                }
                return $permisos;
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

        public function actualizarCliente($perfil){
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
            $query = "INSERT INTO $nuevo[Tabla] (Nombre) VALUES (:Nombre)";
            $con = $this->db->connect();
            $con = $con->prepare($query);
            if($con->execute($nuevo)){
                $exito = true;
            }
            return $exito;
        }

        public function actualizarPerfil($perfil){
            $exito = false;
            $query = "UPDATE perfil SET Nombre = '$perfil[Nombre]' WHERE ID = $perfil[ID]";
            $con = $this->db->connect();
            if($con->query($query)){
                $exito = true;
            }
            return $exito;
        }

        public function activarPerfil($perfil){
            $exito = false;
            $query = "UPDATE perfil SET Activo = $perfil[Activo] WHERE ID = $perfil[ID]";
            $con = $this->db->connect();
            if($con->query($query)){
                $exito = true;
            }
            return $exito;
        }

        public function addPerfil($perfil){
            $exito = false;
            $query = "INSERT INTO perfil (Nombre) VALUES (:Nombre)";
            $con = $this->db->connect();
            $con = $con->prepare($query);

            if($con->execute($perfil)){
                $exito = true;
            }
            return $exito;
        }

        public function actualizarPermiso($permiso){
            $exito = false;
            $query = "UPDATE permiso SET Nombre = '$permiso[Nombre]',
                                    Code = '$permiso[Code]'
                                    WHERE ID = $permiso[ID]";
            $con = $this->db->connect();
            if($con->query($query)){
                $exito = true;
            }
            return $exito;
        }

        public function activarPermiso($permiso){
            $exito = false;
            $query = "UPDATE permiso SET Activo = $permiso[Activo] WHERE ID = $permiso[ID]";
            $con = $this->db->connect();
            if($con->query($query)){
                $exito = true;
            }
            return $exito;
        }

        public function addPermiso($permiso){
            $exito = false;
            $query = "INSERT INTO permiso (Nombre, Code) VALUES (:Nombre, :Code)";
            $con = $this->db->connect();
            $con = $con->prepare($query);

            if($con->execute($permiso)){
                $exito = true;
            }
            return $exito;
        }

        public function getPermisosPerfil($perfil){
            $permisos = []; 
            try{
                $query = "SELECT ID, Code, rel_perfil_premiso.Activo as Activo FROM permiso INNER JOIN rel_perfil_premiso
                        WHERE permiso.ID = ID_Permiso AND ID_Perfil = $perfil";
                $con = $this->db->connect();
                $con = $con->query($query);

                while($row = $con->fetch(PDO::FETCH_ASSOC)){
                    array_push($permisos, $row);
                }
                return $permisos;
            }catch(PDOException $e){
                return [];
            }
        }

        public function updatePermisosPerfil($array){
            $exito = false;         

            if(isset($array["Permiso"]) && isset($array["permisoDesc"])){
                $query = "UPDATE rel_perfil_premiso SET Activo = $array[Desactivado] WHERE ID_Perfil = $array[Perfil] AND ID_Permiso = $array[permisoDesc]";
                $con = $this->db->connect();
                $con->query($query);
            }

            $query = "UPDATE rel_perfil_premiso SET Activo = $array[Activo] WHERE ID_Perfil = $array[Perfil] AND ID_Permiso = $array[Permiso]";
            $con = $this->db->connect();
            if($con->query($query)){
                $exito = true;
            }
            return $exito;
        }

        public function setPermisoPerfil($array){
            $exito = false;
            $query = "INSERT INTO rel_perfil_premiso (ID_Perfil, ID_Permiso, Activo) VALUES (:ID_Perfil, :ID_Permiso, 0)";
            $con = $this->db->connect();
            $con = $con->prepare($query);

            if($con->execute($array)){
                $exito = true;
            }
            return $exito;
        }
    }

?>