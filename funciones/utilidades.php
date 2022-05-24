<?php

class Utilidades {

    public function decodificar_raw_response($raw_response) {
        $lista_pares = array();
        try {
            $response_aux = $this->str_decode(base64_decode($raw_response));
            $arr_aux = explode("&", $response_aux);

            foreach ($arr_aux as $par_aux) {
                $par_aux = explode("=", $par_aux);
                $lista_pares[$par_aux[0]] = $par_aux[1];
            }
        } catch (Exception $ex) {
            $lista_pares = array();
        }

        return $lista_pares;
    }

    function str_encode($texto) {
        $texto_rta = str_replace("+", "|PLUS|", $texto);
        $texto_rta = str_replace(chr(10), "|ENTER|", $texto_rta);
        $texto_rta = str_replace("&", "|AMP|", $texto_rta);
        $texto_rta = str_replace("'", "", $texto_rta);
        $texto_rta = str_replace('"', "", $texto_rta);

        return $texto_rta;
    }

    function str_decode($texto) {
        $texto_rta = str_replace("|PLUS|", "+", $texto);
        $texto_rta = str_replace("|ENTER|", chr(10), $texto_rta);
        $texto_rta = str_replace("|AMP|", "&", $texto_rta);
        $texto_rta = str_replace("'", "", $texto_rta);
        $texto_rta = str_replace('"', "", $texto_rta);

        return $texto_rta;
    }

    function llamar_registro_estancia($id_aula, $id_persona) {
        //Se crea o renueva la cookie de la persona
        setcookie("usuario_unab_estancia", $id_persona, time() + (86400 * 3652), "/");

        $raw_get = base64_encode("id_aula=" . $id_aula . "&id_persona=" . $id_persona);
        ?>
        <form id="frm_llamar_registro_estancia" name="frm_llamar_registro_estancia" target="_self" method="post" action="../registro/estancia.php?<?= $raw_get ?>"></form>
        <script type="text/javascript">
            $("#frm_llamar_registro_estancia").submit();
        </script>
        <?php
    }

}
?>
