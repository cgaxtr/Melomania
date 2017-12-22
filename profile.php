<?php session_start();
  require_once("modelo/usuarioDAO.php");

  $dao = new UsuarioDAO();
  $usuario = $dao->getInformation($_SESSION["email"]);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./style/styles.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Melomania</title>
  </head>
  <body>
    <?php include ('cabecera.php');?>

    <div class="container">
<br>
<br>
	<div class="row" id="main">
        <div class="col-md-4 well" id="leftPanel">
            <div class="row">
                <div class="col-md-12">
                	<div>
        				<img src="http://lorempixel.com/200/200/abstract/1/" alt="Texto Alternativo" class="img-circle img-thumbnail">
        				<h2><?php echo $_SESSION["name"]?></h2>
        				<p><?php echo date_format(date_create($usuario->getFecha()), 'd-m-Y'); ?></p>

        			</div>
        		</div>
            </div>
        </div>
        <div class="col-md-8 well" id="rightPanel">
            <div class="row">
    <div class="col-md-12">
    	<form role="form">
			<h2>Actualiza tu perfil.</h2>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
            <input type="text" name="first_name" id="first_name" class="form-control input-lg" value="<?php echo $usuario->getNombre() ?>" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="last_name" id="last_name" class="form-control input-lg" value="<?php echo $usuario->getApellido() ?>" tabindex="2">
					</div>
				</div>
			</div>
      <div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
				      <input type="email" name="email" id="email" class="form-control input-lg" value="<?php echo $usuario->getEmail() ?>" tabindex="4">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
				      <input type="email" name="email" id="email" class="form-control input-lg" value="<?php echo $usuario->getEmail() ?>" tabindex="4">
        </div>
      </div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password" id="password" class="form-control input-lg" value="<?php echo $usuario->getContrasena() ?>" tabindex="5">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
					</div>
				</div>
			</div>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6"></div>
				<div class="col-xs-12 col-md-6"><a href="#" class="btn btn-success btn-block btn-lg">Guardar</a></div>
			</div>
		</form>
	</div>
</div>
</div>
        </div>
     </div>

  </body>
</html>
