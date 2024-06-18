<?php
session_start();//Iniciamos la sesión
if(!isset($_SESSION['user'])){
    header("Location: ../sesion.html");
    exit();
}
include("conexion.php");
$con = mysqli_connect($server, $user, $pass, $db);
if (!isset($_GET['id'])) {
    echo "ID de cliente no proporcionado.";
    exit();
}
$id = $_GET['id'];
$sql = "SELECT * FROM clientes WHERE ID = '$id'";
$q = mysqli_query($con, $sql);
if (mysqli_num_rows($q) == 0) {
    echo "Cliente no encontrado.";
    exit();
}
$row = mysqli_fetch_array($q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
</head>
<body>
    <div>
        <h1>Hola bienvenido <?php echo $row['USUARIO']; ?>!!!</h1>
    </div>
    <div>
        <button type="button" onclick="cita(<?php echo $id; ?>)">Crear cita</button>
    </div>
    
    <div>
        <h2>Historial de citas</h2>
    </div>
    <div>
        <table>
            <tr>
                <th>Dirección</th>
                <th>Fecha</th>
                <th>Material</th>
                <th>Kilos</th>
                <th>Estatus</th>
            </tr>
            <?php
            $sql = "SELECT * FROM citas WHERE ID = '$id'";
            $q = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($q)) {
                echo "<tr>";
                echo "<td>" . $row['DIRECCION'] . "</td>";
                echo "<td>" . $row['FECHA'] . "</td>";
                echo "<td>" . $row['MATERIAL'] . "</td>";
                echo "<td>" . $row['KILOS'] . "</td>";
                echo "<td>" . $row['ESTATUS'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    <div>
     <button type="button" onclick="redireccion()">Cerrar sesion</button>
    </div>
    <script src="../js/admin.js"></script>
    <script>
        function cita(id) {
            location.href = "./cita.php?id=" + id;
        }
    </script>
</body>
</html>