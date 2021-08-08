<?php 
    class Login extends Controller{
        public function __construct()
        {
            parent::__construct();
        }

        public function render(){
            $this->mensaje = "";
            $this->view->subs = $this->isSubmit("sendSubs");
            $this->view->login = $this->isSubmit("sendLog");
            $this->view->mensaje = $this->mensaje;
            $this->view->render("login/index");
        }

        public function sendSubs(){
            
            $nombrea = $_FILES["img"]["name"] ; //Guardamos el nombre del archivo
            $nombrer = strtolower($nombrea); //Convertimos las letras en minuscula
            $cd=$_FILES["img"]["tmp_name"]; //Guardamos en un fichero temporal
            $ruta = "public/img/avatar/".$nombrer;
            move_uploaded_file($_FILES["img"]["tmp_name"], $ruta);

            $datos = array(
                "DNI" => intval($_POST["pk"]),
                "Nombre" => $_POST["nombre"],
                "Apellido" => $_POST["apellido"],
                "Correo" => $_POST["correo"],
                "img" => $nombrer,
                "Pass" => password_hash($_POST["pwd"], PASSWORD_DEFAULT)
            );

            $insertar = $this->modelo->insertSubscriptor($datos);
            if (!$insertar){
                $mensaje = "no se pudo insertar el usuario";
            }else{
                $mensaje = "usuario insertado con exito"; 
            }
            $this->view->mensaje = $mensaje;
        }

        public function sendLog(){
            $datos = array(
                "Correo" => $_POST["correo"],
                "Pass" => $_POST["pwd"]
            );
            $existe = $this->modelo->findUsuario($datos); 
            if (!$existe){
                $mensaje = "no se pudo encontrar el usuario";
            }else{
                $mensaje = "login con exito";
            }
            $this->mensaje = $mensaje;
        }
    }

?>