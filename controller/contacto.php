<?php 

require_once ('tools.php');

    class Contacto extends Controller{
        function __construct()
        {
            parent::__construct();
        }

        function render(){
            if($this->isEmpleado()){
                $consultas = $this->modelo->getConsult();
                $codes = $this->modelo->getPermisosCodes();
                $this->view->codes = $codes;
                $this->view->consultas = $consultas;
                $this->view->render("contacto/index_emp");

            }else{
                $this->view->sendConsulta = $this->isSubmit("sendConsulta");
                $this->view->render("contacto/index");

            }
            
        }

        public function sendConsulta(){
            $consulta = array(
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "email" => $_POST["email"],
                "celular" => $_POST["celular"],
                "area" => $_POST["area"],
                "mensaje" => $_POST["mensaje"],
                "fechaContacto" => intval(date("YmdHis"))
            );

            $exito = $this->modelo->insertConsulta($consulta);
        }

<<<<<<< HEAD
        public function sendContacto(){
            $fecha = intval(date("YmdHis"));
            $query = "INSERT INTO contacto (nombre, apellido, email, celular, area, mensaje, fechaContacto) VALUES
            ('$_POST[nombre]', '$_POST[apellido]', '$_POST[email]', '$_POST[celular]', '$_POST[area]', '$_POST[mensaje]', $fecha)";
            $con = $this->db->connect();
            $con = $con->prepare($query);
            $mail->AddAddress('isaac.hernandez@davinci.edu.ar', $_POST["area"]);
            $mail->Send();
        }
=======
>>>>>>> main
    }

?>