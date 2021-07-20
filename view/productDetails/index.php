<?php require "view/header.php"; ?>

<section class="d-sm-flex product-info">
    <div>
        <h1 class="display-3 text-center"><?php echo $this->producto->nombre; ?> </h1>
        <hr class="linea">
        <p><?php TextDescription($this->producto->descripcion); ?></p>
    </div>

    <div class="product-img">
        <img src="<?php echo $this->producto->imagen; ?>" alt="" class="d-block w-100">
        <div class="shop-buttons mt-5">
            <h3>$ <?php echo $this->producto->precio; ?></h3>
            <div class="ml-5">
                <a href="">Comprar</a>
                <a href="">Añadir al carrito</a>
            </div>
        </div>
    </div>
</section>

<section class="product-details container-fluid">
    <h2 class="display-4">Características</h2>
    <hr class="linea">
    <div class="d-flex container-fluid">
        <div id="carouselProduct" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo $this->producto->imagen; ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo $this->producto->imagen; ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo $this->producto->imagen; ?>" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>

        <div class="details-list">
            <ul>
            <?php foreach($this->producto->especificaciones as $clave){ ?>
                <li><?php echo $clave["Nombre"], ": ", $clave["Descripcion"]; ?></li>       
            <?php } ?>
            </ul>
        </div>
    </div>
</section>

<section class="product-comments pb-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="display-4 comen-m">Comentarios</h2>
                <hr class="linea">
                <form action="<?php $_PHP_SELF ?>" class="row container" method="POST">
                    <div class="form-info">
                        <div>
                            <label class="form-label" for="Valoracion">Califica el producto:</label>
                            <?php for ($i = 1; $i < 6; $i++) { ?>
                                <input type="radio" class="ml-3" name="valoracion" id="Valoracion" value="<?php echo $i ?>"
                                required><?php echo $i ?></input>
                                <i class="far fa-star"></i>
                            <?php } ?>  
                        </div>
                    </div> 
                    <div class="col-12">
                        <label for="Comentario" class="form-label">Comentario:</label>
                        <textarea name="comentario" class="form-control" id="Comentario" cols="50" rows="2"
                            required></textarea>
                    </div>
                    
                    <?php foreach($this->camposDinamicos as $clave) { if($clave["Activo"]){ ?>
                        <div class="col-12">
                            <label for="campoDinamico-<?php echo $clave["ID"] ?>"><?php echo $clave["label"]; ?></label>
                            <?php if($clave["tipo"] == "select"){ ?>
                                <select name="campoDinamico-<?php echo $clave["ID"] ?>" id="">
                                    <?php foreach($clave["opcion"] as $subclave => $valor){ ?>
                                        <option value="<?php echo $valor; ?>"
                                        name="campoDinamico"
                                        <?php echo $clave["requerido"] = 1 ? "required": ""; ?>><?php echo $valor; ?></option>
                                    <?php } ?>
                                </select>
                            <?php }else{ foreach($clave["opcion"] as $subclave => $valor){ ?>
                                <input type="<?php echo $clave["tipo"]; ?>" 
                                        name="campoDinamico-<?php echo $clave["ID"] ?>"
                                        value="<?php echo $valor; ?>"
                                        <?php echo $clave["requerido"] = 1 ? "required": ""; ?>><?php echo $valor; ?></input>
                            <?php } } ?>
                        </div>
                    <?php } } ?>
                    
                    <div>
                        <input class="btn btn-primary ml-3 mt-4" type="submit" name="sendComment"
                            value="Enviar comentario">
                    </div>
                </form>
            </div>
            <div class="col">
                <div><h1 class="points"><?php echo $this->puntos; ?></h1></div>
                <div>
                    <ul>
                        <?php foreach($this->comentarios as $clave){ ?>
                            <li class="comen-muestra">
                                <?php
                                    foreach($clave as $subclave => $subvalor){
                                        if($subclave == "Valoracion"){
                                            echo $subclave, ": ";
                                            for($i = 0; $i < $subvalor; $i++){?>
                                                <i class="fas fa-star"></i>
                                            <?php } ?>
                                            <br>
                                        <?php }else if($subclave != "Mostrar" && $subclave != "ID"){
                                            if($subclave == "campo_Dinamico"){
                                                foreach($subvalor as $deepClave){
                                                    echo $deepClave["Label"], ": ", $deepClave["Valor"], "<br>";
                                                }
                                            }else{
                                                echo $subclave, ": ", $subvalor, "<br>";
                                            }
                                        }
                                    } ?>
                            </li>
                        <?php  } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require "view/footer.php"; ?>    
</body>