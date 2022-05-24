<?php
require_once("../db/DbEstancias.php");
require_once("../funciones/utilidades.php");

$db_estancias = new DbEstancias();
$utilidades = new Utilidades();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro de estancias UNAB</title>
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="../js/funciones.js" type="text/javascript"></script>
        <script src="estancia.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container alto-completo">
            <?php
            $bol_principio = true;
            if (isset($_REQUEST["hdd_tipo_estancia"])) {
                $bol_principio = false;
                
                $id_persona = $_REQUEST["hdd_persona"];
                $id_aula = $_REQUEST["hdd_aula"];
                $tipo_estancia = $_REQUEST["hdd_tipo_estancia"];
                
                $id_estancia = $db_estancias->crear_editar_estancia($id_persona, $id_aula, $tipo_estancia);
                
                if ($id_estancia > 0) {
                    ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        <?= ($tipo_estancia == "1" ? "Entrada" : "Salida") ?> registrada con &eacute;xito
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Ocurri&oacute; un error al registrar la informaci&oacute;n, por favor verifica tus datos e int&eacute;ntalo nuevamente
                    </div>
                    <?php
                }
            }

            if ($bol_principio) {
                $raw_get = $_SERVER["QUERY_STRING"];
                if ($raw_get !== "") {
                    $lista_get = $utilidades->decodificar_raw_response($raw_get);
                    ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Por favor indica si est&aacute;s entrando o saliendo
                    </div>
                    <div class="row">
                        <div class="col-xl">
                            <button id="btn_entrada" name="btn_entrada" class="btn btn-success w-100 py-5">Entrada</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl">
                            <button id="btn_salida" name="btn_salida" class="btn btn-danger w-100 py-5 mt-3">Salida</button>
                        </div>
                    </div>
                    <div class="d-none">
                        <form id="frm_registro_estancia" name="frm_registro_estancia" target="_self" method="post" action="estancia.php">
                            <input type="hidden" id="hdd_persona" name="hdd_persona" value="<?= $lista_get["id_persona"] ?>"/>
                            <input type="hidden" id="hdd_aula" name="hdd_aula" value="<?= $lista_get["id_aula"] ?>"/>
                            <input type="hidden" id="hdd_tipo_estancia" name="hdd_tipo_estancia" value=""/>
                        </form>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        No deber&iacute;as estar aqu&iacute;
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <script type="text/javascript">
            iniciar();
        </script>
    </body>
</html>
