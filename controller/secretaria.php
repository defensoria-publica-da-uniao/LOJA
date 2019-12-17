<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MSecretaria.php';

class Secretaria extends MSecretaria {

    function cadastrar($arrDadosForm) {
        
        //Retira espaços em brancos no inicio e fim
        $str_descricao = trim($arrDadosForm['str_descricao']);
        //Verifica se o campo unidade é vazio
        if (empty($str_descricao)) {
            $this->redirect('34', "secretaria/listarSecretaria");
        }
        else {
            //Verifica se unidade já esta cadastrada no sistema
            $result = $this->select_check($arrDadosForm['tabela'], 'str_descricao', "'$arrDadosForm[str_descricao]'");
            if ($result == 0) { //Caso não encontre nenhum perfil
                $result = $this->insert($arrDadosForm);
                $this->redirect('32', "secretaria/listarSecretaria");
            }
            else {
                $this->redirect('33', "secretaria/listarSecretaria");                
            }
        }
    }

    function alterar($arrDadosForm) {
        
        //Retira espaços em brancos no inicio e fim
        $str_descricao = trim($arrDadosForm['str_descricao']);
        //Verifica se o campo perfil é vazio
        if (empty($str_descricao)) {
            $this->redirect('34', "secretaria/listarSecretaria");
        }
        else {
            //Verifica se secretaria (descricao) já esta cadastrada no sistema
            $result = $this->select_check($arrDadosForm['tabela'], 'str_descricao', "'$arrDadosForm[str_descricao]'");
            //Verifica se secretaria (sigla) já esta cadastrada no sistema
            $result2 = $this->select_check($arrDadosForm['tabela'], 'str_sigla', "'$arrDadosForm[str_sigla]'");
            if (($result == 0) || ($result2 == 0)) { //Caso não encontre nenhum perfil
                $result = $this->update($arrDadosForm);
                $this->redirect('32', "secretaria/listarSecretaria");
            }
            else {
                $this->redirect('33', "secretaria/listarSecretaria");
            }
        }
    }

    function listar($arrDadosForm = null) {
        if (isset($arrDadosForm['idSecretaria']) and $arrDadosForm['acao'] == 'ajax') {
            $result = $this->listarSecretaria($_POST['idSecretaria']);
            while ($arDados = mssql_fetch_array($result)) {
                $arr['id_secretaria'] = $arDados['id_secretaria'];
                $arr['id_secretaria_pai'] = $arDados['id_secretaria_pai'];
                $arr['sigla'] = $arDados['str_sigla'];
                $arr['email'] = $arDados['str_email'];
                $arr['situacao'] = $arDados['str_situacao'];
                $arr['descricao'] = $arDados['str_descricao'];
            }
            echo json_encode($arr);
        } else {
            return $this->listarTodasSecretarias();
        }
    }

    function desativar($arrDadosForm) {
        (($arrDadosForm['str_situacao'] == 'D') ? $arrDadosForm['str_situacao'] = 'A' : $arrDadosForm['str_situacao'] = 'D' );
        $arrDadosForm['str_situacao'];
        $result = $this->update($arrDadosForm);
        $this->redirect('1', "secretaria/listarSecretaria");
    }
    
}

$oSecretaria = new Secretaria();
$classe = 'Secretaria';
$oBjeto = $oSecretaria;
@include_once '../application/request.php';
?>