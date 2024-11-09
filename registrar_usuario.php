<?php
include 'conexionProducto.php';
if ($_SERVER['REQUEST_METHOD']=== 'POST'){
    $username = $_POST ['username'];
    $contraseña = $_POST['contraseña'];
    $correo_electronico = $_POST['correo_electronico'];

    $sql = "INSERT INTO tbl_usuario (id_usuario, contraseña, correo_electronico) 
    VALUES ('$id_usuario','$contraseña','$correo_electronico','$id_vendedor','$valor_venta','$fecha_ulti_venta')";

}


$cifrado = password_hash($password,PASSWORD_DEFAULT);

$stmt = $conexion -> prepare("INSERT INTO tbl_usuarios (username,contraseña, correo_electronico) VALUES (?,?,?)");

$stmt-> bind_param("sss", $username, $cifrado, $correo_electronico);

if($stmt->execute()){
    echo "Usuario registrado exitosa mente";
}else{
    echo "Error al registrar usuario" . $stmt->error;
}

$conexion->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form  action="login.php" method="POST">
        <h2>Iniciar Sesión</h2>
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="contraseña" placeholder="contraseña" required>
        <button type="submit">Ingresar</button>
    </form>

</body>
</html>













?>