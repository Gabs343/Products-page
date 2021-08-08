<?php
    class LoginModelo extends Model{
        public function __construct()
        {
            parent::__construct();
        }

        public function insertSubscriptor($datos){
            $query = "INSERT INTO cliente (DNI, Nombre, Apellido, Correo, Contraseña, ID_Perfil, Imagen_Perfil) VALUES
            (:DNI, :Nombre, :Apellido, :Correo, :Pass, 2, :img)";
            $con = $this->db->connect();
            $con = $con->prepare($query);

            if($con->execute($datos)){
                return true;
            }else{
                return false;
            }
        }

        public function findUsuario($datos){
            $existe = false;
            try{
                $query = "SELECT COUNT(*) as existe FROM cliente 
                        WHERE Correo = '$datos[Correo]'";
                $con = $this->db->connect();
                $con = $con->query($query)->fetch();
                if(intval($con["existe"])){
                    $query = "SELECT DNI, Nombre, Contraseña, ID_Perfil FROM cliente WHERE Correo = '$datos[Correo]'";
                    $con = $this->db->connect();
                    $array = $con->query($query)->fetchAll(PDO::FETCH_ASSOC);
                    foreach($array as $clave){
                        if(password_verify($datos["Pass"], $clave["Contraseña"])){      
                            $existe = true;
                            $_SESSION["Key"] = $clave["DNI"];
                            $_SESSION["Nombre"] = $clave["Nombre"];
                            $_SESSION["Perfil"] = $clave["ID_Perfil"];
                            $query = "SELECT Code FROM permiso
                                    INNER JOIN rel_perfil_premiso as rpp WHERE permiso.ID = ID_Permiso AND ID_Perfil = $clave[ID_Perfil] AND rpp.Activo = 1";
                            $con = $this->db->connect();
                            $array = $con->query($query)->fetchAll(PDO::FETCH_ASSOC);
                            $_SESSION["Permisos"] = $array;
                            header("location: perfil");
                        }    
                    }    
                }
                return $existe;
            }catch(PDOException $e){
                return $existe;
            }
        }
    }
?>