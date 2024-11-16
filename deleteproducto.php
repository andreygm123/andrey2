<?php
include 'conexionProducto.php';

if (isset($_GET['id_producto'])) {
    $id_producto = intval($_GET['id_producto']);
    $sql = "DELETE FROM tbl_producto WHERE id_producto = $id_producto";

    if ($conexion->query($sql) === TRUE) {
        echo '<script>
                window.onload = function() {
                    Swal.fire({
                        title: "¡Buen trabajo!",
                        text: "¡Producto eliminado exitosamente!",
                        icon: "success"
                    }).then(function() {
                        window.location = "productos.php";
                    });
                };
              </script>';
    } else {
        
        echo '<script>
                window.onload = function() {
                    Swal.fire({
                        title: "¡Error!",
                        text: "No se elimino el producto.",
                        icon: "error"
                    }).then(function() {
                        window.location = "productos.php"; 
                    });
                };
              </script>';
    }
}



$conexion->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.min.css"rel="stylesheet">
    <link rel="stylesheet" href="productos.css">
    <title>Borrar Producto</title>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js"></script>

</body>
</html>

