<?php
session_start(); //Iniciamos la sesión
if (!isset($_SESSION['user']) || $_SESSION['user'] != "admin") {
    header("Location: ../sesion.html");
    exit();
}
include("conexion.php");
$con = mysqli_connect($server, $user, $pass, $db);
$id = $_GET['id'];
$sql = "SELECT * FROM clientes WHERE ID='$id'";
$q = mysqli_query($con, $sql);
$row = mysqli_fetch_array($q); //Obtenemos la fila de la consulta
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTUALIZAR</title>
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

    <section>
        <h1>Actualizar</h1>
        <div>
            <fieldset class="">
                <!-- <legend class="alum"><b>Cliente</b>-->
                <form action="update.php?id=<?php echo $id ?>" method="POST">
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