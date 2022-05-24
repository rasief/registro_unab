<?php

require_once("DbConexion.php");

class DbEstancias extends DbConexion {

    public function crear_editar_estancia($id_persona, $id_aula, $tipo_estancia) {
        try {
            $sql = "CALL pa_crear_editar_estancia(" . $id_persona . ", " . $id_aula . ", " . $tipo_estancia . ", @id)";
            //echo($sql);

            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_persona = $arrResultado["@id"];

            return $id_persona;
        } catch (Exception $e) {
            return array();
        }
    }

}

?>
