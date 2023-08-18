

<?

session_start();

if($_SESSION['usuario_id'] && $_SESSION['usuario_usuario']  ){

	header("location:ingresos.php");
}

include("conexion.php");

$r = $_GET['x'];

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="assets/css/estilos.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title>Login Prize</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	<script type="text/javascript">
        $(document).ready(function () {
            $('#show_password').hover(function show() {
                //Cambiar el atributo a texto
                $('#clave').attr('type', 'text');
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            },
            function () {
                //Cambiar el atributo a contraseña
                $('#clave').attr('type', 'password');
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            });
            //CheckBox mostrar contraseña
            $('#ShowPassword').click(function () {
                $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });
        });
    </script>
	<script type="text/javascript">
	
	$(document).ready(function() {
    	setTimeout(function() {
        $(".content").fadeOut(1500);
    	},1000);
 
		});
		
	
</script>

</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="assets/img/1.png" class="brand_logo" alt="Logo">
						<p style="color:white; font-size:200%; font-weight: bold;">Ingresos</p>
					</div>
				
				</div>
				
				<div class="d-flex justify-content-center form_container">
					<form action="acceso_usuario.php" method="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="usuario" class="form-control input_user" value="" placeholder="Usuario">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="clave" id="clave" class="form-control input_pass" value="" placeholder="Contraseña">
					
							<div class="input-group-append" id="show_hide_password">
							<button id="show_password" class="btn btn-danger" type="button">
                                <span class="fa fa-eye-slash icon"></span>
                            </button>
                        
							</div>
						</div>
						<!-- <div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Recuerdame</label>
							</div>
						</div> -->
							<div class="d-flex justify-content-center mt-3 login_container">
				 			<button type="submit" name="button" class="btn login_btn">Iniciar</button>
				   			</div>

							   <?php
       							if(isset($_GET["x"]) && $_GET["x"] == '1')
      							 {
          							echo "<div style='color:red'>Usuario o contraseña incorrectos </div>";
       								}
    						    ?>
					</form>
				</div>

			</div>
		</div>
	</div>
</body>
</html>






