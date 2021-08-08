<?php require "view/header.php"; ?>
<div class="container m-5">
    <h1>Consultas</h1>
    <hr class="linea">
    <table class="tabla">
        <thead>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Area</th>
            <th>Mensaje</th>
        </thead>
        <tbody>
            <?php foreach ($this->consultas as $clave) { ?>
                <tr>
                    <td><?php echo $clave["nombre"]; ?></td>
                    <td><?php echo $clave["apellido"]; ?></td>
                    <td><?php echo $clave["email"]; ?></td>
                    <td><?php echo $clave["celular"]; ?></td>
                    <td><?php echo $clave["area"]; ?></td>
                    <td><?php echo $clave["mensaje"]; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php require "view/footer.php"; ?>