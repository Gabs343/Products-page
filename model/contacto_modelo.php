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
}

?>