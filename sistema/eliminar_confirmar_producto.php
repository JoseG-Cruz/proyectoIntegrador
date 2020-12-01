<?php 
	session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		if($_POST['idproducto']== 1)
        {
			header("location: lista_producto.php");
			mysqli_close($conection);
            exit;
		}
		$idproducto = $_POST['idproducto'];

		$query_delete = mysqli_query($conection,"DELETE FROM producto WHERE codproducto =$idproducto ");
		//$query_delete = mysqli_query($conection,"UPDATE producto SET estatus = 0 WHERE codproducto = $idproducto ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_producto.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: lista_producto.php");
		mysqli_close($conection);
	}else{

		$idproducto = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT produc.descripcion, prov.proveedor 
                        FROM producto produc
                        INNER JOIN
                        proveedor prov
                        ON produc.proveedor = prov.codproveedor
        WHERE produc.codproducto  = $idproducto ");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$producto = $data['descripcion'];
                $proveedor = $data['proveedor'];

			}
		}else{
			header("location: lista_producto.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
    <div class="main">
        <div class="barra_lateral">
             <?php include "includes/nav.php"; ?>
        </div>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Nombre del producto: <span><?php echo $producto; ?></span></p>
            <p>Proveedor: <span><?php echo $proveedor; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idproducto" value="<?php echo $idproducto; ?>">
				<a href="lista_producto.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Eliminar" class="btn_ok">
			</form>
		</div>


	</section>
        </div>
	<?php include "includes/footer.php"; ?>
    
</body>
</html>