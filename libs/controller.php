<?php 
    class Controller{
        public function __construct()
        {
            session_start();
            $this->view = new View();
            $this->view->isEmpleado = $this->isEmpleado();
        }

        public function loadModel($modelo){
            $url = "model/".$modelo."_modelo.php";
            if(file_exists($url)){
                require $url;
                $modelName = $modelo."Modelo";
                $this->modelo = new $modelName();
                $this->modelo->isEmpleado = $this->isEmpleado();
            }
        }

        public function isSubmit($form){
            if(isset($_POST[$form])){
                $this->{$form}();
            }   
        }

        public function isEmpleado(){
            $isEmpleado = false;
            if(!empty($_SESSION)){
                if($_SESSION["Perfil"] > 2){
                    $isEmpleado = true;
                }
            }

            return $isEmpleado;
        }
    }

?>