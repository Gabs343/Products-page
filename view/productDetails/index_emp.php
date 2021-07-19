<?php require "view/header.php"; ?>
<form action="<?php $_PHP_SELF; ?>" method="POST" enctype="multipart/form-data">

    <section class="d-sm-flex product-info">
        <div>
            <input class="display-3 text-center" name="nombre" type="text" value="<?php echo $this->newProduct ? "Nombre" : $this->producto->nombre; ?>">
            <hr class="linea">
            <p><textarea name="descripcion" id="" cols="80" rows="10" placeholder="Ingrese su Descripción"><?php echo $this->newProduct ? "Descripcion" : $this->producto->descripcion; ?></textarea></p>
            <label for="cambiarMarca">Marca:</label>
            <select name="changeMarca" id="cambiarMarca">
                <?php foreach ($this->marcas as $clave) { ?>
                    <option value="<?php echo $clave["ID"]; ?>"> <?php echo $clave["Nombre"]; ?></option>
                <?php } ?>
            </select>
            <label for="cambiarCategoria">Categoria:</label>
            <select name="changeCategoria" id="cambiarCategoria">
                <?php foreach ($this->categorias as $clave) { ?>
                    <option value="<?php echo $clave["ID"]; ?>"> <?php echo $clave["Nombre"]; ?></option>
                <?php } ?>
            </select>
            <label for="cambiarCondicion">Condicion:</label>
            <select name="changeCondicion" id="cambiarCondicion">
                <?php foreach ($this->condiciones as $clave) { ?>
                    <option value="<?php echo $clave["ID"]; ?>"> <?php echo $clave["Nombre"]; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="product-img">
            <?php if ($this->newProduct) { ?>
                <input type="file" name="imagen" id="imagen" class="insertImg">
            <?php } else { ?>
                <img src="<?php echo $this->producto->imagen; ?>" alt="" class="d-block w-100">
            <?php } ?>
            <div class="shop-buttons mt-5">
                <h3><input type="number" size="5" name="precio" placeholder="$ <?php echo $this->newProduct ? "Precio" : $this->producto->precio; ?>"></h3>
                <div class="ml-5">
                    <?php if ($this->newProduct) { ?>
                        <input type="submit" name="agregar" value="Confirmar">
                    <?php } else { ?>
                        <input type="submit" name="actualizar" value="Confirmar">
                    <?php
                    } ?>
                    <a href="productList?categoria=0&marca=0&condicion=0&orden=0">Cancelar</a>
                </div>
            </div>
        </div>
    </section>
</form>

<section class="product-details container-fluid <?php echo $this->newProduct ? "d-none" : ""; ?>">
    <h2 class="display-4">Características</h2>
    <hr class="linea">
    <form action="<?php $_PHP_SELF; ?>" method="POST">
        <table>

            <thead>
                <tr>
                    <th>Especificación</th>
                    <th>Descripción</th>
                    <th>Editar</th>
                    <th>Activar/Desactivar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$this->newProduct) {
                    $cont = 0;
                    foreach ($this->producto->especificaciones as $claveP) {
                        $cont++; ?>
                        <tr>
                            <td><?php if (isset($_POST["enviarCaract-" . $cont])) { ?>
                                    <select name="especificaciones">
                                        <?php foreach ($this->especificaciones as $clave) { ?>
                                            <option value="<?php echo $clave["ID"]; ?>"><?php echo $clave["Nombre"]; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } else {
                                    echo $claveP["Nombre"];
                                } ?>
                            </td>
                            <td><?php if (isset($_POST["enviarCaract-" . $cont])) { ?>
                                    <input type="text" name="descripcion" value="<?php echo $claveP["Descripcion"]; ?>">
                                <?php } else {
                                    echo $claveP["Descripcion"];
                                } ?>
                            </td>
                            <td><?php if (isset($_POST["enviarCaract-" . $cont])) { ?>
                                    <input type="submit" name="editEspecificacion" value="Confirmar">
                                <?php } else { ?>
                                    <input type="submit" name="enviarCaract-<?php echo $cont; ?>" value="Editar">
                            </td>
                            <td><form  method="POST">
                                <input type="hidden" name="ID_Espec" value="<?php echo $claveP["ID"];?>">
        
                                <input type="submit" name="mostrarEspec" value="<?php echo $claveP["Mostrar"] == 0 ? "Activar" : "Desactivar"; ?>">
                                </form>
                            </td>
                        <?php } ?> </td>
                        </tr>
                <?php }
                } ?>
        </table>
    </form>
    <h3>Añadir</h3>
    <form action="<?php $_PHP_SELF; ?>" method="POST">
        <select name="especificaciones">
            <?php foreach ($this->especificaciones as $clave) { ?>
                <option value="<?php echo $clave["ID"]; ?>"><?php echo $clave["Nombre"]; ?></option>
            <?php } ?>
            <option value="0">Ninguno</option>
        </select>
        <label for="especificacion">Nueva Caracteristica</label>
        <input type="text" value="especificación" name="especificacion">
        <label for="descripcion">Descripción</label>
        <input type="text" value="descripcion" name="descripcion">
        <input type="submit" name="newEspecificacion" value="Enviar">
    </form>

</section>

<section class="product-comments pb-5 <?php echo $this->newProduct || !$this->tienePermiso($this->codes[2]["Code"]) ? "d-none" : "";?>">
    <div class="container">
        <h2 class="display-4 comen-m">Comentarios</h2>
        <hr class="linea">
        <div class="row">
            <div class="col filtro">
                <ul>
                    <li><a href="#collapseMostrar" role="button" data-toggle="collapse">Mostrar</a>
                        <ul class="collapse sublist" id="collapseMostrar">
                            <li class="<?php echo isset($_GET["estado"]) ? ($_GET["estado"] == 1 ? "activeFilter" : "") : "" ?>">
                                <a href="productDetails?<?php echo "id=" . $_GET["id"] . "&estado=1" ?>">Activos</a>
                            </li>
                            <li class="<?php echo isset($_GET["estado"]) ? ($_GET["estado"] == 0 ? "activeFilter" : "") : "" ?>">
                                <a href="productDetails?<?php echo "id=" . $_GET["id"] . "&estado=0" ?>">Desactivados</a>
                            </li>
                        </ul>
                    </li>
                    <li class="filterClean">
                        <a href="productDetails?<?php echo "id=" . $_GET["id"] ?>">Limpiar Filtros</a>
                    </li>
                </ul>
        
                <h3>Campos Dinámicos</h3>
                <hr class="linea">
                
                <form action="" method="POST" class="camposDinamicos">
                    <div>
                        <label for="label">Label: </label>
                        <input type="text" name="label" id="" required>
                    </div>
                    <div>
                        <label for="tipo">Tipo de campo: </label>
                        <select name="tipo" id="">
                            <option value="select" required>Select</option>
                            <option value="checkbox" required>Checkbox</option>
                            <option value="radio" required>Radio button</option>
                        </select>
                    </div>
                    <div>
                        <label for="requerido">¿Requerido? </label>
                        <input type="radio" name="requerido" value="1" required>Si</input>
                        <input type="radio" name="requerido" value="0" required>No</input>
                    </div>
                    <div>
                        <label for="opcion">Opciones:</label>
                        <input type="text" name="opcion" id="" required>
                    </div>
                    <input type="submit" name="setCampo" value="Añadir Campo">
                </form>
            </div>
            <div class="col">
                <ul>
                    <?php foreach ($this->comentarios as $clave) { ?>
                        <li class="comen-muestra">
                            <?php
                            foreach ($clave as $subclave => $subvalor) {
                                if ($subclave == "Valoracion") {
                                    echo $subclave, ": ";
                                    for ($i = 0; $i < $subvalor; $i++) { ?>
                                        <i class="fas fa-star"></i>
                                    <?php } ?>
                                    <br>
                            <?php } else if ($subclave != "Mostrar" && $subclave != "ID") {
                                    echo $subclave, ": ", $subvalor, "<br>";
                                }
                            } ?>
                            <form action="<?php $_PHP_SELF; ?>" method="POST">
                                <input type="hidden" name="date" value="<?php echo $clave["ID"]; ?>">
                                <input type="submit" name="mostrarComment" value="<?php echo $clave["Mostrar"] == 0 ? "Activar" : "Desactivar"; ?>">
                            </form>
                        </li>
                    <?php  } ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php require "view/footer.php"; ?>