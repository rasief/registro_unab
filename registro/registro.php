<?php
require_once("../db/DbPersonas.php");
require_once("../funciones/utilidades.php");

$db_personas = new DbPersonas();
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
        <script src="registro.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <?php
            $bol_principio = true;
            if (isset($_REQUEST["txt_nombres"])) {
                $bol_principio = false;

                //Se registra la persona
                $id_aula = $utilidades->str_decode($_REQUEST["hdd_aula"]);
                $cod_persona = $utilidades->str_decode($_REQUEST["hdd_persona"]);
                $nombres = $utilidades->str_decode($_REQUEST["txt_nombres"]);
                $apellidos = $utilidades->str_decode($_REQUEST["txt_apellidos"]);
                $e_mail = $utilidades->str_decode($_REQUEST["txt_e_mail"]);
                $tipo_persona = $utilidades->str_decode($_REQUEST["rad_tipo_persona"]);

                $id_persona = $db_personas->crear_persona($cod_persona, $nombres, $apellidos, $e_mail, $tipo_persona);

                if ($id_persona > 0) {
                    //Se redirecciona a la página de registro de estancia
                    $utilidades->llamar_registro_estancia($id_aula, $id_persona);
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
                    $id_aula = $lista_get["id_aula"];
                    $cod_persona = $lista_get["cod_persona"];

                    //Se verifica si la persona ya está registrada en la base de datos
                    $persona_obj = $db_personas->get_persona_codigo($cod_persona);

                    if (isset($persona_obj["id_persona"])) {
                        //Se redirecciona a la página de registro de estancia
                        $utilidades->llamar_registro_estancia($id_aula, $persona_obj["id_persona"]);
                    } else {
                        //La persona no existe, se muestra el formulario de registro
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Por favor registra los siguientes datos
                        </div>
                        <div id="d_error_registro" class="alert alert-danger d-none" role="alert"></div>
                        <form id="frm_registro" name="frm_registro" target="_self" method="post" action="registro.php">
                            <input type="hidden" id="hdd_aula" name="hdd_aula" value="<?= $id_aula ?>"/>
                            <input type="hidden" id="hdd_persona" name="hdd_persona" value="<?= $cod_persona ?>"/>
                            <div class="row">
                                <div class="col-md-4">
                                    <label><b>N&uacute;mero de identificaci&oacute;n:</b></label>
                                </div>
                                <div class="col-md-8">
                                    <label><?= $cod_persona ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="my-md-3"><b>Nombres:</b></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="txt_nombres" name="txt_nombres" class="form-control my-md-2" maxlength="100"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="my-md-3"><b>Apellidos:</b></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="txt_apellidos" name="txt_apellidos" class="form-control my-md-2" maxlength="100"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="my-md-3"><b>e-mail:</b></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" id="txt_e_mail" name="txt_e_mail" class="form-control my-md-2" maxlength="100"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="my-md-3"><b>Vinculaci&oacute;n UNAB:</b></label>
                                </div>
                                <div class="col-md-8">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="rad_interno" name="rad_tipo_persona" value="1" class="custom-control-input"/>
                                        <label class="custom-control-label" for="rad_interno">Estudiante, docente o administrativo</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="rad_externo" name="rad_tipo_persona" value="2" class="custom-control-input"/>
                                        <label class="custom-control-label" for="rad_externo">Persona externa</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <button type="button" id="btn_registrar" name="btn_registrar" class="btn btn-warning w-100 my-3">Aceptar</button>
                                </div>
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
