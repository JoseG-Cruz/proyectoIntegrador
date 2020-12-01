<?php
    session_start();
    include "../conexion.php"
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php include "includes/scripts.php"; ?>
    <title>Nueva venta</title>
</head>
<body>
    <?php include "includes/header.php"; ?>
<div class="main">
        <div class="barra_lateral">
             <?php include "includes/nav.php"; ?>
        </div>
    <section id="container">
        <div class="title_page">
            <h1>Nueva venta</h1>
        </div>
        <div class="datos_cliente">
            <div class="action_cliente">
                <h4>Datos del cliente</h4>
                <a href="#">Nuevo cliente</a>
            </div>
            <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="Datos">
                <input type="hidden" name="action" value="addCliente">
                <input type="hidden" id="idcliente" name="idcliente" value="" required>
                <div class="wd30">
                    <label>Nit</label>
                    <input type="text" name="nit_cliente" id="nit_cliente">
                </div>
                <div class="wd30">
                    <label>Nombre</label>
                    <input type="text" name="nom_cliente" id="nom_cliente" disabled required>
                </div>
                <div class="wd30">
                    <label>Teléfono</label>
                    <input type="text" name="tel_cliente" id="tel_cliente" disabled required>
                </div>
                <div class="wd30">
                    <label>Dirección</label>
                    <input type="text" name="dir_cliente" id="dir_cliente" disabled required>
                </div>
                <div>
                    <button type="submit" class="btn_save">Guardar </button>
                </div>
            </form>
        </div>
        <div class="datos_venta">
            <h4>Datos de venta</h4>
                <div class="datos">
                    <div class="wd50">
                        <label>Vendedor</label>
                        <p>Carlos Jair Fernandez Guarneros</p>
                    </div>
                    <div class="wd50">
                        <label>Accciones</label>
                        <div id="acciones_venta">
                            <a href="#" class="btn_ok textcenter" id="btn_anular_venta">Anular</a>
                            <a href="#" class="btn_ok textcenter" id="btn_anular_venta">Procesar</a>
                        </div>
                    </div>
                </div>
        </div>

        <table class="tbl_venta">
            <thead>
                <tr>
                    <th width="100px">Código</th>
                    <th>Descripción</th>
                    <th>Existencia</th>
                    <th width="100px">Cantidad</th>
                    <th class="textrigth">Precio</th>
                    <th class="textrigth">Precio Total</th>
                    <th>Acción</th>
                </tr>
                <tr>
                    <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
                    <td id="txt_descripcion">-</td>
                    <td id="txt_existencia">-</td>
                    <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                    <td id="txt_precio" class="textright">0.00 </td>
                    <td id="txt_precio_total" class="textright">0.00 </td>
                    <td> <a href="#" id="add_produc_venta" class="link_add">Agregar</a></td>
                </tr>
                <tr>
                    <th>Código</th>
                    <th colspan="2">Descripción</th>
                    <th>Cantidad</th>
                    <th class="textright">Precio</th>
                    <th class="textright">Precio Total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="detalle_venta">
                <tr>
                    <td>1</td>
                    <td colspan="2">Mouse USB</td>
                    <td class="textcenter">1</td>
                    <td class="textrigth">100.00</td>
                    <td class="textrigth">100.00</td>
                    <td class="">
                        <a href="#" class="link_delete" onclick="event.preventDefault(); del_product_detalle(1);"></a>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="textright"> SUBTOTAL </td>
                    <td class="textright">1000.00</td>
                </tr>
                <tr>
                    <td colspan="5" class="textright"> IVA (16%)</td>
                    <td class="textright">500</td>
                </tr>
                <tr>
                    <td colspan="5" class="textright"> TOTAL $</td>
                    <td class="textright">1000.00</td>
                </tr>
            </tfoot>
        </table>
    </section>
    </div>
    <?php include "includes/footer.php"; ?>
</body>
</html>