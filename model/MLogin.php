<?php

@session_start();
require_once $_SESSION['PATH'] . 'controller/controller.php';

class MLogin extends controller {
    /*
     * verificando login do usuario
     */

    public function validaAcesso_ori($arrDadosForm) {
        $this->sql = " SELECT id_usuario, str_nome, str_login, str_senha, id_perfil 
            FROM usuario
            WHERE str_login = '" . $arrDadosForm['str_login'] . "'
            AND str_senha   = '" . md5($arrDadosForm['str_senha']) . "'
            AND str_situacao = 'A'";
        return $this->query();
    }

    /*
     * verificando login do usuario
     */

    public function validaAcesso($arrDadosForm) {
       $this->sql = " SELECT * FROM gr_usuario as gu
           INNER JOIN gr_perfil as gp on gp.id_perfil = gu.id_perfil
            WHERE gu.str_login = '" . $arrDadosForm['str_login'] . "'";
        return $this->query();
       
    }

    /*
     * Valida permissão de acesso
     */

    public function permissoes($idPerfil) {
        $this->sql = "SELECT  a.id_acesso, a.id_view, a.id_perfil, a.cadastrar, a.alterar, a.visualizar, a.excluir, p.str_perfil, m.str_modulo, v.str_view
                    FROM gr_perfil as p
                    LEFT JOIN gr_acesso as a ON a.id_perfil = p.id_perfil
                    LEFT JOIN gr_view as v ON v.id_view = a.id_view
                    LEFT JOIN gr_modulo as m ON m.id_modulo = v.id_modulo
                    WHERE a.id_perfil = {$idPerfil}
                    ORDER BY a.id_acesso DESC";
        return $this->query();
    }

}

?>