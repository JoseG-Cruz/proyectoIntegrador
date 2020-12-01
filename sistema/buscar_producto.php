<?php 
	session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}

	include "../conexion.php";	

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de productos</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
    <div class="main">
        <div class="barra-lateral">
            <?php include "includes/nav.php"; ?>
        </div>
	<section id="container">
        
		<?php 

			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: lista_producto.php");
				
			}


		 ?>
		
		<a href="lista_producto.php" class="btn_new">Regresar</a>	
		<form action="buscar_producto.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>Codigo</th>
				<th>Precio</th>
				<th>Existencia</th>
                <th>Descripcion</th>
				<th>Foto</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM producto 
																WHERE ( codproducto LIKE '%$busqueda%' OR 
																		precio LIKE '%$busqueda%' OR 
																		existencia LIKE '%$busqueda%' OR
                                                                        descripcion LIKE '%$busqueda%'  ) 
																AND estatus = 1  ");

			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"SELECT * FROM producto
										WHERE 
										( codproducto LIKE '%$busqueda%' OR 
											precio LIKE '%$busqueda%' OR 
											existencia LIKE '%$busqueda%' OR
                                            descripcion LIKE '$busqueda') 
										AND
										estatus = 1 ORDER BY codproducto ASC LIMIT $desde,$por_pagina 
				");

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data["codproducto"]; ?></td>
					<td><?php echo $data["precio"]; ?></td>
					<td><?php echo $data["existencia"]; ?></td>
                    <td><?php echo $data["descripcion"]; ?></td>
					<td><?php echo $data["foto"]; ?></td>
					<td>
						<a class="link_edit" href="editar_producto.php?id=<?php echo $data["codproducto"]; ?>">Editar</a>

					<?php if($_SESSION['rol'] == 1 || $_SESSION['rol'] ==2){ ?>
						|
						<a class="link_delete" href="eliminar_confirmar_producto.php?id=<?php echo $data["codproducto"]; ?>">Eliminar</a>
					<?php } ?>
						
					</td>
				</tr>
			
		<?php 
				}

			}
		 ?>


		</table>
<?php 
	
	if($total_registro != 0)
	{
 ?>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>
<?php } ?>


	</section>
    </div>
	<?php include "includes/footer.php"; ?>
</body>
</html>