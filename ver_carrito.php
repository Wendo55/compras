<?php
session_start();

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "password", "productos");

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Verificar si existen productos en el carrito
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    echo "<h1>Carrito de Compras</h1>";

    echo "<ul>";
    foreach ($_SESSION['carrito'] as $nombre_producto) {
        // Escapar caracteres especiales para evitar inyección de SQL
        $nombre_producto = mysqli_real_escape_string($conexion, $nombre_producto);
        
        // Consulta para obtener los detalles del producto
        $query = "SELECT nombre, precio FROM productos WHERE nombre = '$nombre_producto'";
        $result = mysqli_query($conexion, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>{$row['nombre']} - {$row['precio']}</li>";
            }
        }
    }
    echo "</ul>";
} else {
    echo "<p>El carrito de compras está vacío.</p>";
}

// Cerrar conexión
mysqli_close($conexion);
?>
