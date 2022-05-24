<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro de estancias UNAB</title>
        <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <?php
            $raw_get = $_SERVER["QUERY_STRING"];
            if ($raw_get !== "") {
                //Se redirecciona a la página de identificación
                ?>
                <form id="frm_llamar_identificacion" name="frm_llamar_identificacion" target="_self" method="post" action="registro/identificacion.php?<?= $raw_get ?>"></form>
                <script type="text/javascript">
                    $("#frm_llamar_identificacion").submit();
                </script>
                <?php
            }
            ?>
        </div>
    </body>
</html>
