<?php

@session_start();
require_once $_SESSION['PATH'] . 'controller/controller.php';

class MMateriais extends controller {

    function listaMateriaisCompleto($parametro = null) {
        
        if (empty($parametro)) {
            $this->sql = "listaMateriaisCompleto";
        } else {
            $this->sql = "listaMateriaisCompleto $parametro";
        }
        
        return $this->query();
    }
    function listaAnexoPrincipal($idMaterial){
        
        $this->sql = "listaAnexoPrincipal '$idMaterial '";
        $consulta=$this->query();
        $dado= mssql_fetch_array($consulta);
        return $dado['str_nome_criptografado'];
        
        
    }
     function listaSolicitacaoMateriais($parametro,$parametro1,$parametro2) {
        
       $this->sql = "listaSolicitacaoMateriais $parametro, '$parametro1', '$parametro2'";

        return $this->query();
    
    }
    function listaSolicitacaoMateriaisCliente($parametro,$parametro1,$parametro2) {
        $idCliente=$_SESSION['LOGIN']['id_usuario'];
        
$this->sql = "listaSolicitacaoMateriaisCliente $idCliente,$parametro, '$parametro1', '$parametro2'";
        return $this->query();
    
    }
    
    function SolicitacaoMaterialDetalhada($par){
        $this->sql = "SolicitacaoMaterialDetalhada $par";
        
        return $this->query();
    }
    
    function MaterialGenericaUsuario($par){
        $this->sql = "MaterialGenericaUsuario $par";
      
        return $this->query();
    }
    
    function SelectGenericaEspecifica(){
        $this->sql = "SelectGenericaEspecifica";
        
        return $this->query();
    }
    
    function verificaResponsavel($id){
        $consulta = $this->listaDados('tb_solicitacao', $id,null, 'id_solicitacao');
        
        $dados = mssql_fetch_array($consulta);
        
        if($dados['id_responsavel'] == ''){
            return false;
        }else{
            return true;
        }
    }

  
    
    
    
    
}
