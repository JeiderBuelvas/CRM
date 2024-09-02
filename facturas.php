<?php
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}

$active_facturas = "active";
$active_productos = "";
$active_clientes = "";
$active_usuarios = "";    
$title = "CRM - Polyuprotec S.A";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("head.php"); ?>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif; /* Aplicar la fuente de Google */
        }
        .panel {
            margin: 20px; /* Margen alrededor del panel */
            border-radius: 8px; /* Bordes redondeados */
        }
        .panel-heading {
            background-color: #ffffff; /* Color de fondo blanco */
            border-bottom: 2px solid #007bff; /* Línea inferior */
        }
        .btn-group .btn {
            margin-left: 10px; /* Espacio entre botones */
        }
        .form-control {
            border-radius: 20px; /* Bordes redondeados en los inputs */
        }
        .btn-danger {
            background-color: #dc3545; /* Color de fondo del botón de exportar */
            border-color: #dc3545; /* Color del borde */
        }
        .btn-info {
            background-color: #17a2b8; /* Color de fondo del botón de nueva orden */
            border-color: #17a2b8; /* Color del borde */
        }
        .btn-default {
            border-radius: 20px; /* Bordes redondeados para el botón de búsqueda */
        }
        h4 {
            margin: 0; /* Eliminar márgenes del encabezado */
        }
    </style>
</head>
<body>
    <?php include("navbar.php"); ?>  
    <div class=""> <!-- se quita el container -->
        <div class="panel panel-info">
            <div class="panel">
                <div class="btn-group pull-right">
                    <a class="btn btn-danger" onclick="exportToExcel()">Exportar a Excel</a>
                    <a href="nueva_factura.php" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Nueva Orden de trabajo</a>
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Buscar O.T</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="datos_cotizacion">
                    <div class="form-group row">
                        <label for="q" class="col-md-2 control-label">Cliente o/y de O.T</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="q" placeholder="Cliente o/y de O.T" onkeyup='load(1);'>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-default" onclick='load(1);'>
                                <span class="glyphicon glyphicon-search"></span> Buscar
                            </button>
                            <span id="loader"></span>
                        </div>
                    </div>
                </form>
                <div id="resultados"></div><!-- Carga los datos ajax -->
                <div class='outer_div'></div><!-- Carga los datos ajax -->
            </div>
        </div>
    </div>
    <hr>
    <?php include("footer.php"); ?>
    <script type="text/javascript" src="js/VentanaCentrada.js"></script>
    <script type="text/javascript" src="js/facturas.js"></script>
</body>
</html>
