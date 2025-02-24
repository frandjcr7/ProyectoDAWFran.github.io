<?php
// Se incluyen los archivos necesarios para la configuración y el encabezado
require_once 'config.php';
require_once 'header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda - <?php echo $sitioTitulo; ?></title> <!-- Título de la página, mostrando el nombre del sitio -->
    <link rel="stylesheet" href="style.css"> <!-- Se incluye el archivo de estilo -->
</head>
<body>

    <section>
        <h2>Nuestra Tienda</h2> <!-- Título de la sección de la tienda -->
        <div class="productos">
            <?php
            // Se define un array con los productos disponibles en la tienda
            $productos = [
                ["id" => "teclado", "nombre" => "Teclado Mecánico RGB", "precio" => 49.99, "imagen" => "teclado.png", "descripcion" => "Teclado mecánico con iluminación RGB y switches mecánicos para mejor respuesta."],
                ["id" => "mouse", "nombre" => "Mouse Gamer", "precio" => 29.99, "imagen" => "raton.jpg", "descripcion" => "Mouse gamer con DPI ajustable y diseño ergonómico para largas sesiones de juego."],
                ["id" => "auriculares", "nombre" => "Auriculares Inalámbricos", "precio" => 59.99, "imagen" => "auriculares.png", "descripcion" => "Auriculares con sonido envolvente y cancelación de ruido para una experiencia inigualable."],
                ["id" => "monitor", "nombre" => "Monitor 24'' Full HD", "precio" => 129.99, "imagen" => "monitor.png", "descripcion" => "Monitor de 24 pulgadas con resolución Full HD y tasa de refresco de 75Hz."],
                ["id" => "poster", "nombre" => "Póster de informática", "precio" => 0.01, "imagen" => "poster.png", "descripcion" => "Poster gratis de regalo."],
                ["id" => "noexiste", "nombre" => "Producto no existente", "precio" => 0, "imagen" => "noexiste.png", "descripcion" => "No existe"]
            ];

            // Recorremos cada producto y lo mostramos en la página
            foreach ($productos as $producto): ?>
                <div class="producto">
                    <h3><?php echo $producto['nombre']; ?></h3> <!-- Nombre del producto -->
                    <img src="img/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>"> <!-- Imagen del producto -->
                    <p><?php echo $producto['descripcion']; ?></p> <!-- Descripción del producto -->
                    <p class="precio"><?php echo number_format($producto['precio'], 2); ?>€</p> <!-- Precio del producto -->
                    <a href="producto.php?id=<?php echo $producto['id']; ?>" class="btn">Ver más</a> <!-- Enlace para ver detalles del producto -->
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</body>
</html>
