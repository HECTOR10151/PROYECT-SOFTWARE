<?php
session_start();

include("conexion.php");

$user = $_POST['user'];
$pass = $_POST['pass'];

$buscar = "SELECT * FROM clientes WHERE USUARIO='$user' AND password='$pass'";
$q = mysqli_query($con, $buscar);

if(mysqli_num_rows($q) > 0){
    // Inicio de sesión exitoso, redirigir a la página principal
    $_SESSION['user'] = $user; // Guardar el nombre de usuario en sesión si es necesario
    header("Location: ../index.html");
    exit();
} else {
    // Credenciales incorrectas, redirigir de vuelta a sesion.html con un parámetro de error
    header("Location: ../sesion.html?error=1");
    exit();
}
?>
