<?php

require_once("DbConexion.php");

class DbAulas extends DbConexion {

    //Muestra el listado completo de convenios
    public function get_lista_aulas() {
        try {
            $sql = "SELECT A.*, E.nombre_edificio, S.nombre_sede
                    FROM tbl_aulas A
                    INNER JOIN tbl_edificios E ON A.id_edificio=E.id_edificio
                    INNER JOIN tbl_sedes S ON E.id_sede=S.id_sede
                    ORDER BY A.id_aula
                    LIMIT 5";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }

}

?>
