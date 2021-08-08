<?php
    require_once("tools.php");
    require_once("session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DGamer</title>

    <!--Vincula bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!--Vincula el archivo css -->
    <link rel="stylesheet" href="public/css/main.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@1,200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;1,200&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">

    <!--Iconos de Fontawesome -->
    <script src="https://kit.fontawesome.com/cedf025736.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php constant("URL"); ?>public/js/main.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark gradiente-nav bg">
    <div class="ml-5">
        <a class="navbar-brand" href="main">
            <img src="public/img/pagina.png" width="100" alt="icono">
        </a>
    </div>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse separador-navbar" id="collapsibleNavId">
        <ul class="navbar-nav mt-1">
            <li class="nav-item">
                <a class="nav-link" href="main">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="productList?categoria=0&marca=0&condicion=0&orden=0">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contacto">Contacto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $logPage; ?>"><?php echo $log; ?></a>
            </li>
        </ul>
    </div>

</nav>

<script type="text/javascript">

$(document).ready(function(){

$('li a').filter(function(){
    return this.href==location.href}).parent().addClass('active').siblings().removeClass('active')
		$('li a').click(function(){
			$(this).parent().addClass('active').siblings().removeClass('active')	
		})
});

</script>