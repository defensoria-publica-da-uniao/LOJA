<?php

@session_start();
require_once $_SESSION['PATH']. 'controller/controller.php';
class MPerfil extends controller{
    
    /*
     * Lista view pelo id do módulo
     */
    function listaViewPorModulo($idModulo){       
        $this->sql = "SELECT * FROM view WHERE id_modulo = {$idModulo}";
        return $this->query();
    }
	
}

?>