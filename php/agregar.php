<?php
    include("conexion.php");
    $con = mysqli_connect($server, $user, $pass, $db);
    
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    
    $buscar = "SELECT * FROM clientes WHERE USUARIO='$user'";
    $q = mysqli_query($con, $buscar);
    
    if (mysqli_num_rows($q) === 0) {
        $sql = "INSERT INTO clientes (USUARIO, PASSWORD, NAME, APELLIDO, DIRECCION, EMAIL, TELEFONO) 
                VALUES ('$user', '$pass', '$name', '$apellido', '$direccion', '$email', '$telefono')";
        
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Datos aceptados'); window.location.href = '../sesion.html';</script>";
            exit();
        } else {
            echo "<script>alert('Error al insertar datos');</script>";
            exit();
        }
    } else {
        echo "<script>alert('Usuario ya existente'); window.location.href = '../formulario.html';</script>";
        exit();
    }
?>
