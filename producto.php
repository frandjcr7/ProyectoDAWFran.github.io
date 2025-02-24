<?php
// Se incluye el archivo de configuración para acceder a la base de datos o variables globales
require_once 'config.php';

// Definición de un arreglo asociativo con productos. Cada producto tiene un nombre, precio, imagen y descripción
$productos = [
    "teclado" => ["nombre" => "Teclado Mecánico RGB", "precio" => 49.99, "imagen" => "teclado.png", "descripcion" => "Teclado mecánico con iluminación RGB y switches mecánicos para mejor respuesta."],
    "mouse" => ["nombre" => "Mouse Gamer", "precio" => 29.99, "imagen" => "raton.jpg", "descripcion" => "Mouse gamer con DPI ajustable y diseño ergonómico para largas sesiones de juego."],
    "auriculares" => ["nombre" => "Auriculares Inalámbricos", "precio" => 59.99, "imagen" => "auriculares.png", "descripcion" => "Auriculares con sonido envolvente y cancelación de ruido para una experiencia inigualable."],
    "monitor" => ["nombre" => "Monitor 24'' Full HD", "precio" => 129.99, "imagen" => "monitor.png", "descripcion" => "Monitor de 24 pulgadas con resolución Full HD y tasa de refresco de 75Hz."],
    "poster" => ["nombre" => "Póster", "precio" => 0.01, "imagen" => "poster.png", "descripcion" => "Póster de regalo por visitar la página :) ."]
];

// Se obtiene el identificador del producto desde la URL. Si no está presente, se asigna null.
$id = $_GET['id'] ?? null;

// Verificamos si el producto existe en el arreglo, si no, mostramos un error y detenemos el script.
if (!isset($productos[$id])) {
    die("Producto no encontrado.");
}

// Se obtiene la información del producto seleccionado
$producto = $productos[$id];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Título de la página con el nombre del producto y el título del sitio -->
    <title><?php echo $producto['nombre']; ?> - <?php echo $sitioTitulo; ?></title>
    <link rel="stylesheet" href="style.css">
    <!-- Inclusión del SDK de PayPal para el sistema de pagos -->
    <script src="https://www.paypal.com/sdk/js?client-id=AWFRtj8r4PAfb1pZubmpLeZ6NaPWhxsHBkzaor7a2uD5lrsBuZCZrQ_rC2pbGAiAGcyKGqESBJwvBCyA&currency=EUR"></script>
</head>
<body>

    <!-- Se incluye el archivo de cabecera con el encabezado del sitio -->
    <?php include 'header.php'; ?>

    <section>
        <h2><?php echo $producto['nombre']; ?></h2>
        <div class="producto-detalle">
            <!-- Se muestra la imagen del producto -->
            <img src="img/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
            <!-- Descripción del producto -->
            <p><?php echo $producto['descripcion']; ?></p>
            <!-- Precio del producto, formateado con dos decimales -->
            <p class="precio"><?php echo number_format($producto['precio'], 2); ?>€</p>

            <!-- Enlace para agregar el producto al carrito -->
            <a href="carrito.php?accion=agregar&id=<?php echo $id; ?>" class="btn">Añadir al carrito</a>

            <!-- Contenedor para el botón de PayPal -->
            <div id="paypal-button-container"></div>

            <script>
                // Configuración y creación del botón de PayPal
                paypal.Buttons({
                    createOrder: function(data, actions) {
                        // Crear la orden de compra en PayPal con el precio del producto
                        return actions.order.create({
                            purchase_units: [{
                                amount: { value: "<?php echo $producto['precio']; ?>" }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        // Si el pago es aprobado, se captura la transacción y se redirige a la página de éxito
                        return actions.order.capture().then(function(details) {
                            alert("Pago exitoso: " + details.payer.name.given_name);
                            window.location.href = "pagobien.php"; // Redirige a la página de pago exitoso
                        });
                    },
                    onCancel: function(data) {
                        // Si el pago es cancelado, se redirige a la página de pago fallido
                        alert("Pago cancelado.");
                        window.location.href = "pagomal.php"; // Redirige a la página de pago fallido
                    },
                    onError: function(err) {
                        // Si hay un error en el proceso de pago, se muestra en la consola
                        console.error("Error en el pago:", err);
                    }
                }).render("#paypal-button-container"); // Renderiza el botón de PayPal en el contenedor
            </script>
        </div>
    </section>

    <!-- Enlace para volver a la tienda -->
    <a href="tienda.php" class="btn">Volver a la tienda</a>

</body>
</html>
