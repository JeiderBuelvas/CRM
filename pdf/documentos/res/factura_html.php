<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
  background:#2c3e50;
  padding: 4px 4px 4px;
  color:white;
  font-weight:bold;
  font-size:12px;
}
.silver{
  background:white;
  padding: 3px 4px 3px;
}
.clouds{
  background:#ecf0f1;
  padding: 3px 4px 3px;
}
.border-top{
  border-top: solid 1px #bdc3c7;
  
}
.border-left{
  border-left: solid 1px #bdc3c7;
}
.border-right{
  border-right: solid 1px #bdc3c7;
}
.border-bottom{
  border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "Polyuprotec S.A "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <?php include("encabezado_factura.php");?>
    <br>
    

  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>COTIZADO A</td>
        </tr>
    <tr>
           <td style="width:50%;" >
      <?php 
        $sql_cliente = mysqli_query($con, "SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
         $rw_cliente = mysqli_fetch_array($sql_cliente);
         echo $rw_cliente['nombre_cliente'];
         echo "<br>";
         echo $rw_cliente['contacto'];
     echo "<br>";
     echo $rw_cliente['cargo'];
     echo "<br>";
         echo $rw_cliente['direccion_cliente'];
         echo "<br> Teléfono: ";
         echo $rw_cliente['telefono_cliente'];
         echo "<br> Email: ";
         echo $rw_cliente['email_cliente'];
         ?>
       </td>
        </tr>
        
   
    </table>
    
       <br>
    <table cellspacing="4" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:15%;" class='midnight-blue'>COMERCIAL</td>
           <td style="width:28%;" class='midnight-blue'>CORREO</td>
      <td style="width:25%;" class='midnight-blue'>FECHA</td>
      <td style="width:15%;" class='midnight-blue'>CELULAR</td>
       <td style="width:18%;" class='midnight-blue'>FORMA DE PAGO</td>
        </tr>
    <tr>
           <td style="width:15%;">
      <?php 
        $sql_user=mysqli_query($con,"select * from users where user_id='$id_vendedor'");
        $rw_user=mysqli_fetch_array($sql_user);
        echo $rw_user['firstname']." ".$rw_user['lastname'];
      ?>
       </td>
       <td style="width:28%;">
      <?php 
        $sql_user=mysqli_query($con,"select * from users where user_id='$id_vendedor'");
        $rw_user=mysqli_fetch_array($sql_user);
        echo $rw_user['user_email'];
      ?>
       </td>
      <td style="width:25%;"><?php echo date("d/m/Y");?></td>

      <td style="width:15%;">
      <?php 
        $sql_user=mysqli_query($con,"select * from users where user_id='$id_vendedor'");
        $rw_user=mysqli_fetch_array($sql_user);
        echo $rw_user['celular'];
      ?>
       </td>
       <td style="width:18%;" >
        <?php 
        if ($condiciones==1){echo "100% anticipo contra proforma";}
        elseif ($condiciones==2){echo "A Convenir.";}
        elseif ($condiciones==3){echo "30 Dias Fecha Facturada";}
        elseif ($condiciones==4){echo "50% anticipo - 50% crédito";}
                elseif ($condiciones==5){echo "50% anticipo - 50% pago contado";}
        ?>
       </td>
        </tr>
    
        
   
    </table>
  <br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 10%;text-align:center" class='midnight-blue'>CANT.</th>
            <th style="width: 53%" class='midnight-blue'>DESCRIPCION</th>
            <th style="width: 8%;text-align:center" class='midnight-blue'>KG/UND.</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>
            
        </tr>

<?php
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
while ($row=mysqli_fetch_array($sql))
  {
  $id_tmp=$row["id_tmp"];
  $id_producto=$row["id_producto"];
  $codigo_producto=$row['codigo_producto'];
  $cantidad=$row['cantidad_tmp'];
  $nombre_producto=$row['nombre_producto'];
  $kilogramos=$row['kilogramos'];
  
  $precio_venta=$row['precio_tmp'];
  $precio_venta_f=number_format($precio_venta,2);//Formateo variables
  $precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
  $precio_total=$precio_venta_r*$cantidad;
  $precio_total_f=number_format($precio_total,2);//Precio total formateado
  $precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
  $sumador_total+=$precio_total_r;//Sumador
  if ($nums%2==0){
    $clase="clouds";
  } else {
    $clase="silver";
  }
  ?>

        <tr>
            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
            <td class='<?php echo $clase;?>' style="width: 53%; text-align: left"><?php echo $nombre_producto;?></td>
            <td class='<?php echo $clase;?>' style="width: 8%; text-align: left"><?php echo $kilogramos;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_venta_f;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>
            
        </tr>

  <?php 
  //Insert en la tabla detalle_cotizacion
  $insert_detail=mysqli_query($con, "INSERT INTO detalle_factura VALUES ('','$numero_factura','$id_producto','$cantidad','$precio_venta_r')");
  
  $nums++;
  }
  $impuesto=get_row('perfil','impuesto', 'id_perfil', 1);
  $subtotal=number_format($sumador_total,2,'.','');
  $total_iva=($subtotal * $impuesto )/100;
  $total_iva=number_format($total_iva,2,'.','');
  $total_factura=$subtotal+$total_iva;
?>
    
        <tr>
            <td colspan="4" style="widtd: 85%; text-align: right;">SUBTOTAL <?php echo $simbolo_moneda;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,2);?></td>
        </tr>
    <tr>
            <td colspan="4" style="widtd: 85%; text-align: right;">IVA (<?php echo $impuesto; ?>)% <?php echo $simbolo_moneda;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,2);?></td>
        </tr><tr>
            <td colspan="4" style="widtd: 85%; text-align: right;">TOTAL <?php echo $simbolo_moneda;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,2);?></td>
        </tr>
    </table>
  

		 
  <!-- Complemento --->
<style>
body {
font-family: Arial, sans-serif; /* Cambio de la fuente */
}
.tabla {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
    table-layout: fixed; /* Fijar el ancho de las columnas */
  }
 .tabla th, .tabla td {
    border: 5px solid #fff;
    padding: 6px; /* Ajuste del espacio alrededor del texto */
    text-align: justify; /* Justificar el texto */
    font-size: 12px; /* Tamaño de fuente original */
    word-wrap: break-word; /* Romper palabras largas */
}
 .tabla th {
    background-color: #f2f2f2;
    font-weight: bold; /* Añadir negrita al encabezado */
    word-wrap: break-word; /* Romper palabras largas */
  }
 .titulo {
    font-weight: bold;
    font-size: 12px; /* Ajuste del tamaño del título */
    margin-bottom: 6px;
    font-weight: bold;
  }
 .subtitulo {
   font-weight: bold;
   font-size: 10px; /* Ajuste del tamaño del título */
   margin-bottom: 6px;
  }
.dos-columnas {
  width: 100%;
  table-layout: fixed;
}

.dos-columnas td {
  width: 50%;
  vertical-align: top;
  word-wrap: break-word;
}
.contenido p {
  margin: 0;
}
.letra-pequena {
    font-size: 12px;
    padding: 1px;
    background-color: yellow; /* Añade un fondo amarillo */
}
</style>

<div>
  <div class="titulo">Tiempo de Entrega:</div>
<table class="table">
    <?php
    // Verificar si $tiempo_entrega está definido y no está vacío
    if (isset($tiempo_entrega) && !empty($tiempo_entrega)) {
        echo "<tr>";
        echo "<td class='letra-pequena text-center'>$tiempo_entrega</td>";
        echo "</tr>";
    } else {
        // Si $tiempo_entrega no está definido o está vacío, muestra un mensaje indicando que no hay tiempo_entrega disponible
        echo "<tr>";
        echo "<td class='letra-pequena text-center'>No hay tiempo de entrega para esta cotización.</td>";
        echo "</tr>";
    }
    ?>
</table>

      
<table class="table">
    <?php
    // Verificar si $nota está definido y no está vacío
    if (isset($nota) && !empty($nota)) {
        echo "<tr>";
        echo "<td class='letra-pequena text-center'>$nota</td>";
        echo "</tr>";
    } else {
        // Si $nota no está definido o está vacío, muestra un mensaje indicando que no hay nota disponible
        echo "<tr>";
        echo "<td class='letra-pequena text-center'>No hay observaciones para esta cotización.</td>";
        echo "</tr>";
    }
    ?>
</table>
</div>
</page>


<?php
$date=date("Y-m-d H:i:s");
$insert=mysqli_query($con,"INSERT INTO facturas VALUES (NULL,'".$numero_factura."','".$date."','".$id_cliente."','".$id_vendedor."','".$condiciones."','".$total_factura."','1','".$nota."','".$tiempo_entrega."')");
$delete=mysqli_query($con,"DELETE FROM tmp WHERE session_id='".$session_id."'");
?>