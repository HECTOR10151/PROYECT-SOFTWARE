<?php
session_start();
include("conexion.php");

$user = $_POST['user'];
$pass = $_POST['pass'];

$buscar = "SELECT * FROM clientes WHERE USUARIO='$user' AND password='$pass'";
$q = mysqli_query($con, $buscar);

if (mysqli_num_rows($q) > 0) {
    // Inicio de sesión exitoso, redirigir a la página principal
    $_SESSION['user'] = $user; // Guardar el nombre de usuario en la sesión
    if ($user == "admin") {
        $_SESSION['admin'] = true;
        header("Location: ./admin.php");
    } else {
        $ID = mysqli_fetch_array($q)['ID'];
        header("Location: ./cliente.php?id=$ID");
    }
    exit();
} else {
    // Credenciales incorrectas, redirigir de vuelta a sesion.html con un parámetro de error
    header("Location: ../sesion.html?error=1");
    exit();
}
?>