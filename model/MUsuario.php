<?php

@session_start();
require_once $_SESSION['PATH']. 'controller/controller.php';
class MUsuario extends controller{
    
    function listarUsuario($id=null, $order=null){
        (($id>0) ? $where = " WHERE id_usuario = {$id}" : $where = null);
           ((!empty($order)) ? $order = " ORDER BY str_nome " : $order = null);

       $this->sql = " SELECT u.*, p.str_perfil
               FROM gr_usuario as u
               LEFT JOIN gr_perfil as p on p.id_perfil = u.id_perfil
               $where
               $order"; 
           
           return $this->query();
    }
    
    function listarUnidade() {
        
        $this->sql = "SELECT id_unidade, str_descricao, str_email, str_uf FROM tb_unidade AS tu
        INNER JOIN tb_estado AS te ON te.id_estado = tu.id_estado
        ORDER BY str_uf ASC";
        
        return $this->query();
    }
    
    function listaAuditoria(){

        $this->sql="listaAuditoria";
         return $this->query();

    }
    
}

?>