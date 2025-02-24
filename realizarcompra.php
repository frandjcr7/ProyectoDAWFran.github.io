<?php
// Inicia la sesión para poder acceder a las variables de sesión, como el carrito de compras
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="style.css">
    <!-- Inclusión del SDK de PayPal para el sistema de pagos -->
    <script src="https://www.paypal.com/sdk/js?client-id=AWFRtj8r4PAfb1pZubmpLeZ6NaPWhxsHBkzaor7a2uD5lrsBuZCZrQ_rC2pbGAiAGcyKGqESBJwvBCyA&currency=EUR"></script>
</head>
<body>

    <!-- Se incluye el archivo de cabecera con el encabezado del sitio -->
    <?php include 'header.php'; ?>

    <section>
        <h2>Carrito de Compras</h2>

        <!-- Si el carrito está vacío, mostramos un mensaje, de lo contrario mostramos los productos -->
        <?php if (empty($_SESSION['carrito'])): ?>
            <p>Tu carrito está vacío.</p>
        <?php else: ?>
            <!-- Se muestra una tabla con los productos del carrito -->
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
                <?php 
                $total = 0; // Inicializamos la variable que acumulará el total
                // Recorremos el carrito y calculamos el subtotal de cada producto
                foreach ($_SESSION['carrito'] as $id => $producto): 
                    $subtotal = $producto['precio'] * $producto['cantidad']; // Subtotal por producto
                    $total += $subtotal; // Sumamos el subtotal al total
                ?>
                    <tr>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td><?php echo number_format($producto['precio'], 2); ?>€</td>
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td><?php echo number_format($subtotal, 2); ?>€</td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <!-- Se muestra el total del carrito -->
            <p><strong>Total: <?php echo number_format($total, 2); ?>€</strong></p>

            <!-- Contenedor para el botón de PayPal -->
            <div id="paypal-button-container"></div>

            <script>
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
            </script>
        <?php endif; ?>
    </section>

</body>
</html>
