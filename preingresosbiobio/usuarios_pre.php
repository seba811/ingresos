<?php
session_start();

if (!$_SESSION['usuario_id'] && !$_SESSION['usuario_usuario']) {

    header("location:../index.php");
    exit;
}
//Alerta
if (isset($_GET['x'])) {
    switch ($_GET['x']) {
        case 'add_exi':
            $alerta_tipo = "success";
            $alerta_titulo = "Usuario Agregado con éxito";
            $alerta = true;
            break;
        case 'add_err':
            $alerta_tipo = "warning";
            $alerta_titulo = "Error al Agregar Usuario";
            $alerta = true;
            break;
        case 'modi_exi':
            $alerta_tipo = "success";
            $alerta_titulo = "Usuario Modificado con éxito";
            $alerta = true;
            break;
        case 'modi_err':
            $alerta_tipo = "warning";
            $alerta_titulo = "Error al modificar Usuario";
            $alerta = true;
            break;
        case 'elimin_exi':
            $alerta_tipo = "success";
            $alerta_titulo = "Usuario Eliminado con éxito";
            $alerta = true;
            break;
        case 'elimin_err':
            $alerta_tipo = "warning";
            $alerta_titulo = "Error al Eliminar ";
            $alerta = true;
            break;
        case 'add_usu':
            $alerta_tipo = "warning";
            $alerta_titulo = "Usuario ya Ocupado";
            $alerta = true;
            break;
        default:
            $alerta = false;
            break;
    }
}
?>

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- <link rel="stylesheet" href="/path/to/select2.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="sweetalert2.all.min.js"></script> -->

    <style type="text/css">
        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }
    </style>


    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },
                    "columnDefs": [{
                        "className": "dt-center",
                        "targets": "_all"
                    }],
                }

            );



        });
    </script>
    <script>
        $(document).ready(function() {
            var alerta = "<?php echo $alerta; ?>";
            var alerta_titulo = "<?php echo $alerta_titulo; ?>";
            var alerta_tipo = "<?php echo $alerta_tipo; ?>";
            console.log("hola alerta = " + alerta_titulo);
            if (alerta == true) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: alerta_tipo,
                    title: alerta_titulo
                })
            }
        });
    </script>

    <style type="text/css">
        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>

<body>


    <?php
    include('conexion.php');
   
    $rs_usuarios = $conexion->query('SELECT * FROM usuarios where usuario_tipo=9 or usuario_tipo=8');

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
        <a class="navbar-brand"><img src="../assets/img/logo.png" width="60" class="brand_logo" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="preingresos.php">PreIngresos <span class="sr-only">(current)</span></a>
                <?php if ($_SESSION['usuario_tipo'] == 0) { ?>
                    <a class="nav-item nav-link" href="usuarios.php">Usuarios</a>
                <?php } else { ?>
                    <a class="nav-item nav-link" hidden href="usuarios.php">Usuarios</a>
                <?php } ?>
            </div>
        </div>

        <a class="nav-item nav-link disable" href="#"><?php echo $_SESSION['usuario_nombre'] ?></a>
        <a href="salir.php"><button class="btn btn-outline-info my-2 my-sm-0" type="submit">Cerrar Sesion</button></a>


    </nav>




    <div class="container" style="padding:50px 50px;">

        <div class="row">
            <div class="col-8">
                <a href="usuario_nuevo.php">
                    <button type="button" class="btn btn-primary" style="margin-bottom:5px;">Nuevo Usuario</button>
                </a>

              
            </div>
         
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $rs_usuarios->fetch_array(MYSQLI_ASSOC)) {
                    $usuario_usuario   = $row['usuario_usuario'];
                    $usuario_nombre    = $row['usuario_nombre'];
                    if ($row['usuario_tipo'] == 9) {
                        $usuario_tipo      = 'Usuario Preingresos Chillan';
                    } else if ($row['usuario_tipo'] == 8) {
                        $usuario_tipo = 'Administrador Preingresos Chillan';
                    } 
                ?>

                    <tr>
                        <td title="usuario"><?= $usuario_usuario ?></td>
                        <td title="nombre"><?= $usuario_nombre ?></td>
                        <td title="tipo"><?= $usuario_tipo ?></td>
                        <td title="Acciones" class="text-center">
                            <a title="Modificar" href="usuario_modificar.php?id=<?= $row['usuario_id'] ?>">
                                <i class="bi bi-pencil-fill fa-2x " style="margin-left:10px;"></i>
                            </a>
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

<script>
   

    $('select').select2({
        theme: 'bootstrap4',
    });
</script>