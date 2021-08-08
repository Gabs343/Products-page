<?php 
    class View{
        function __construct()
        {
            
        }

        function render($nombre){
            require "view/".$nombre.".php";
        }

        public function tienePermiso($code){
            $doIt = false;
            foreach($_SESSION["Permisos"] as $clave){
                if($clave["Code"] == $code){
                    $doIt = true;
                    break;
                }
            }

            return $doIt;
        }
    }

?>