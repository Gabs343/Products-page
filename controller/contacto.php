<?php 

require_once ('tools.php');

    class Contacto extends Controller{
        function __construct()
        {
            parent::__construct();
        }

        function render(){
            $this->view->render("contacto/index");
        }

        public function renderForEmpleados(){
            $this->view->render("contacto/index_emp");
        }

        public function sendContacto(){
            $fecha = intval(date("YmdHis"));
            $query = "INSERT INTO contacto (nombre, apellido, email, celular, area, mensaje, fechaContacto) VALUES
            ('$_POST[nombre]', '$_POST[apellido]', '$_POST[email]', '$_POST[celular]', '$_POST[area]', '$_POST[mensaje]', $fecha)";
            $con = $this->db->connect();
            $con = $con->prepare($query);
            $mail->AddAddress('isaac.hernandez@davinci.edu.ar', $_POST["area"]);
            $mail->Send();
        }
    }

?>