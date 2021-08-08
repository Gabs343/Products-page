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

            if($exito){
                require_once ('config\correo_respuesta.php');
                consulta('Muchas gracias por su consulta, '.$_POST["nombre"].', ya nos contactaremos con vos.');
                $mail->AddAddress('isaac.hernandez@davinci.edu.ar');
                $mail->Send();
                //echo "<meta http-equiv='refresh' content='0'>";
            }
        }

    }

?>