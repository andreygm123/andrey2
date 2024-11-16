<?php
include 'conexionProducto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $contraseña = $_POST['contraseña'];
    $correo_electronico = $_POST['correo_electronico'];

    $sql = "INSERT INTO tbl_usuarios (username, contraseña, correo_electronico) 
            VALUES ('$username', '$contraseña', '$correo_electronico')";

    if ($conexion->query($sql) === TRUE) {
        
        echo '<script>
                window.onload = function() {
                    Swal.fire({
                        title: "¡Buen trabajo!",
                        text: "¡Usuario insertado exitosamente!",
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
                        text: "No se insertó el usuario.",
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
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.min.css"rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
   
    
</head>
<body>
<form action="regis_usuario.php" method="POST" class="container mt-5 p-4 border rounded shadow-lg">
    <h2 class="text-center mb-4">Iniciar Sesión</h2>
    
    <div class="mb-3">
        <label for="username" class="form-label">Nombre de usuario</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Introduce tu nombre de usuario" required>
    </div>
    
    <div class="mb-3">
        <label for="contraseña" class="form-label">Contraseña</label>
        <input type="password" name="contraseña" id="contraseña" class="form-control" placeholder="Introduce tu contraseña" required>
    </div>
    
    <div class="mb-3">
        <label for="correo_electronico" class="form-label">Correo electrónico</label>
        <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" placeholder="Introduce tu correo electrónico" required>
    </div>
    
    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
</form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js"></script>
</body>
</html>










