<?php

@session_start();
require_once $_SESSION['PATH']. 'controller/controller.php';
class MAuditoria extends controller{
	
    function listarAuditoria(){
       $this->sql = "SELECT aud.*, gen.str_descricao
                     FROM aud_auditoria AS aud
                     LEFT JOIN aud_generica_tabela AS gen ON gen.id_generica_tabela = aud.id_generica_tabela"; 
           
        return $this->query();
    }
    
}

?>