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
    <link rel="icon" href="Imagen/1.png" type="image/png">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="src/diseñosForms.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.html"><img src="Imagen/1.png" style="height: 50px;" alt="Logo1"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>

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
            <option value="PENDIENTE" <?php if ($rowCita['ESTATUS'] == 'PENDIENTE') echo 'selected'; ?>>Pendiente</option>
            <option value="COMPLETADO" <?php if ($rowCita['ESTATUS'] == 'COMPLETADO') echo 'selected'; ?>>Completado</option>
        </select><br><br>

        <button type="submit">Actualizar</button>
        <button type="button" onclick="redireccion()">Cancelar</button>
    </form>
    <script>
        function redireccion() {
            location.href = "admin.php";
        }
    </script>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <a href="https://www.instagram.com/" target="_blank" class="social_link" id="f1">
                <i class="bx bxl-instagram social_icon"></i>
            </a>
            <a href="https://es-la.facebook.com/" target="_blank" class="social_link">
                <i class="bx bxl-facebook-circle social_icon"></i>
            </a>
            <a href="https://twitter.com/?lang=es" target="_blank" class="social_link">
                <i class="bx bxl-twitter social_icon"></i>
            </a>
            <a href="https://www.tiktok.com/es/" target="_blank" class="social_link">
                <i class="bx bxl-tiktok social_icon"></i>
            </a>
            <br>
            <p class="mb-0">RopaTech - Transformando moda en sostenibilidad. © 2024 Todos los derechos reservados. 
                <b><h6><a class="social_link tam" href="#">Aviso de privacidad</a> | <a class="social_link tam" href="#">Términos de Servicio</a> | <a class="social_link tam" href="#">Contáctanos</a></h6></b>
            </p>
        </div>
    </footer>
    
</body>

</html>