<?php
    session_start();//Iniciamos la sesión
    if(!isset($_SESSION['user'])||$_SESSION['user']!="admin"){
        header("Location: ../sesion.html");
        exit();
    }
    include("conexion.php");
    $con = mysqli_connect($server, $user, $pass, $db);
    $id = $_GET['id'];
    $sql="SELECT * FROM clientes WHERE ID='$id'";
    $q = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($q);//Obtenemos la fila de la consulta
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTUALIZAR</title>
</head>
<body>
    <section>
        <h1>Actualizar</h1>
        <div>
            <fieldset class="">
               <!-- <legend class="alum"><b>Cliente</b>-->
                    <form action="update.php?id=<?php echo $id?>" method="POST">
                        <label for="user">Usuario</label>
                        <input type="text" name="user" value="<?php echo $row['USUARIO']; ?>"><br>
                        <label for="name">Nombre</label>
                        <input type="text" name="name" value="<?php echo $row['NAME']; ?>"><br>
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" value="<?php echo $row['APELLIDO']; ?>"><br>
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" value="<?php echo $row['DIRECCION']; ?>"><br>
                        <label for="email">Email</label>
                        <input type="text" name="email" value="<?php echo $row['EMAIL']; ?>"><br>
                        <label for="telefono">Telefono</label>
                        <input type="text" name="telefono" value="<?php echo $row['TELEFONO']; ?>"><br>
                        <button type="submit">Actualizar</button>
                        <button type="button" onclick="redireccion()">Cancelar</button>
                    </form>
               <!-- </legend>-->
        </div>
    </section>
    <script>
        function redireccion(){
           location.href = "admin.php";
        }
    </script>
</body>
</html>