<?php 
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
                "mensaje" => $_POST["mensaje"] 
            );

            $exito = $this->modelo->insertConsulta($consulta);
        }

    }

?>