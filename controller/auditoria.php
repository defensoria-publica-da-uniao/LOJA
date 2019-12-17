<?php

    @session_start();
    require_once $_SESSION['PATH'] . 'model/MAuditoria.php';

    class Auditoria extends MAuditoria {

        function listar($arrDadosForm = null) {
            return $this->listarAuditoria();
        }
    }

    $oAuditoria = new Auditoria();
    $classe = 'Auditoria';
    $oBjeto = $oAuditoria;
    @include_once '../application/request.php';
?>