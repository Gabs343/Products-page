<?php require "view/header.php"; ?>
<table>
    <thead>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Correo</th>
        <th>Celular</th>
        <th>Area</th>
        <th>Mensaje</th>
    </thead>
    <tbody>
        <?php foreach($this->consultas as $clave){ ?>
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
<?php require "view/footer.php"; ?>