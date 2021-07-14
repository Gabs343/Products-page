<?php require "view/header.php";?>
<section class="container-fluid d-flex mt-5 seccion-productos">
<div class="filtro">
    <div>
        <ul>
            <li><a href="#collapse_Categoria" role="button" data-toggle="collapse">Categoria</a>
                <ul class="collapse sublist" id="collapse_Categoria">
                    <?php foreach($this->categorias as $clave){ ?>
                        <li class="<?php echo $clave["ID"] == $_GET["categoria"] ? "activeFilter" : ""; ?>">
                            <a href="productList?<?php echo "categoria=".$clave["ID"].
                                                        "&marca=".$_GET["marca"].
                                                        "&condicion=".$_GET["condicion"].
                                                        "&orden=".$_GET["orden"];?>">
                            <?php echo $clave["Nombre"];?></a> 
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li><a href="#collapse_Marca" role="button" data-toggle="collapse">Marca</a>
                <ul class="collapse sublist" id="collapse_Marca">
                    <?php foreach($this->marcas as $clave){ ?>
                        <li class="<?php echo $clave["ID"] == $_GET["marca"] ? "activeFilter" : ""; ?>">
                            <a href="productList?<?php echo "categoria=".$_GET["categoria"].
                                                        "&marca=".$clave["ID"].
                                                        "&condicion=".$_GET["condicion"].
                                                        "&orden=".$_GET["orden"];?>">
                            <?php echo $clave["Nombre"];?></a> 
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li><a href="#collapse_Condicion" role="button" data-toggle="collapse">Condicion</a>
                <ul class="collapse sublist" id="collapse_Condicion">
                    <?php foreach($this->condiciones as $clave){ ?>
                        <li class="<?php echo $clave["ID"] == $_GET["condicion"] ? "activeFilter" : ""; ?>">
                            <a href="productList?<?php echo "categoria=".$_GET["categoria"].
                                                        "&marca=".$_GET["marca"].
                                                        "&condicion=".$clave["ID"].
                                                        "&orden=".$_GET["orden"];?>">
                            <?php echo $clave["Nombre"];?></a> 
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li><a href="#collapse_Orden" role="button" data-toggle="collapse">Orden</a>
                <ul class="collapse sublist" id="collapse_Orden">
                    <li class="<?php echo "ASC" == $_GET["orden"] ? "activeFilter" : ""; ?>">
                        <a href="productList?<?php echo "categoria=".$_GET["categoria"].
                                                        "&marca=".$_GET["marca"].
                                                        "&condicion=".$_GET["condicion"];?>
                                                        &orden=ASC">Ascendente</a>
                    </li>
                    <li class="<?php echo "DESC" == $_GET["orden"] ? "activeFilter" : ""; ?>">
                        <a href="productList?<?php echo "categoria=".$_GET["categoria"].
                                                        "&marca=".$_GET["marca"].
                                                        "&condicion=".$_GET["condicion"];?>
                                                        &orden=DESC">Descendente</a>
                    </li>
                </ul>
            </li>

            <li class="filterClean">
                <a href="productList?categoria=0&marca=0&condicion=0&orden=0">Limpiar Filtros</a>
            </li>
            <li class = "<?php echo $this->tienePermiso($this->codes[5]["Code"]) ? "" : "d-none"; ?>">
                <a href="productDetails">Añadir Producto</a>
            </li>
        </ul>
    </div>
</div>

<div class="row row-cols-6">
    <?php  foreach($this->productos as $clave){ $producto = $clave; ?>
        <div class="col index-product card">
            <img src="<?php echo $producto->imagen; ?>" alt="First slide" class="w-100">
            <div class="card-body">
                <h5 class="etiqueta-nombre mt-2"><?php echo $producto->nombre; ?></h5>
                <p class="etiqueta-nombre mb-0"><?php echo "$ ", $producto->precio; ?></p>
                <div class="action-link"> 
                    <form action="<?php $_PHP_SELF;?>" method="POST">
                        <a class="<?php echo $this->tienePermiso($this->codes[4]["Code"]) ? "" : "d-none"; ?>" href="productDetails?id=<?php echo $producto->id; ?>">Editar</a>
                        <input type="hidden" name="ID" value="<?php echo $producto->id; ?>">
                        <input class="<?php echo $this->tienePermiso($this->codes[6]["Code"]) ? "" : "d-none"; ?>" type="submit" name="mostrarProducto" value="<?php echo $producto->active == 0 ? "Activar" : "Desactivar"; ?>">
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
</section>
<?php require "view/footer.php"; ?>