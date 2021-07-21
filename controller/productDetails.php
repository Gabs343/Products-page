<?php 
    class ProductDetails extends Controller{
        public function __construct()
        {
            parent::__construct();
        }

        public function render(){

            if($this->isEmpleado()){

                if(isset($_GET["id"])){
                    $producto = $this->modelo->getProducto();
                    $comentarios = $this->modelo->getComments();
                    $especificaciones = $this->modelo->getEspecificaciones();
                    $camposDinamicos = $this->modelo->getCamposDinamicos();
                    $this->view->producto = $producto;
                    $this->view->comentarios = $comentarios;
                    $this->view->especificaciones = $especificaciones;
                    $this->view->camposDinamicos = $camposDinamicos;
                }
                $marcas = $this->modelo->getFiltro("marca");
                $categorias = $this->modelo->getFiltro("categoria");
                $condiciones = $this->modelo->getFiltro("condicion");
                $this->view->marcas = $marcas;
                $this->view->categorias = $categorias;
                $this->view->condiciones = $condiciones;
                $this->view->newProduct = !isset($_GET["id"]);
                $this->view->mostrarCom = $this->isSubmit("mostrarComment");
                $this->view->agregar = $this->isSubmit("agregar");
                $this->view->actualizar = $this->isSubmit("actualizar");
                $this->view->newEspec = $this->isSubmit("newEspecificacion");
                $this->view->setEspec = $this->isSubmit("editEspecificacion");
                $this->view->mostrarEspec = $this->isSubmit("mostrarEspec");
                $this->view->codes = $this->modelo->getPermisosCodes();
                $this->view->campo = $this->isSubmit("setCampo");
                $this->view->stateCampo = $this->isSubmit("stateCampo");
                $this->view->editCampo = $this->isSubmit("editCampo");
                $this->view->render("productDetails/index_emp");

            }else{

                $producto = $this->modelo->getProducto();
                $comentarios = $this->modelo->getComments();
                $camposDinamicos = $this->modelo->getCamposDinamicos();
                $puntuarProducto = $this->puntuarProducto($comentarios);
                $this->view->producto = $producto;
                $this->view->comentarios = $comentarios;
                $this->view->puntos = $puntuarProducto;
                $this->view->camposDinamicos = $camposDinamicos;
                $this->view->enviar = $this->isSubmit("sendComment");
                $this->view->render("productDetails/index");

            }
            
        }
        
        public function sendComment(){
            $datos = array(
                "ID" => intval(date("YmdHis")),
                "Comentario" => $_POST["comentario"],
                "Valoracion" => intval($_POST["valoracion"]),
                "ID_Producto" => $_GET["id"],
                "ID_Cliente" => empty($_SESSION) ? 0 : $_SESSION["Key"],
                "Ip" => gethostbyname(php_uname("n"))
            );

            foreach($_POST as $clave => $valor){
                if(str_contains($clave, "campoDinamico-")){
                    $datos[$clave] = $valor;
                }
            }

            $insertar = $this->modelo->InsertComment($datos);
            $mensaje = '';
            if (!$insertar){
                $mensaje = "no se pudo insertar el comentario";
            }else{
                $mensaje = "comentario insertado con exito"; 
            }
            $this->view->mensaje = $mensaje;
        }

        public function puntuarProducto($comentarios){
            $numeroComentarios = count($comentarios);
            $sumValor = 0;
            foreach($comentarios as $clave){
                foreach ($clave as $subclave => $subvalor) {
                    if ($subclave == "Valoracion") {
                        $sumValor += $subvalor;
                    }
                } 
            }
            $numeroComentarios == 0 ? $result = 0.0 : $result = $sumValor / $numeroComentarios;
            $result = number_format($result, 1);
            return $result;   
        }

        public function mostrarComment(){
            if($_POST["mostrarComment"] == "Activar"){
                $estado = array(
                    "ID" => intval($_POST["date"]),
                    "Mostrar" => 1 
                );
            }else if($_POST["mostrarComment"] == "Desactivar"){
                $estado = array(
                    "ID" => intval($_POST["date"]),
                    "Mostrar" => 0
                );
            }
            $exito = $this->modelo->actualizarComentario($estado);
            
            if($exito){
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

    public function actualizar(){
        $datos = array(
            "nombre" => $_POST["nombre"],
            "descripcion" => $_POST["descripcion"],
            "precio" => intval($_POST["precio"]),
            "marca" => intval($_POST["changeMarca"]),
            "condicion"  => intval($_POST["changeCondicion"]),
            "categoria" => intval($_POST["changeCategoria"])
        );
        $exito = $this->modelo->actualizarProducto($datos);
        if($exito){
            //echo "Actualizado con exito";
        }else{
            //echo "error";
        }
    }

    public function agregar(){
        $nombrea = $_FILES["imagen"]["name"] ; 
        $nombrer = strtolower($nombrea);
        $cd=$_FILES["imagen"]["tmp_name"];
        for($i = 1; ;$i++){
            if(!is_dir("public/img/".$i."/")){
                mkdir("public/img/".$i."/");
                $ruta = "public/img/".$i."/".$nombrer;
                move_uploaded_file($cd, $ruta);
                $datos = array(
                    "nombre" => $_POST["nombre"],
                    "descripcion" => $_POST["descripcion"],
                    "precio" => intval($_POST["precio"]),
                    "marca" => intval($_POST["changeMarca"]),
                    "condicion"  => intval($_POST["changeCondicion"]),
                    "categoria" => intval($_POST["changeCategoria"]),
                    "id" => intval($i),
                    "ruta" => $ruta

                );
                $insertar = $this->modelo->agregarProducto($datos);
                break;
            }
        }
    }

    public function newEspecificacion(){
        $datos = array(
            "Nombre" => $_POST["especificaciones"] == 0 ? $_POST["especificacion"] : intval($_POST["especificaciones"]),
            "Descripcion" => $_POST["descripcion"]
        );
        $insertar = $this->modelo->insertEspecificacion($datos);
        if($insertar){
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

    public function editEspecificacion(){
        $datos = array(
            "Especificacion" => intval($_POST["especificaciones"]),
            "Descripcion" => $_POST["descripcion"]
        );
        $exito = $this->modelo->updateEspecificacion($datos);
        if($exito){
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

    public function mostrarEspec(){
        if ($_POST["mostrarEspec"] == "Activar") {
            $estado = array(
                "ID_Producto" => intval($_GET["id"]),
                "ID_Espec" => intval($_POST["ID_Espec"]),
                "Mostrar" => 1 
            );
        }else if($_POST["mostrarEspec"] == "Desactivar"){
            $estado = array(
                "ID_Producto" => intval($_GET["id"]),
                "ID_Espec" => intval($_POST["ID_Espec"]),
                "Mostrar" => 0
            );
        }
        $exito = $this->modelo->mostrarEspec($estado);
        if ($exito) {
            echo "<meta http-equiv='refresh' content='0'>";
        } 
    }

    public function setCampo(){
        $campo = array(
            "label" => $_POST["label"],
            "tipo" => $_POST["tipo"],
            "requerido" => intval($_POST["requerido"]),
            "opcion" => $_POST["opcion"],
            "ID_Producto" => intval($_GET["id"])
        );
        $exito = $this->modelo->setCampoDinamico($campo);
        if($exito){
            /*echo "true";*/
        }
    }

    public function stateCampo(){
        
        if ($_POST["stateCampo"] == "Activar") {
            $estado = array(
                "ID" => intval($_POST["ID"]),
                "Activo" => 1 
            );
        }else if($_POST["stateCampo"] == "Desactivar"){
            $estado = array(
                "ID" => intval($_POST["ID"]),
                "Activo" => 0
            );
        }
        
        $exito = $this->modelo->updateStateCampo($estado);
        if ($exito) {
            echo "<meta http-equiv='refresh' content='0'>";
        } 
    }

    public function editCampo(){
        
        $datos = array(
            "ID" => intval($_POST["ID"]),
            "label" => $_POST["label"],
            "tipo" => $_POST["tipo"],
            "requerido" => intval($_POST["requerido"]),
            "opcion" => $_POST["opcion"]
        );
        var_dump($datos);
        $exito = $this->modelo->updateCampo($datos);
        if($exito){
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
    
}

?>