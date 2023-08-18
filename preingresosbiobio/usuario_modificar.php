<?php
session_start();

if (!$_SESSION['usuario_id'] && !$_SESSION['usuario_usuario']) {

  header("location:../index.php");
  exit;
}
$usuario_tipo = $_SESSION['usuario_tipo']; 

$usuario_id = $_GET['id'];


?>


<!DOCTYPE html>
<html lang="es">

<head>
  <!-- CSS only -->
  <!-- CSS only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="assets/css/estilos2.css">
  <script src="sweetalert2.all.min.js"></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>

</head>

<body>




  <?php
  include('conexion.php');

  $rs_usuarios = $conexion->query("SELECT * FROM usuarios where usuario_id= '$usuario_id'");
  $row = $rs_usuarios->fetch_array(MYSQLI_ASSOC);
  $usuario = $row['usuario_usuario'];
  $nombre = $row['usuario_nombre'];
  $tipo = $row['usuario_tipo'];
  $clave = $row['usuario_clave'];
  ?>



  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand"><img src="assets/img/logo.png" width="60" class="brand_logo" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="ingresos.php">Ingresos <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="usuarios.php">Usuarios</a>
      </div>
    </div>

    <a class="nav-item nav-link disable" href="#"><?php echo $_SESSION['usuario_nombre'] ?></a>
    <a href="salir.php"><button class="btn btn-outline-info my-2 my-sm-0" type="submit">Cerrar Sesion</button></a>


  </nav>





  <div class="container" style="padding:50px 50px;">


    <form method="POST" action="usuario_modificar_proc.php" onsubmit="return comprobarClave()">
      <input type="hidden" name="id" id="id" value="<?= $usuario_id ?>">
      <legend>Modificar Usuario</legend>
      <div class="form-group">
        <label for="exampleInputEmail1">Usuario</label>
        <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="emailHelp" onlyread placeholder="Usuario" required value="<?= $usuario ?>">

      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Nombre y Apellido</label>
        <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="emailHelp" value="<?= $nombre ?>">

      </div>
      <div class="form-group">
        <label for="rut">Tipo de Usuario</label>
        <div>
          <select class="form-control" name="estado" id="estado" style="width: 100%;">
          <?php
                if ($usuario_tipo == 0 || $usuario_tipo == 8) {
                  
                  if($tipo==5 ){?>

                  <option value="8">ADMINISTRADOR PREINGRESOS CHILLAN</option>
                  <option value="9">USUARIO PREINGRESOS CHILLAN</option>

                <?php } }
                if ($usuario_tipo == 0) { ?>
                <option value="0">ADMINISTRADOR</option>

               <?php }?>


          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="clave1" class="form-control" id="clave1" placeholder="Password" required value="<?= $clave ?>">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1"> Repetir Password</label>
        <input type="password" name="clave2" class="form-control" id="clave2" placeholder="Repetir Password" value="<?= $clave ?>">
      </div>

      <button id="boton" type="submit" class="btn btn-primary">Modificar</button>
    </form>





  </div>




</body>



</html>
<script>
  function comprobarClave() {
    clave1 = document.getElementById('clave1').value;
    clave2 = document.getElementById('clave2').value;

    if (clave1 != clave2) {
      Swal.fire(
        'Las Contraseñas no coinciden',

      )
      return false

    }
  }
</script>