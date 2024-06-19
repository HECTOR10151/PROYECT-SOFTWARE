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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.html"><img src="Imagen/1.png" style="height: 50px;" alt="Logo1"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
