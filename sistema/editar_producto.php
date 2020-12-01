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
		if(empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['precio']) || $_POST['precio'] <= 0 || empty($_POST['cantidad'] || $_POST['cantidad'] <= 0))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
            
            $proveedor  = $_POST['proveedor'];
			$producto   = $_POST['producto'];
			$precio     = $_POST['precio'];
			$cantidad   = $_POST['cantidad'];
			$usuario_id = $_SESSION['idUser'];

			$foto        = $_FILES['foto'];
			$nombre_foto = $foto['name'];
			$type        = $foto['type'];
			$url_temp    = $foto['tmp_name'];
			$imgProducto = 'img_producto.png';

			if($nombre_foto != '')
			{
				$destino      = 'img/uploads/';
				$img_nombre   = 'img_'.md5(date('d-m-Y H:m:s'));
				$imgProducto  = $img_nombre.'.jpg';
				$src          = $destino.$imgProducto;
			}

			$query = mysqli_query($conection,"SELECT * FROM producto
                                                        WHERE(proveedor = '$proveedor', descripcion = '$producto', precio ='$precio', existencia = '$cantidad, usuario_id ='$usuario_id',foto='$foto)");
            
            $result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El producto ya existe.</p>';
			}else{

				if(empty($_POST['producto']))
				{

					$sql_update = mysqli_query($conection,"UPDATE producto
															SET proveedor = '$proveedor',  precio ='$precio', existencia = '$cantidad, usuario_id ='$usuario_id',foto='$foto");
				}else{
					$sql_update = mysqli_query($conection,"UPDATE usuario
															SET proveedor = '$proveedor', descripcion = '$producto', precio ='$precio', existencia = '$cantidad, usuario_id ='$usuario_id',foto='$foto");
				}

				if($sql_update){
					$alert='<p class="msg_save">Usuario actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el usuario.</p>';
				}

			}


		}

	}
																	


	/*Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_producto.php');
		mysqli_close($conection);
	}
	$iduser = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT produc.codproducto, produc.descripcion,produc.precio,produc.cantidad, (produc.proveedor) as proveedor, (prov.codproveedor) as proveedor
									FROM producto produc
									INNER JOIN proveedor prov
									on produc.proveedor = prov.codproveedor
									WHERE idusuario= $usuario_id ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_producto.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$proveedor  = $_POST['proveedor'];
			$producto   = $_POST['producto'];
			$precio     = $_POST['precio'];
			$cantidad   = $_POST['cantidad'];
			$usuario_id = $_SESSION['idUser'];

			$foto        = $_FILES['foto'];

		}
	}
*/
 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
    
	<title>Actualizar Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
    <div class="main">
        <div class="barra_lateral">
             <?php include "includes/nav.php"; ?>
        </div>
	<section id="container">

		<div class="form_register">
			<h1><i class="fas fa-cubes"></i>Actualizar Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
                
				<label for="proveedor">Proveedor</label>
                
                <?php
                include "../conexion.php";
                    $query_proveedor = mysqli_query($conection, "SELECT codproveedor, proveedor FROM proveedor WHERE estatus  = 1 ORDER BY proveedor ASC");
                    $result_proveedor = mysqli_num_rows ($query_proveedor);
                    mysqli_close($conection);
                ?>
                <select name="proveedor" id="proveedor">
                <?php
                    if($result_proveedor > 0){
                        while($proveedor = mysqli_fetch_array($query_proveedor)){
                ?>    
                    <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>
                <?php
                        }
                    }
                ?>
                    
                </select>
                
                <label for="producto">Producto</label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del producto" >
				<label for="precio">Precio</label>
				<input type="number" name="precio" id="precio" placeholder="Precio del producto">
				<label for="cantidad">Cantidad</label>
				<input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del producto">
                
                <div class="photo">
					<label for="foto">Foto</label>
			        <div class="prevPhoto">
			        <span class="delPhoto notBlock">X</span>
			        <label for="foto"></label>
			        </div>
			        <div class="upimg">
			        <input type="file" name="foto" id="foto">
			        </div>
			        <div id="form_alert"></div>
				</div>
				
				<button type="submit" class="btn_save"><i class="far fa-save ">Actualizar Producto</i></button>
			</form>


		</div>


	</section>
        </div>
	<?php include "includes/footer.php"; ?>
    
</body>
</html>