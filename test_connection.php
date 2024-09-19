<?php


try {
    $conn = new PDO("sqlsrv:Server=localhost,1433;Database=prueba", "sa", "123");
    echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}


