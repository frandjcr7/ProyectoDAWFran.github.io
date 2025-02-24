<?php
// Incluye el archivo de cabecera con elementos comunes del sitio
require_once 'header.php';

// Incluye el archivo de configuración de la base de datos
require_once 'db_config.php';

// Comprobamos si el formulario se ha enviado mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificamos si la conexión a la base de datos está establecida
    if (!isset($conn)) {
        die("Error: No se pudo establecer la conexión a la base de datos."); // Si no hay conexión, mostramos un error
    }

    // Se sanitizan los datos recibidos del formulario para evitar inyecciones XSS
    $nombre = htmlspecialchars($_POST["nombre"]);
    $email = htmlspecialchars($_POST["email"]);
    $asunto = htmlspecialchars($_POST["asunto"]);
    $mensaje = htmlspecialchars($_POST["mensaje"]);

    try {
        // Se prepara la consulta SQL para insertar los datos del formulario en la tabla 'mensajes_contacto'
        $sql = "INSERT INTO mensajes_contacto (nombre, email, asunto, mensaje) VALUES (:nombre, :email, :asunto, :mensaje)";
        $stmt = $conn->prepare($sql);
        
        // Se vinculan los parámetros de la consulta con las variables sanitizadas
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':asunto', $asunto);
        $stmt->bindParam(':mensaje', $mensaje);

        // Ejecutamos la consulta y verificamos si la inserción fue exitosa
        if ($stmt->execute()) {
            $mensajeConfirmacion = "Gracias, $nombre. Hemos recibido tu mensaje."; // Mensaje de confirmación al usuario
        } else {
            $mensajeConfirmacion = "Hubo un error al enviar el mensaje. Por favor, inténtalo más tarde."; // Mensaje de error en caso de fallo
        }
    } catch (PDOException $e) {
        // Si ocurre un error al interactuar con la base de datos, se muestra un mensaje con el error
        echo "Error al guardar el mensaje: " . $e->getMessage();
    }
}
?>

<section>
    <h2>Contacto</h2>
    <p>¿Tienes alguna pregunta? Rellena el formulario y te responderemos pronto.</p>

    <!-- Se muestra el mensaje de confirmación si está definido -->
    <?php if (isset($mensajeConfirmacion)) : ?>
        <p class="success"><?php echo $mensajeConfirmacion; ?></p>
    <?php endif; ?>

    <!-- Formulario de contacto -->
    <form action="contacto.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto" required>

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

        <!-- Botón para enviar el formulario -->
        <button type="submit">Enviar Mensaje</button>
    </form>
</section>
