<?php 
class ContactoModelo extends Model 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCorreos() {
        $correos = [];
        try {
            $query = "SELECT * FROM contacto";
            $con = $this->db->connect();
            $con = $con->query($query);

            while($row = $con->fetch(PDO::FETCH_ASSOC)){
                array_push($correos, $row);
            }
            return $correos;
        } catch (PDOException $e){
            return [];
        }
    }
}

?>