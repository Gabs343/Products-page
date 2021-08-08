<?php 
    class Perfil extends Controller{
        public function __construct()
        {
            parent::__construct();
        }

        public function render(){
            $info = $this->modelo->getInfo();
            $this->view->info = $info;
            $this->view->upImg = $this->isSubmit("sendImg");

            if($this->isEmpleado()){

                $this->view->codes = $this->modelo->getPermisosCodes();
                $this->view->render("perfil/index_emp");

            }else{

                $this->view->render("perfil/index");

            }
            
        }

        public function sendImg(){
            $info = $this->modelo->getInfo();
            $Imagen = $info["Imagen_Perfil"];
            unlink("public/img/avatar/".$Imagen);

            $nombrea = $_FILES["img"]["name"] ; //Guardamos el nombre del archivo
            $nombrer = strtolower($nombrea); //Convertimos las letras en miniscula
            $cd=$_FILES["img"]["tmp_name"]; //Guardamos en un fichero temporal
            $ruta = "public/img/avatar/".$nombrer;
            move_uploaded_file($_FILES["img"]["tmp_name"], $ruta);

            $this->modelo->chanImagen($nombrer);
        }
    }

?>