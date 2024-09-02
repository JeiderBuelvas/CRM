<?php
include 'is_logged.php'; // Archivo verifica que el usuario que intenta acceder a la URL est� logueado
$id_factura = $_SESSION['id_factura'];
// Inicia validaci�n del lado del servidor
if (empty($_POST['id_cliente'])) {
    $errors[] = "ID vac�o";
} else if (empty($_POST['id_vendedor'])) {
    $errors[] = "Selecciona el vendedor";
} else if (empty($_POST['condiciones'])) {
    $errors[] = "Selecciona forma de pago";
} else if ($_POST['estado_factura'] == "") {
    $errors[] = "Selecciona el estado de la cotizaci�n";
} else if (!empty($_POST['id_cliente']) && !empty($_POST['id_vendedor']) && !empty($_POST['condiciones']) && $_POST['estado_factura'] != "") {
    /* Connect To Database */
    require_once "../config/db.php"; // Contiene las variables de configuraci�n para conectar a la base de datos
    require_once "../config/conexion.php"; // Contiene funci�n que conecta a la base de datos

    // Escapando y eliminando todo lo que podr�a ser c�digo (html/javascript)
    $id_cliente = intval($_POST['id_cliente']);
    $id_vendedor = intval($_POST['id_vendedor']);
    $condiciones = intval($_POST['condiciones']);
    $estado_factura = intval($_POST['estado_factura']);
    $nota = $_POST['nota'];
    $tiempo_entrega = $_POST['tiempo_entrega'];

    // Actualiza la factura
    $sql = "UPDATE facturas SET id_cliente='" . $id_cliente . "', id_vendedor='" . $id_vendedor . "', condiciones='" . $condiciones . "', estado_factura='" . $estado_factura . "', nota='" . $nota . "', tiempo_entrega='" . $tiempo_entrega . "' WHERE id_factura='" . $id_factura . "'";
    $query_update = mysqli_query($con, $sql);

    if ($query_update) {
        $messages[] = "Cambio realizado...";
    } else {
        $errors[] = "Lo siento, algo ha salido mal. Intenta nuevamente." . mysqli_error($con);
    }
} else {
    $errors[] = "Error desconocido.";
}

// Mostrar errores
if (isset($errors)) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>
        <?php foreach ($errors as $error) { echo '<div>' . htmlspecialchars($error) . '</div>'; } ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php }

// Mostrar mensajes
if (isset($messages)) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>�xito!</strong>
        <?php foreach ($messages as $message) { echo '<div>' . htmlspecialchars($message) . '</div>'; } ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
