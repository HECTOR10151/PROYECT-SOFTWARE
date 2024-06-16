<?php
    include("conexion.php");
    $user=$_POST['user'];
    $pass=$_POST['pass'];
    
    $buscar="SELECT * FROM usuarios WHERE user='$user' AND pass='$pass'";
    $q=mysqli_query($con, $buscar);//Ejecutamos la consulta
    if(mysqli_num_rows($q)==0){
        echo "Usuario no encontrado";
        Header("Location: ../sesion.html?error=1");
    }
?>
