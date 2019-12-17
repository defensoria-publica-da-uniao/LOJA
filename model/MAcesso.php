<?php

@session_start();
require_once $_SESSION['PATH']. 'controller/controller.php';
class MAcesso extends controller{
    
    /*
     * Lista view pelo id do módulo
     */
    function listaViewPorModulo($idModulo){       
        $this->sql = "SELECT * FROM gr_view WHERE id_modulo = {$idModulo}";
        return $this->query();
    }
    
    /*
     * Lista acessos cadastrados
     */
    function listaPermissoes(){
        $this->sql = "SELECT  a.id_acesso, a.id_view, a.id_perfil, a.cadastrar, a.alterar, a.visualizar, a.excluir,
                        p.str_perfil, m.str_modulo, v.str_view
                    FROM gr_perfil as p
                    LEFT JOIN gr_acesso as a ON a.id_perfil = p.id_perfil
                    LEFT JOIN gr_view as v ON v.id_view = a.id_view
                    LEFT JOIN gr_modulo as m ON m.id_modulo = v.id_modulo
                    ORDER BY a.id_acesso DESC";
        return $this->query();
    }
    
    /*
     * Deleta permissões
     */
    function deletaPermissoes(){
        $this->sql = "DELETE FROM gr_acesso";
        return $this->query();
    }
	
}

?>