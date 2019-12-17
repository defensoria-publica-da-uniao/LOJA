<?php

@session_start();
require_once $_SESSION['PATH'] . 'controller/controller.php';

class MModulo extends controller {

    function verificaModulo($tabela, $modulo) {
        $this->sql = "SELECT * FROM $tabela WHERE str_modulo = '$modulo'";
        return $this->query();
    }

}

?>