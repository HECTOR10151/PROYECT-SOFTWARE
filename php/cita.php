<?php
session_start(); // Iniciamos la sesión
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
    <title>GENERAR CITA</title>
</head>
<body>
    <h1>Generar Cita</h1>
    <div>
        <form action="./citas.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" required><br>
            <label for="fecha">Fecha</label>
            <input type="date" name="date" required><br>
            <label for="material">Material</label>
            <input type="text" name="material" required><br>
            <label for="kilos">kilos</label>
            <input type="number" name="kilos" required><br>
            <button type="submit">CREAR</button>
        </form>
    </div>
    <div>
        <button type="button" onclick="re(<?php echo $id; ?>)">Cancelar</button>
    </div>
    <script>
        function re(id) {
            location.href = "./cliente.php?id=" + id;
        }
    </script>
</body>
</html>