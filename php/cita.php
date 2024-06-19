<?php
session_start(); // Iniciamos la sesión
if (!isset($_SESSION['user'])) {
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