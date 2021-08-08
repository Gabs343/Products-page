<?php 
    class Model{
        public function __construct()
        {
            $this->db = new Database();
        }

        public function getPerfil(){
            $perfil = null;
            try{
                $query = "SELECT ID_Perfil FROM cliente WHERE DNI = $_SESSION[Key]";
                $con = $this->db->connect();
                $con = $con->query($query)->fetch(PDO::FETCH_ASSOC);
                $perfil = $con["ID_Perfil"];
                return $perfil;
            }catch(PDOException $e){
                return $perfil;
            }
            
        }

        public function getPermisosCodes(){
            $codes = [];
            try{
                $query = "SELECT Code FROM permiso";
                $con = $this->db->connect();
                $con = $con->query($query);
                while($row = $con->fetch(PDO::FETCH_ASSOC)){
                    array_push($codes, $row);
                }
                return $codes;
            }catch(PDOException $e){
                return [];
            }
        }

    }

?>