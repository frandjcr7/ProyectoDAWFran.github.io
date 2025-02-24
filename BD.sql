CREATE DATABASE IF NOT EXISTS informatica;

USE informatica;

CREATE TABLE IF NOT EXISTS mensajes_contacto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100),
    asunto VARCHAR(150),
    mensaje TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO mensajes_contacto (nombre, email, asunto, mensaje) 
VALUES ('Juan Pérez', 'juan.perez@example.com', 'Consulta sobre Hardware', 'Hola, me gustaría recibir más información sobre los componentes de hardware recomendados.');

