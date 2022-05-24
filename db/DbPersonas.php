<?php

require_once("DbConexion.php");

class DbPersonas extends DbConexion {

    //Muestra el listado completo de convenios
    public function get_persona_codigo($cod_persona) {
        try {
            $sql = "SELECT * FROM tbl_personas
                    WHERE cod_persona='" . $cod_persona . "'";

            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }

    public function crear_persona($cod_persona, $nombres, $apellidos, $e_mail, $tipo_persona) {
        try {
            $sql = "CALL pa_crear_persona('" . $cod_persona . "', '" . $nombres . "', '" . $apellidos . "', '" . $e_mail . "', " . $tipo_persona . ", @id)";
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
