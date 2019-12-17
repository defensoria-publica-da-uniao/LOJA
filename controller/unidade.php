<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MUnidade.php';

class Unidade extends MUnidade {

    function cadastrar($arrDadosForm) {
        
        //Retira espaços em brancos no inicio e fim
        $str_descricao = trim($arrDadosForm['str_descricao']);
        //Verifica se o campo unidade é vazio
        if (empty($str_descricao)) {
            $this->redirect('31', "unidade/listarUnidade");
        }
        else {
            //Verifica se unidade já esta cadastrada no sistema
            $result = $this->select_check($arrDadosForm['tabela'], 'str_descricao', "'$arrDadosForm[str_descricao]'");
            if ($result == 0) { //Caso não encontre nenhum perfil
                $result = $this->insert($arrDadosForm);
                $this->redirect('29', "unidade/listarUnidade");
            }
            else {
                $this->redirect('30', "unidade/listarUnidade");                
            }
        }
    }

    function alterar($arrDadosForm) {
        
         
        
        //Retira espaços em brancos no inicio e fim
        $str_descricao = trim($arrDadosForm['str_descricao']);
        //Verifica se o campo é vazio
        if (empty($str_descricao)) {
            $this->redirect('31', "unidade/listarUnidade");
        }
        else {
            //Verifica se unidade já esta cadastrada no sistema
            $result = $this->select_check($arrDadosForm['tabela'], 'str_descricao', "'$arrDadosForm[str_descricao]'");
            if ($result == 0) { //Caso não encontre nenhum perfil
                $result = $this->update($arrDadosForm);
                $this->redirect('29', "unidade/listarUnidade");
            }
            else {
                $this->redirect('30', "unidade/listarUnidade");                
            }
        }
    }

    function listar($arrDadosForm = null) {
        if (isset($arrDadosForm['idUnidade']) and $arrDadosForm['acao'] == 'ajax') {
            $result = $this->listarUnidade($_POST['idUnidade']);
            while ($arDados = mssql_fetch_array($result)) {
                $arr['id_unidade'] = $arDados['id_unidade'];
                $arr['id_estado'] = $arDados['id_estado'];
                $arr['descricao'] = $arDados['str_descricao'];
                $arr['email'] = $arDados['str_email'];
                $arr['situacao'] = $arDados['str_situacao'];
                $arr['uf'] = $arDados['str_uf'];
            }
            echo json_encode($arr);
        } else {
            return $this->listarTodasUnidades();
        }
    }

    function desativar($arrDadosForm) {
        (($arrDadosForm['str_situacao'] == 'D') ? $arrDadosForm['str_situacao'] = 'A' : $arrDadosForm['str_situacao'] = 'D' );
        $arrDadosForm['str_situacao'];
        $result = $this->update($arrDadosForm);
        $this->redirect('1', "unidade/listarUnidade");
    }
    
    function listarEstados($arrDadosForm = null) {
        return $this->listaDados('tb_estado', null, 'str_estado');
    }

}

$oUnidade = new Unidade();
$classe = 'Unidade';
$oBjeto = $oUnidade;
@include_once '../application/request.php';
?>