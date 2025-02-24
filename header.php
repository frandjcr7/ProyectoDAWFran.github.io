<?php
    require_once 'config.php';
?>

<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $sitioTitulo; ?></title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js" defer></script>
    </head>

    <body>
        <header id = "header">
            <h1><?php echo $sitioTitulo; ?></h1>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="hardware.php">Hardware</a></li>
                    <li><a href="software.php">Software</a></li>
                    <li><a href="historia.php">Historia</a></li>
                    <li><a href="tienda.php">Tienda</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <li><a href="carrito.php" class="btn">Ver mi carrito</a></li>
                </ul>
            </nav>
        </header>
