<?php 
    class Contacto extends Controller{
        function __construct()
        {
            parent::__construct();
        }

        function render(){
            if($this->isEmpleado()){

                $this->view->codes = $this->modelo->getPermisosCodes();
                $this->view->render("contacto/index_emp");

            }else{

                $this->view->render("contacto/index");

            }
            
        }

    }

?>