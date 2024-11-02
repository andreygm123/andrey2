<?php
include 'conexionProducto.php';
$username = "AndreyG";
$contraseña = "ela43715";
$correo_electronico = "andrey56@gmail.com";

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
















?>