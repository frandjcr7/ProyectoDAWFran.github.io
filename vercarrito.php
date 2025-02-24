<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <section>
        <h2>Carrito de Compras</h2>

        <?php if (empty($_SESSION['carrito'])): ?>

            <p>Tu carrito está vacío.</p>

        <?php else: ?>

            <table>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>


                <?php 

                $total = 0;

                // Recorre cada producto del carrito almacenado en la sesión
                foreach ($_SESSION['carrito'] as $id => $producto): 
                    $subtotal = $producto['precio'] * $producto['cantidad']; // Calcula el subtotal para cada producto
                    $total += $subtotal;
                ?>

                    <tr>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td><?php echo number_format($producto['precio'], 2); ?>€</td> <!-- Muestra el precio del producto formateado con dos decimales -->
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td><?php echo number_format($subtotal, 2); ?>€</td> <!-- Muestra el total por ese producto (precio * cantidad) -->
                        <td><a href="carrito.php?accion=eliminar&id=<?php echo $id; ?>" class="btn">Eliminar</a></td>
                    </tr>

                <?php endforeach; ?>
            </table>

            <p><strong>Total: <?php echo number_format($total, 2); ?>€</strong></p> <!-- Muestra el total general del carrito con dos decimales -->
            <a href="carrito.php?accion=vaciar" class="btn">Vaciar Carrito</a>
            <a href="realizarcompra.php" class="btn">Pagar(PayPal o tarjeta)</a>
        <?php endif; ?>
    </section>

</body>
</html>
