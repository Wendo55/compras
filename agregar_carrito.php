<?php
session_start();

// Verificar si se ha enviado un nombre de producto
if (isset($_POST['producto']) && !empty($_POST['producto'])) {
    $nombre_producto = $_POST['producto'];

    // Agregar el producto al carrito de compras (simplemente lo almacenamos en una sesión en este ejemplo)
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }
    // Simplemente agregamos el nombre del producto al carrito
    array_push($_SESSION['carrito'], $nombre_producto);
}

// Redireccionar a la página de productos
header("Location: index.html");
?>
