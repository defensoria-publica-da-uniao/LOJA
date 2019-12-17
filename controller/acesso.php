<?php
@session_start();
require_once $_SESSION['PATH'].'model/MAcesso.php';
class Acesso extends MAcesso{ 
    
    function cadastrar($arrDadosForm=null){ 
        
        
       $result =  $this->deletaPermissoes();
       if($result){
        
            $arDados['tabela'] = $arrDadosForm['tabela'];
            $arDados['method'] = $arrDadosForm['method'];

            for($p=0; $p < count($arrDadosForm['id_perfil']); $p++ ){
                $arDados['id_perfil'] = $arrDadosForm['id_perfil'][$p];

                for($i=0; $i < count($arrDadosForm[$p]['id_view']); $i++ ){
                    $arDados['id_view'] = $arrDadosForm[$p]['id_view'][$i];
                    $idView = $arDados['id_view'];
                    echo $arrDadosForm[$p]['cadastrar'][$idView];
                    (($arrDadosForm[$p]['cadastrar'][$idView] == 'S') ? $arDados['cadastrar'] = '1' : $arDados['cadastrar'] = '0');
                    (($arrDadosForm[$p]['alterar'][$idView] == 'S') ? $arDados['alterar'] = '1' : $arDados['alterar'] = '0');
                    (($arrDadosForm[$p]['excluir'][$idView] == 'S') ? $arDados['excluir'] = '1' : $arDados['excluir'] = '0');
                    (($arrDadosForm[$p]['visualizar'][$idView] == 'S') ? $arDados['visualizar'] = '1' : $arDados['visualizar'] = '0');
                   
                     $this->insert($arDados);
                }
            } 
            $this->redirect('1', "acesso/listarAcesso");
       } else{
            $this->redirect('2', "acesso/listarAcesso");
       }
    }

   
}

$oAcesso = new Acesso();
$classe = 'Acesso';
$oBjeto = $oAcesso;
@include_once '../application/request.php';


?>