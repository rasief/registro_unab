<?php
require_once("../funciones/utilidades.php");

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
        <script src="identificacion.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <?php
            $bol_principio = true;
            if (isset($_REQUEST["txt_id_prev1"])) {
                $cod_persona = $utilidades->str_decode($_REQUEST["txt_id_prev1"]);
                $cod_persona2 = $utilidades->str_decode($_REQUEST["txt_id_prev2"]);
                $id_aula = $utilidades->str_decode($_REQUEST["hdd_aula"]);

                if ($cod_persona === $cod_persona2) {
                    $bol_principio = false;

                    //Se redirecciona al formulario de registro
                    $raw_get = base64_encode("id_aula=" . $id_aula . "&cod_persona=" . $cod_persona);
                    ?>
                    <form id="frm_enviar_registro" name="frm_enviar_registro" target="_self" method="post" action="registro.php?<?= $raw_get ?>"></form>
                    <script type="text/javascript">
                        $("#frm_enviar_registro").submit();
                    </script>
                    <?php
                }
            }

            if ($bol_principio) {
                $raw_get = $_SERVER["QUERY_STRING"];
                if ($raw_get !== "") {
                    $lista_get = $utilidades->decodificar_raw_response($raw_get);

                    //Se verifica si ya está registrada la cookie del usuario
                    if (isset($_COOKIE["usuario_unab_estancia"])) {
                        //Se redirecciona a la página de registro de estancia
                        $utilidades->llamar_registro_estancia($lista_get["aula"], $_COOKIE["usuario_unab_estancia"]);
                    } else {
                        //Se debe solicitar el identificador del usuario
                        ?>
                    <form id="frm_prev" name="frm_prev" target="_self" method="post" action="identificacion.php">
                            <input type="hidden" id="hdd_aula" name="hdd_aula" value="<?= $lista_get["aula"] ?>"/>
                            <div id="d_in_id1" class="d-block">
                                <div class="alert alert-warning mt-3" role="alert">
                                    Por favor ingresa tu <b>n&uacute;mero de identificaci&oacute;n</b> (cedula de ciudadan&iacute;a, pasaporte, etc.)
                                </div>
                                <div id="d_error_id1" class="alert alert-danger d-none" role="alert"></div>
                                <input type="text" id="txt_id_prev1" name="txt_id_prev1" class="form-control"/>
                                <button type="button" id="btn_aceptar_prev1" name="btn_aceptar_prev1" class="btn btn-warning w-100 my-3">Aceptar</button>
                            </div>
                            <div id="d_in_id2" class="d-none">
                                <div class="alert alert-warning mt-3" role="alert">
                                    Por favor ingresa tu <b>n&uacute;mero de identificaci&oacute;n</b> nuevamente
                                </div>
                                <div id="d_error_id2" class="alert alert-danger d-none" role="alert"></div>
                                <input type="text" id="txt_id_prev2" name="txt_id_prev2" class="form-control"/>
                                <button type="button" id="btn_aceptar_prev2" name="btn_aceptar_prev2" class="btn btn-warning w-100 my-3">Aceptar</button>
                            </div>
                        </form>
                        <?php
                    }
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
