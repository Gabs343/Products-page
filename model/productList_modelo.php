<?php
    require_once "model/Producto.php";
    class ProductListModelo extends Model{
        public function __construct(){
            parent::__construct();
        }

        public function getFiltros($nombre){
            $filtros = [];
            try{
                $query = $this->ConsultFiltro($nombre);
                $con = $this->db->connect();
                $con = $con->query($query);

                while($row = $con->fetch(PDO::FETCH_ASSOC)){
                    array_push($filtros, $row);
                }
                return $filtros;
            }catch(PDOException $e){
                return [];
            }
        }

        private function ConsultFiltro($nombre){
            $filtro1 = $nombre;
            switch($nombre){
                case "categoria":
                    $filtro2 = "marca";
                    $filtro3 = "condicion";
                    $tabla1 = "rel_categoria_marca";
                    $tabla2 = "rel_categoria_condicion";
                    break;
                case "marca":
                    $filtro2 = "categoria";
                    $filtro3 = "condicion";
                    $tabla1 = "rel_categoria_marca";
                    $tabla2 = "rel_marca_condicion";
                    break;
                case "condicion":
                    $filtro2 = "marca";
                    $filtro3 = "categoria";
                    $tabla1 = "rel_marca_condicion";
                    $tabla2 = "rel_categoria_condicion";
                    break;
            }
            $query = "SELECT ID, Nombre FROM $filtro1";
            $firstInner = " INNER JOIN $tabla1 ON ID = $tabla1.ID_$filtro1 AND $tabla1.ID_$filtro2 = $_GET[$filtro2]";
            $secondInner = " INNER JOIN $tabla2 ON ID = $tabla2.ID_$filtro1 AND $tabla2.ID_$filtro3 = $_GET[$filtro3]";
            $where = " WHERE ID = $_GET[$filtro1]";

            if($_GET[$filtro1] != 0 && $_GET[$filtro2] != 0 && $_GET[$filtro3] != 0){
                $query = $query.$firstInner.$secondInner.$where." AND Mostrar = 1";
            }else if($_GET[$filtro1] != 0 && $_GET[$filtro2] != 0 && $_GET[$filtro3] == 0){
               $query = $query.$firstInner.$where." AND Mostrar = 1"; 
            }else if($_GET[$filtro1] != 0 && $_GET[$filtro3] != 0 && $_GET[$filtro2] == 0){
                $query = $query.$secondInner.$where." AND Mostrar = 1"; 
            }else if($_GET[$filtro2] != 0 && $_GET[$filtro3] != 0 && $_GET[$filtro1] == 0){
                $query = $query.$firstInner.$secondInner." WHERE Mostrar = 1";
            }else if($_GET[$filtro2] != 0 && $_GET[$filtro1] == 0 && $_GET[$filtro3] == 0){
                $query = $query.$firstInner." WHERE Mostrar = 1";
            }else if($_GET[$filtro3] != 0 && $_GET[$filtro2] == 0 && $_GET[$filtro1] == 0){
                $query = $query.$secondInner." WHERE Mostrar = 1";
            }else if($_GET[$filtro1] != 0 && $_GET[$filtro3] == 0 && $_GET[$filtro2] == 0){
                $query = $query.$where." AND Mostrar = 1";
            }else{
                $query = $query." WHERE Mostrar = 1";
            }
            return $query;
        }

        public function getProductos(){
            $productos = [];
            try{
                $query = "SELECT producto.ID, Nombre, ID_Marca, ID_Categoria, ID_Condicion, Precio, Activo, ruta 
                        FROM producto inner join imagen on producto.ID = imagen.ID_Producto";

                if($_GET["categoria"] != 0 && $_GET["marca"] != 0 && $_GET["condicion"] != 0){
                    $query = $query." WHERE ID_Categoria = $_GET[categoria] AND 
                                    ID_Marca = $_GET[marca] AND 
                                    ID_Condicion = $_GET[condicion]";
                }else if($_GET["categoria"] != 0 && $_GET["marca"] != 0 && $_GET["condicion"] == 0){
                    $query = $query." WHERE ID_Categoria = $_GET[categoria] AND 
                                        ID_Marca = $_GET[marca]";
                }else if($_GET["categoria"] != 0 && $_GET["condicion"] != 0 && $_GET["marca"] == 0){
                    $query = $query." WHERE ID_Categoria = $_GET[categoria] AND 
                                        ID_Condicion = $_GET[condicion]";
                }else if($_GET["marca"] != 0 && $_GET["condicion"] != 0 && $_GET["categoria"] == 0){
                    $query = $query." WHERE ID_Marca = $_GET[marca] AND 
                                        ID_Condicion = $_GET[condicion]";
                }else if($_GET["categoria"] != 0 && $_GET["marca"] == 0 && $_GET["condicion"] == 0){
                    $query = $query." WHERE ID_Categoria = $_GET[categoria]";
                }else if($_GET["marca"] != 0 && $_GET["categoria"] == 0 && $_GET["condicion"] == 0){
                    $query = $query." WHERE ID_Marca = $_GET[marca]";
                }else if($_GET["condicion"] != 0 && $_GET["categoria"] == 0 && $_GET["marca"] == 0){
                    $query = $query." WHERE ID_Condicion = $_GET[condicion]";
                }

                if(!$this->isEmpleado){
                    $query = $query." AND Activo = 1";
                }

                if($_GET["orden"] == "ASC" || $_GET["orden"] == "DESC"){
                    $query = $query." ORDER BY Nombre $_GET[orden]";
                } 

                $con = $this->db->connect();
                $con = $con->query($query);

                while($row = $con->fetch()){
                    $producto = new Producto();
                    $producto->id = $row["ID"];
                    $producto->nombre = $row["Nombre"];
                    $producto->idMarca = $row["ID_Marca"];
                    $producto->idCategoria = $row["ID_Categoria"];
                    $producto->idCondicion = $row["ID_Condicion"];
                    $producto->precio = $row["Precio"];
                    $producto->imagen = $row["ruta"];
                    $producto->active = $row["Activo"];
                    array_push($productos, $producto);
                }
                return $productos;
            }catch(PDOException $e){
                return [];
            }
        }

        public function actualizarProducto($estado){
            $exito = false;
            $query = "UPDATE producto SET Activo = $estado[Activo] WHERE ID = $estado[ID]";
            $con = $this->db->connect();
            if($con = $con->query($query)){
                $exito = true;
            }
            return $exito;
        }
    }
?>