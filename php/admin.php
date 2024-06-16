
<?php
    session_start();//Iniciamos la sesión
    if(!isset($_SESSION['user'])||$_SESSION['user']!="admin"){
        header("Location: ../sesion.html");
        exit();
    }
    include("conexion.php");
    $con = mysqli_connect($server, $user, $pass, $db);
    $sql="SELECT * FROM clientes";
    $q = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($q);//Obtenemos la fila de la consulta
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>
    <H1>Bienvenido admin</H1>
    <div>
        <h2>Clientes</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>    
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Direccion</th>
                        <th>Email</th>
                        <th>Telefono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row=mysqli_fetch_array($q)){
                    ?>
                            <tr>
                                <td><?php echo $row['ID']; ?></td>
                                <td><?php echo $row['USUARIO']; ?></td>
                                <td><?php echo $row['NAME']; ?></td>
                                <td><?php echo $row['APELLIDO']; ?></td>
                                <td><?php echo $row['DIRECCION']; ?></td>
                                <td><?php echo $row['EMAIL']; ?></td>
                                <td><?php echo $row['TELEFONO']; ?></td>
                                <td><a href="editar.php?id=<?php echo $row['ID'];?>">Editar</a></td>
                                <td><a href="eliminar.php?id=<?php echo $row['ID'];?>" onclick="return confirmDelete()">Eliminar</a></td>
                            </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <button type="button" onclick="redireccion()">Cerrar sesion</button>
            <button type="button" onclick="redirc()">Agregar Usuario</button>
        </div>
    </div>
    <script src="../js/admin.js"></script>
</body>
</html>