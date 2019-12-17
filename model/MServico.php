<?php

@session_start();
require_once $_SESSION['PATH']. 'controller/controller.php';
class MServico extends controller{
	

    function SelectGenericaEspecifica(){
        $this->sql = "SelectGenericaEspecifica";
        
        return $this->query();
    }
    function listaSolicitacaoServicos($parametro,$parametro1,$parametro2) {
        
       $this->sql = "listaSolicitacaoServico $parametro, '$parametro1', '$parametro2'";
 
        return $this->query();
    
    }
    function listaSolicitacaoServicosCliente($parametro,$parametro1,$parametro2) {
      $idCliente=$_SESSION['LOGIN']['id_usuario'];

        $this->sql = "listaSolicitacaoServicoCliente $idCliente,$parametro, '$parametro1', '$parametro2'";
 
        return $this->query();
    
    }
    
    function SolicitacaoServicoDetalhado($par){
        $this->sql = "SolicitacaoServicoDetalhado $par";
        
        return $this->query();
    }
    function ServicoGenericaUsuario($par) {
       $this->sql = "ServicoGenericaUsuario $par";
        
        return $this->query();
    }
    
    function Briefing($par) {
        $this->sql = "BriefingDetalhado $par";
        
        return $this->query();
    }
    
    function BriefingImg($par){
        $this->sql = "AnexoBriefing $par";
        
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

?>