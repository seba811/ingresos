

<!DOCTYPE html>
<html lang="es">

<head>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable(
                {
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },
                    "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ],
                }

            );

        });
    </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>

<body>


    <?php
    include('conexion.php');

    $rs_usuarios = $conexion->query('SELECT * FROM usuarios ');

    ?>
    <!--<nav class="navbar ">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand"><img src="assets/img/1.png" width="60" class="brand_logo" alt="Logo"></a>
            </div>
            <ul class="nav navbar-nav">
                <li class="inactive"><a href="ingresos.php">Ingresos</a></li>
                <li><a>Usuarios</a></li>
            </ul>
            <ul class="nav navbar-nav pull-right">

                <li><a href="salir.php">Cerrar Sesion</a></li>
            </ul>
        </div>
    </nav>
    -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand"><img src="assets/img/logo.png" width="60" class="brand_logo" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active"  href="ingresos.php" >Ingresos <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="usuarios.php">Usuarios</a>
            </div>
        </div>

        <a class="nav-item nav-link disable" href="#">Usuarios</a>
        <a href="salir.php"><button class="btn btn-outline-info my-2 my-sm-0"  type="submit">Cerrar Sesion</button></a>


    </nav>





    <div class="container" style="padding:50px 50px;">


        <a href="usuario_nuevo.php">
            <button type="button" class="btn btn-secondary" style="margin-bottom:5px;">Nuevo Usuario</button>
        </a>


        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Clave</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $rs_usuarios->fetch_array(MYSQLI_ASSOC)) {
                    $usuario_usuario   = $row['usuario_usuario'];
                    $usuario_nombre    = $row['usuario_nombre'];
                    $usuario_tipo      = $row['usuario_tipo'];
                    $usuario_clave     = $row['usuario_clave'];

                ?>

                    <tr>
                        <td title="usuario"><?= $usuario_usuario ?></td>
                        <td title="nombre"><?= $usuario_nombre ?></td>
                        <td title="tipo"><?= $usuario_tipo ?></td>
                        <td title="clave"><?= $usuario_clave ?></td>
                        <td title="Acciones" class="text-center">
                            <!--<a title="Modificar" href="usuario_modificar.php">
									<i class="bi bi-pencil-fill fa-2x " style="margin-left:10px;"></i>
								</a>-->
                            <a title="Eliminar" href="usuario_eliminar.php?id=<?= $row['usuario_id'] ?>" onclick="javascript: return confirm('¿Desea Eliminar Este Usuario?');">
                                <i class="bi bi-trash-fill fa-2x " style="margin-left:10px;"></i>
                            </a>
                        </td>


                    </tr>
                <?php } //Fin while 
                ?>
            </tbody>
          
        </table>

    </div>


</body>

</html>