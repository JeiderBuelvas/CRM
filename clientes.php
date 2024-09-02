<?php
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}

/* Connect To Database*/
require_once("config/db.php"); // Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); // Contiene funcion que conecta a la base de datos

$active_facturas = "";
$active_productos = "";
$active_clientes = "active";
$active_usuarios = "";
$title = "Clientes";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("head.php"); ?>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif; /* Aplicar la fuente de Google */
            background-color: #f5f5f5; /* Color de fondo suave */
        }
        .panel {
            margin: 20px; /* Margen alrededor del panel */
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra para el panel */
            background-color: #ffffff; /* Fondo blanco */
        }
        .panel-heading {
            background-color: #007bff; /* Color de fondo azul */
            color: white; /* Texto blanco */
            padding: 15px; /* Espaciado interno */
            border-top-left-radius: 8px; /* Bordes redondeados superiores */
            border-top-right-radius: 8px; /* Bordes redondeados superiores */
        }
        .btn-group .btn {
            margin-left: 10px; /* Espacio entre botones */
        }
        .form-control {
            border-radius: 20px; /* Bordes redondeados en los inputs */
            border: 1px solid #ccc; /* Borde gris */
            padding: 10px; /* Espaciado interno */
        }
        .btn-default {
            border-radius: 20px; /* Bordes redondeados para el botón de búsqueda */
            background-color: #f0f0f0; /* Fondo gris claro */
            color: #333; /* Color de texto */
        }
        .btn-info {
            border-radius: 20px; /* Bordes redondeados */
        }
        h4 {
            margin: 0; /* Eliminar márgenes del encabezado */
        }
        .form-group {
            margin-bottom: 15px; /* Espacio entre grupos de formulario */
        }
        #resultados, .outer_div {
            margin-top: 20px; /* Margen superior para resultados */
            background-color: #f9f9f9; /* Fondo gris claro */
            padding: 15px; /* Espaciado interno */
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1); /* Sombra ligera */
        }
    </style>
</head>
<body>
    <?php include("navbar.php"); ?>
    
    <div class=""> <!-- se quita el container -->
        <div class="panel panel-info">
            <div class="panel">
                <div class="btn-group pull-right">
                    <button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoCliente">
                        <span class="glyphicon glyphicon-plus"></span> Nuevo Cliente
                    </button>
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Buscar Clientes</h4>
            </div>
            <div class="panel-body">
                <?php
                include("modal/registro_clientes.php");
                include("modal/editar_clientes.php");
                ?>
                <form class="form-horizontal" role="form" id="datos_cotizacion">
                    <div class="form-group row">
                        <label for="q" class="col-md-2 control-label">Cliente</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="q" placeholder="Nombre del cliente" onkeyup='load(1);'>
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
    <script type="text/javascript" src="js/clientes.js"></script>
</body>
</html>
