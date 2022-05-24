<?php
require_once("db/DbAulas.php");
require_once("funciones/utilidades.php");
require_once("funciones/phpqrcode/qrlib.php");

$db_aulas = new DbAulas();
$utilidades = new Utilidades();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <style>
            @media print {
                .saltopagina .row {
                    page-break-before: always;
                }
            }
        </style>
    </head>
    <body>
        <div class="container-fluid saltopagina">

            <?php
            //Se obtiene el listado de aulas
            $lista_aulas = $db_aulas->get_lista_aulas();

            $url_base = "http://200.116.209.206/registro_unab/index.php";
            foreach ($lista_aulas as $i => $aula_aux) {
            if ($i % 4 == 0) {
            ?>
            <div class="row">
                <?php
                }
                ?>
                <div class="col-6" style="text-align:center;">
                    <div class="card w-100" style="margin-bottom:20px;">
                        <h5 class="card-title">
                            <?= $aula_aux["id_aula"] . " - " . $aula_aux["nombre_aula"] . " - " . $aula_aux["nombre_edificio"] . " - " . $aula_aux["nombre_sede"] ?>
                        </h5>
                        <?php
                        $url_qr = $url_base . "?" . base64_encode("aula=" . $aula_aux["id_aula"]);
                        $imagen_qr = "imagenes/qr/codigo" . $aula_aux["id_aula"] . ".png";
                        QRcode::png($url_qr, $imagen_qr, "H", "5");
                        ?>
                        <img src="<?= $imagen_qr ?>" title="QR" class="card-img-top"/>
                    </div>
                </div>
                <?php
                if ($i % 4 == 3 || $i == count($lista_aulas) - 1) {
                ?>
            </div>
            <?php
            }
            }
            ?>
        </div>
    </body>
</html>
