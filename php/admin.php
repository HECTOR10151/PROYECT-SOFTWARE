<?php
session_start(); // Iniciamos la sesión
if (!isset($_SESSION['user']) || $_SESSION['user'] != "admin") {
    header("Location: ../sesion.html");
    exit();
}
// Código de inicio de sesión del administrador
$_SESSION['admin'] = true;
include("conexion.php");
$con = mysqli_connect($server, $user, $pass, $db);

$sqlClientes = "SELECT * FROM clientes";
$qClientes = mysqli_query($con, $sqlClientes);

$sqlCitas = "SELECT * FROM citas";
$qCitas = mysqli_query($con, $sqlCitas);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>
    <h1>Bienvenido admin</h1>
    
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
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($rowCliente = mysqli_fetch_array($qClientes)): ?>
                        <tr>
                            <td><?php echo $rowCliente['ID']; ?></td>
                            <td><?php echo $rowCliente['USUARIO']; ?></td>
                            <td><?php echo $rowCliente['NAME']; ?></td>
                            <td><?php echo $rowCliente['APELLIDO']; ?></td>
                            <td><?php echo $rowCliente['DIRECCION']; ?></td>
                            <td><?php echo $rowCliente['EMAIL']; ?></td>
                            <td><?php echo $rowCliente['TELEFONO']; ?></td>
                            <td><a href="editar.php?id=<?php echo $rowCliente['ID']; ?>">Editar</a></td>
                            <td><a href="eliminar.php?id=<?php echo $rowCliente['ID']; ?>" onclick="return confirmDelete()">Eliminar</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <button type="button" onclick="redirAgregarUsuario()">Agregar Usuario</button>
        </div>
    </div>
    
    <div>
        <h2>Citas</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID_Cliente</th>
                        <th>Usuario</th>
                        <th>Dirección</th>
                        <th>Fecha</th>
                        <th>Material</th>
                        <th>Kilos</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($rowCita = mysqli_fetch_array($qCitas)): ?>
                        <tr>
                            <td><?php echo $rowCita['IDcitas']; ?></td>
                            <td><?php echo $rowCita['ID']; ?></td>
                            <td><?php echo obtenerUsuario($rowCita['ID'], $con); ?></td>
                            <td><?php echo $rowCita['DIRECCION']; ?></td>
                            <td><?php echo $rowCita['FECHA']; ?></td>
                            <td><?php echo $rowCita['MATERIAL']; ?></td>
                            <td><?php echo $rowCita['KILOS']; ?></td>
                            <td><?php echo $rowCita['ESTATUS']; ?></td>
                            <td><a href="editarcitas.php?id=<?php echo $rowCita['IDcitas']; ?>">Editar</a></td>
                            <td><a href="eliminarcitas.php?id=<?php echo $rowCita['IDcitas']; ?>" onclick="return confirmDelete()">Eliminar</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div>
        <button type="button" onclick="redireccion()">Cerrar sesión</button>
    </div>
    
    <script src="../js/admin.js"></script>
</body>
</html>

<?php
function obtenerUsuario($idCliente, $con) {
    $sql = "SELECT USUARIO FROM clientes WHERE ID = '$idCliente'";
    $q = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($q);
    return $row['USUARIO'];
}
?>
