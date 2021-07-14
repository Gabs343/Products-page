<?php require "view/header.php"; ?>
<section class="container m-5  <?php echo $_GET["showList"] == "Clientes" ? "" : "d-none" ?>">  
<h1>Clientes</h1>
    <hr>
    <table>
        <thead>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Perfil</th>
        </thead>
        <tbody>
            <?php $cont = 0;
            foreach ($this->clientes as $clave) {
                $cont++; ?>
                <form action="<?php $_PHP_SELF; ?>" method="POST">
                    <tr>
                        <td><?php echo $clave["Nombre"]; ?></td>
                        <td><?php echo $clave["Apellido"]; ?></td>
                        <td><?php echo $clave["Correo"]; ?></td>
                        <td>
                            <?php if (isset($_POST["editarPer-" . $cont])) { ?>
                                <select name="perfiles">
                                    <?php foreach ($this->perfiles as $claveP) { ?>
                                        <option value="<?php echo $claveP["ID"]; ?>"><?php echo $claveP["Nombre"]; ?></option>
                                    <?php } ?>
                                </select> <?php } else {
                                            echo  $clave["Perfil"];
                                        } ?>
                        </td>
                        <td><?php if (isset($_POST["editarPer-" . $cont])) { ?>
                                <input type="submit" name="setPerfil" value="Confirmar">
                        </td>
                    <?php } else { ?>
                        <input type="submit" name="editarPer-<?php echo $cont; ?>" value="Editar Perfil"></td>
                    <?php } ?> </td>
                    <td><input type="hidden" name="key" value="<?php echo $clave["DNI"]; ?>"></td>
                    </tr>

                </form>
            <?php } ?>
        </tbody>
    </table>
</section>


<section class="container m-5 <?php echo $_GET["showList"] == "Perfiles" ? "" : "d-none" ?>">
    <div> 
        <h1>Perfiles</h1>
        <hr>
        <table>
            <thead>
                <th>Nombre</th>
                <th class="">Editar</th>
                <th class="">Activar/Desactivar</th>
            </thead>
            <tbody>
                <?php $cont = 0;
                foreach ($this->perfiles as $clave) {
                    $cont++; ?>
                    <form action="<?php $_PHP_SELF; ?>" method="POST">
                        <tr>
                            <td><?php if (isset($_POST["editarPer-" . $cont])) { ?>
                                <input type="text" name="nombre" placeholder="<?php echo $clave["Nombre"]; ?>" value="<?php echo $clave["Nombre"]; ?>" required>
                                <?php } else {
                                    echo $clave["Nombre"];
                                } ?>
                            </td>

                            <td class="">
                                <?php if (isset($_POST["editarPer-" . $cont])) { ?>
                                    <input type="submit" name="editPerfil" value="Confirmar">
                                    </td>
                            <?php } else { ?>
                                <input type="submit" name="editarPer-<?php echo $cont; ?>" value="Editar"></td>
                            <?php } ?> </td>

                            <td class=""> <input class="" type="submit" name="statePerfil" value="<?php echo $clave["Activo"] == 0 ? "Activar" : "Desactivar"; ?>"></td>
                        </tr>
                        <input type="hidden" name="ID" value="<?php echo $clave["ID"]; ?>">
                    </form>
                <?php } ?>
            </tbody>
        </table>

        <h3>Añadir</h3>
        <form action="<?php $_PHP_SELF; ?>" method="POST" class="">
            <label for="nombre">Nombre del Perfil:</label>
            <input type="text" name="nombre">
            <input type="submit" name="addPerfil" value="Ingresar">
        </form>
    </div>

    <div>
        <h1>Permisos</h1>
        <hr>

        <form action="<?php $_PHP_SELF; ?>" method="POST">
            
            <select name="permiso" id="">
                <?php foreach ($this->permisos as $clave) { if(isset($_POST["verPermiso"]) || isset($_POST["editarPermiso"])){ if($clave["ID"] == $_POST["permiso"]){?>
                    <option value="<?php echo $clave["ID"]; ?>"><?php echo $clave["Nombre"]; ?></option>
                <?php } }else{ ?> 
                    <option value="<?php echo $clave["ID"]; ?>"><?php echo $clave["Nombre"]; ?></option> 
                <?php } }?>    
            </select>
            <?php if(isset($_POST["verPermiso"]) || isset($_POST["editarPermiso"])){ ?> 
                <input type="submit" name="buscar" value="Buscar">
            <?php }else { ?>
                <input type="submit" name="verPermiso" value="Ver">
            <?php } ?>
            <table class="<?php echo isset($_POST["permiso"]) ? "" : "d-none"; ?>">
            <thead>
                <th>Nombre</th>
                <th>Code</th>
                <th class="">Editar</th>
                <th class="">Activar/Desactivar</th>
            </thead>
            <tbody>
                <?php if(isset($_POST["permiso"])) { foreach($this->permisos as $clave) { if($clave["ID"] == $_POST["permiso"]) {?>
                    
                        <tr>
                            <td><?php if (isset($_POST["editarPermiso"])) { ?>
                                <input type="text" name="nombre" placeholder="<?php echo $clave["Nombre"]; ?>" value="<?php echo $clave["Nombre"]; ?>">
                                <?php } else {
                                    echo $clave["Nombre"];
                                } ?>
                            </td>

                            <td><?php if (isset($_POST["editarPermiso"])) { ?>
                                <input type="text" name="code" placeholder="<?php echo $clave["Code"]; ?>" value="<?php echo $clave["Code"]; ?>">
                                <?php } else {
                                    echo $clave["Code"];
                                } ?>
                            </td>

                            <td class="">
                                <?php if (isset($_POST["editarPermiso"])) { ?>
                                    <input type="submit" name="editPermiso" value="Confirmar">
                                    </td>
                            <?php } else { ?>
                                <input type="submit" name="editarPermiso" value="Editar"></td>
                            <?php } ?> </td>

                            <td class=""> <input class="" type="submit" name="statePermiso" value="<?php echo $clave["Activo"] == 0 ? "Activar" : "Desactivar"; ?>"></td>
                        </tr>
                        <input type="hidden" name="ID" value="<?php echo $clave["ID"]; ?>">
                <?php } } } ?>    
            </tbody>
        </table>
        </form>

        <h3>Añadir</h3>
        <form action="<?php $_PHP_SELF; ?>" method="POST" class="">
            <label for="permiso">Descripción del Permiso:</label>
            <input type="text" name="descripcion">
            <label for="code">Código del Permiso:</label>
            <input type="text" name="code">
            <input type="submit" name="addPermiso" value="Ingresar">
        </form>
    </div>

</section>

<section class="container m-5 <?php echo $_GET["showList"] == "Categorias" ? "" : "d-none" ?>">
    <h1>Categorias</h1>
    <hr>
    <table>
        <thead>
            <th>Nombre</th>
            <th class="<?php echo $this->tienePermiso($this->codes[12]["Code"]) ? "" : "d-none" ?>">Editar</th>
            <th class="<?php echo $this->tienePermiso($this->codes[13]["Code"]) ? "" : "d-none" ?>">Activar/Desactivar</th>
        </thead>
        <tbody>
            <?php $cont = 0;
            foreach ($this->categorias as $clave) {
                $cont++; ?>
                <form action="<?php $_PHP_SELF; ?>" method="POST">
                    <tr>
                        <td><?php if (isset($_POST["editarCat-" . $cont])) { ?>
                                <input type="text" name="nombre" placeholder="<?php echo $clave["Nombre"]; ?>">
                            <?php } else {
                                echo $clave["Nombre"];
                            } ?>
                        </td>
                        <td class="<?php echo $this->tienePermiso($this->codes[12]["Code"]) ? "" : "d-none"; ?>">
                            <?php if (isset($_POST["editarCat-" . $cont])) { ?>
                                <input type="submit" name="cambiarFiltro" value="Confirmar">
                        </td>
                    <?php } else { ?>
                        <input type="submit" name="editarCat-<?php echo $cont; ?>" value="Editar"></td>
                    <?php } ?> </td>
                    <td class="<?php echo $this->tienePermiso($this->codes[13]["Code"]) ? "" : "d-none"; ?>"> <input class="" type="submit" name="mostrarFiltro" value="<?php echo $clave["Mostrar"] == 0 ? "Activar" : "Desactivar"; ?>"></td>
                    </tr>
                    <input type="hidden" name="ID" value="<?php echo $clave["ID"]; ?>">
                    <input type="hidden" name="tabla" value="categoria">
                </form>
            <?php } ?>
        </tbody>
    </table>
    <div class="<?php echo $this->tienePermiso($this->codes[11]["Code"]) ? "" : "d-none"; ?>">
    <h3>Añadir</h3>
    <form action="<?php $_PHP_SELF; ?>" method="POST">
        <label for="categoria">Nombre de la Categoria:</label>
        <input type="text" name="filtro">
        <input type="hidden" name="tabla" value="categoria">
        <input type="submit" name="ingresarFiltro" value="Ingresar">
    </form>
    </div>
</section>

<section class="container m-5 <?php echo $_GET["showList"] == "Marcas" ? "" : "d-none" ?>">
    <h1>Marcas</h1>
    <hr>
    <table>
        <thead>
            <th>Nombre</th>
            <th class="<?php echo $this->tienePermiso($this->codes[12]["Code"]) ? "" : "d-none"; ?>">Editar</th>
            <th class="<?php echo $this->tienePermiso($this->codes[13]["Code"]) ? "" : "d-none"; ?>">Activar/Desactivar</th>
        </thead>
        <tbody>
            <?php $cont = 0;
            foreach ($this->marcas as $clave) {
                $cont++ ?>
                <form action="<?php $_PHP_SELF; ?>" method="POST">
                    <tr>
                        <td><?php if (isset($_POST["editarM-" . $cont])) { ?>
                                <input type="text" name="nombre" placeholder="<?php echo $clave["Nombre"]; ?>">
                            <?php } else {
                                echo $clave["Nombre"];
                            } ?>
                        </td>
                        <td class="<?php echo $this->tienePermiso($this->codes[12]["Code"]) ? "" : "d-none"; ?>"><?php if (isset($_POST["editarM-" . $cont])) { ?>
                                <input type="submit" name="cambiarFiltro" value="Confirmar">
                        </td>
                    <?php } else { ?>
                        <input type="submit" name="editarM-<?php echo $cont; ?>" value="Editar"></td>
                    <?php } ?> </td>
                    <td class="<?php echo $this->tienePermiso($this->codes[13]["Code"]) ? "" : "d-none" ?>"> <input class="" type="submit" name="mostrarFiltro" value="<?php echo $clave["Mostrar"] == 0 ? "Activar" : "Desactivar"; ?>"></td>
                    </tr>
                    <input type="hidden" name="ID" value="<?php echo $clave["ID"]; ?>">
                    <input type="hidden" name="tabla" value="marca">
                </form>
            <?php } ?>
        </tbody>
    </table>
    <div class="<?php echo $this->tienePermiso($this->codes[11]["Code"]) ? "" : "d-none"; ?>">
    <h3>Añadir</h3>
    <form action="<?php $_PHP_SELF; ?>" method="POST">
        <label for="marca">Nombre de la Marca:</label>
        <input type="text" name="filtro">
        <input type="hidden" name="tabla" value="marca">
        <input type="submit" name="ingresarFiltro" value="Ingresar">
    </form>
    </div>
</section>

<section class="container m-5 <?php echo $_GET["showList"] == "Condiciones" ? "" : "d-none" ?>">
    <h1>Condiciones</h1>
    <hr>
    <table>
        <thead>
            <th>Nombre</th>
            <th class="<?php echo $this->tienePermiso($this->codes[12]["Code"]) ? "" : "d-none"; ?>">Editar</th>
            <th class="<?php echo $this->tienePermiso($this->codes[13]["Code"]) ? "" : "d-none"; ?>">Activar/Desactivar</th>
        </thead>
        <tbody>
            <?php $cont = 0;
            foreach ($this->condiciones as $clave) {
                $cont++; ?>
                <form action="<?php $_PHP_SELF; ?>" method="POST">
                    <tr>
                        <td><?php if (isset($_POST["editarCon-" . $cont])) { ?>
                                <input type="text" name="nombre" placeholder="<?php echo $clave["Nombre"]; ?>">
                            <?php } else {
                                echo $clave["Nombre"];
                            } ?>
                        </td>
                        <td class="<?php echo $this->tienePermiso($this->codes[12]["Code"]) ? "" : "d-none"; ?>">
                            <?php if (isset($_POST["editarCon-" . $cont])) { ?>
                                <input type="submit" name="cambiarFiltro" value="Confirmar">
                        </td>
                    <?php } else { ?>
                        <input type="submit" name="editarCon-<?php echo $cont; ?>" value="Editar"></td>
                    <?php } ?> </td>
                    <td class="<?php echo $this->tienePermiso($this->codes[13]["Code"]) ? "" : "d-none"; ?>"> <input type="submit" name="mostrarFiltro" value="<?php echo $clave["Mostrar"] == 0 ? "Activar" : "Desactivar"; ?>"></td>
                    </tr>
                    <input type="hidden" name="ID" value="<?php echo $clave["ID"]; ?>">
                    <input type="hidden" name="tabla" value="condicion">
                </form>
            <?php } ?>
        </tbody>
    </table>
    <div class="<?php echo $this->tienePermiso($this->codes[11]["Code"]) ? "" : "d-none"; ?>">
    <h3>Añadir</h3>
    <form action="<?php $_PHP_SELF; ?>" method="POST">
        <label for="condicion">Nombre de la Condicion:</label>
        <input type="text" name="filtro">
        <input type="hidden" name="tabla" value="condicion">
        <input type="submit" name="ingresarFiltro" value="Ingresar">
    </form>
    </div>
</section>

<?php require "view/footer.php"; ?>