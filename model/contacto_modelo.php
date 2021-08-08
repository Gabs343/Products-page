<?php 
class ContactoModelo extends Model 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getConsult(){
        $consultas = [];
        
        try{
            $query = "SELECT * FROM contacto";

            $con = $this->db->connect();
            $con = $con->query($query);
                    
            while($row = $con->fetch(PDO::FETCH_ASSOC)){
                array_push($consultas, $row); 
            }
            return $consultas;
        }catch(PDOException $e){
            return [];
        }
    }

    public function insertConsulta($consulta){
        $exito = false;
        $query = "INSERT INTO contacto (nombre, apellido, email, celular, area, mensaje, fechaContacto) VALUES
                    (:nombre, :apellido, :email, :celular, :area, :mensaje, :fechaContacto)";
        $con = $this->db->connect();
        $con = $con->prepare($query);

            if($con->execute($consulta)){
                $exito = true;
            }
        return $exito;
    }
}

?>