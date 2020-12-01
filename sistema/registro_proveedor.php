<?php 
	session_start();
    if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
	
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

            $proveedor    = $_POST['proveedor'];
			$contacto    = $_POST['contacto'];
			$telefono  = $_POST['telefono'];
			$direccion   = $_POST['direccion'];
			$usuario_id    = $_SESSION['idUser'];

			

				$query_insert = mysqli_query($conection,"INSERT INTO proveedor(proveedor,contacto,telefono,direccion,usuario_id)
														VALUES('$proveedor','$contacto','$telefono','$direccion','$usuario_id')");
				if($query_insert){
					$alert='<p class="msg_save">Proveedor guardado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al guardar el proveedor.</p>';
				}

			}

	}



 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro del proveedor</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
    <div class="main">
        <div class="barra_lateral">
             <?php include "includes/nav.php"; ?>
        </div>
    
	<section id="container">
		
		<div class="form_register">
			<h1>Registro del proveedor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="proveedor">Proveedor</label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre del proveedor">
				<label for="contacto">Contacto</label>
				<input type="text" name="contacto" id="contacto" placeholder="Nombre completo del contacto">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección completa">
				
				
				<input type="submit" value="Guardar proveedor" class="btn_save">

			</form>


		</div>


	</section>
        </div>
	<?php include "includes/footer.php"; ?>
    
</body>
</html>