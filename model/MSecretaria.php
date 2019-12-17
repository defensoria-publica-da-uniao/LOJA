<?php

@session_start();
require_once $_SESSION['PATH']. 'controller/controller.php';

class MSecretaria extends controller{
    
    function listarSecretaria($id = null) {
        
        (($id>0) ? $where = " WHERE gs.id_secretaria = {$id}" : $where = null);

        $this->sql = " SELECT gs.*
                    FROM gr_secretaria AS gs
                    $where";
           
        return $this->query();

    }

    function listarTodasSecretarias() {
        
        $this->sql = "SELECT gs.* FROM gr_secretaria AS gs
        ORDER BY str_sigla ASC";
        
        return $this->query();
    }

}

?>