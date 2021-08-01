<?php 
    class Contacto extends Controller{
        function __construct()
        {
            parent::__construct();
        }

        function render(){
            if($this->isEmpleado()){
                $consultas = $this->modelo->getConsultas();
                $codes = $this->modelo->getPermisosCodes();
                $this->view->codes = $codes;
                $this->view->consultas = $consultas;
                $this->view->render("contacto/index_emp");

            }else{

                $this->view->render("contacto/index");

            }
            
        }

    }

?>