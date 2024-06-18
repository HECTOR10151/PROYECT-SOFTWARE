<?php
session_start(); // Iniciamos la sesión
if (!isset($_SESSION['user']) || $_SESSION['user'] != "admin") {
    header("Location: ../sesion.html");
    exit();
}

include("conexion.php");
$con = mysqli_connect($server, $user, $pass, $db);

$idCita = $_GET['id'];
// Obtener la información de la cita
$sqlCita = "SELECT * FROM citas WHERE IDcitas='$idCita'";
$qCita = mysqli_query($con, $sqlCita);
$rowCita = mysqli_fetch_array($qCita);

// Obtener el ID del cliente de la cita
$idCliente = $rowCita['ID'];

// Obtener la información del cliente
$sqlCliente = "SELECT * FROM clientes WHERE ID='$idCliente'";
$qCliente = mysqli_query($con, $sqlCliente);
$rowCliente = mysqli_fetch_array($qCliente);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
</head>
<body>
    <h1>Editar Cita</h1>
    <form action="updatecitas.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $rowCita['IDcitas']; ?>">
        
        <label for="usuario">Usuario: <?php echo $rowCliente['USUARIO']; ?></label><br>
        
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo $rowCita['DIRECCION']; ?>"><br><br>
        
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo $rowCita['FECHA']; ?>"><br><br>
        
        <label for="material">Material:</label>
        <input type="text" id="material" name="material" value="<?php echo $rowCita['MATERIAL']; ?>"><br><br>
        
        <label for="kilos">Kilos:</label>
        <input type="number" id="kilos" name="kilos" value="<?php echo $rowCita['KILOS']; ?>"><br><br>
        
        <label for="estatus">Estatus:</label>
        <select id="estatus" name="estatus">
            <option value="PENDIENTE" <?php if($rowCita['ESTATUS'] == 'PENDIENTE') echo 'selected'; ?>>Pendiente</option>
            <option value="COMPLETADO" <?php if($rowCita['ESTATUS'] == 'COMPLETADO') echo 'selected'; ?>>Completado</option>
        </select><br><br>
        
        <button type="submit">Actualizar</button>
        <button type="button" onclick="redireccion()">Cancelar</button>
    </form>
    <script>
        function redireccion(){
           location.href = "admin.php";
        }
    </script>
</body>
</html>
