<?php

@session_start();
require_once $_SESSION['PATH'] . 'controller/controller.php';

class MView extends controller {
    /*
     * Lista Views
     */

    public function listarView($id = null, $order = null) {
        (($id > 0) ? $where = " WHERE id_view = {$id}" : $where = null);
        ((!empty($order)) ? $order = " ORDER BY str_view " : $order = null);

        $this->sql = " SELECT v.id_view, v.id_modulo, v.str_view, m.str_modulo
                FROM gr_view as v
                INNER JOIN gr_modulo as m on m.id_modulo = v.id_modulo
                $where
                $order";
        return $this->query();
    }

    /*
     * Deleta view com o gr_acessos respectivos
     */

    public function deleteView($arrDadosForm) {
        $tabela = $arrDadosForm['tabela'];
        $id = $arrDadosForm['id'];
        $campo = $arrDadosForm['campo_where'];
        unset($arrDadosForm['tabela']);
        unset($arrDadosForm['id']);
        unset($arrDadosForm['campo_where']);

        $this->sql = "DELETE FROM gr_acesso WHERE id_view = '$id'";
        $this->query();
        $this->sql = " DELETE FROM $tabela WHERE $campo in ('$id')";
        return $this->query();
    }

}

?>