<?php
// Iniciar sesión para mantener los datos del carrito entre páginas
session_start();

// Si el carrito no está definido en la sesión, lo inicializamos como un array vacío
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Obtener la acción que se va a realizar (agregar, eliminar, vaciar) desde la URL
$accion = $_GET['accion'] ?? null;

// Definir los productos disponibles en la tienda (esto podría venir de una base de datos)
$productos = [
    "teclado" => ["nombre" => "Teclado Mecánico RGB", "precio" => 49.99, "imagen" => "teclado.png"],
    "mouse" => ["nombre" => "Mouse Gamer", "precio" => 29.99, "imagen" => "raton.jpg"],
    "auriculares" => ["nombre" => "Auriculares Inalámbricos", "precio" => 59.99, "imagen" => "auriculares.png"],
    "monitor" => ["nombre" => "Monitor 24'' Full HD", "precio" => 129.99, "imagen" => "monitor.png"],
    "poster" => ["nombre" => "Póster de informática", "precio" => 0.01, "imagen" => "poster.png"]
];

// Si la acción es agregar un producto al carrito
if ($accion == "agregar") {
    // Obtener el ID del producto desde la URL
    $id = $_GET['id'] ?? null;

    // Verificar que el producto existe en la lista de productos
    if (isset($productos[$id])) {
        // Si el producto ya está en el carrito, aumentar la cantidad
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad']++;
        } else {
            // Si no está en el carrito, agregarlo con cantidad 1
            $_SESSION['carrito'][$id] = $productos[$id];
            $_SESSION['carrito'][$id]['cantidad'] = 1;
        }
    }
}

// Si la acción es eliminar un producto del carrito
if ($accion == "eliminar") {
    // Obtener el ID del producto desde la URL
    $id = $_GET['id'] ?? null;

    // Verificar si el producto está en el carrito y eliminarlo
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
    }
}

// Si la acción es vaciar el carrito por completo
if ($accion == "vaciar") {
    // Se elimina todo el contenido del carrito estableciendo el array vacío
    $_SESSION['carrito'] = [];
}

// Redirigir a la página del carrito después de realizar la acción
header("Location: vercarrito.php");
exit;
?>
