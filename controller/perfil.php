<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MPerfil.php';

class Perfil extends MPerfil {

    function cadastrar($arrDadosForm = null) {
        $result = $this->insert($arrDadosForm);
        $this->redirect('1', "perfil/listarPerfil");
    }

    function alterar($arrDadosForm) {
        $result = $this->update($arrDadosForm);
        $this->redirect('1', "perfil/listarPerfil");
    }

    function listar($arrDadosForm = null) {
        if (isset($arrDadosForm['idPerfil']) and $arrDadosForm['acao'] == 'ajax') {
            $result = $this->listaDados('gr_perfil', $_POST['idPerfil'], 'str_perfil', 'id_perfil');
            while ($arDados = mssql_fetch_array($result)) {
                $arr['id'] = $arDados['id_perfil'];
                $arr['perfil'] = $arDados['str_perfil'];
            }
            echo json_encode($arr);
        } else {
            return $this->listaDados('gr_perfil', null, 'str_perfil');
        }
    }

    function permissaoAcesso($arrDadosForm = null) {


        $arDados['tabela'] = $arrDadosForm['tabela'];
        $arDados['method'] = $arrDadosForm['method'];

        for ($p = 0; $p < count($arrDadosForm['id_perfil']); $p++) {
            $arDados['id_perfil'] = $arrDadosForm['id_perfil'][$p];

            for ($i = 0; $i < count($arrDadosForm[$p]['id_view']); $i++) {

                $arDados['id_view'] = $arrDadosForm[$p]['id_view'][$i];
                (($arrDadosForm[$p]['cadastrar'][$i] == 'S') ? $arDados['cadastrar'] = '1' : $arDados['cadastrar'] = 0);
                (($arrDadosForm[$p]['alterar'][$i] == 'S') ? $arDados['alterar'] = '1' : $arDados['alterar'] = 0);
                (($arrDadosForm[$p]['excluir'][$i] == 'S') ? $arDados['excluir'] = '1' : $arDados['excluir'] = 0);
                (($arrDadosForm[$p]['visualizar'][$i] == 'S') ? $arDados['visualizar'] = '1' : $arDados['visualizar'] = 0);
                $this->insert($arDados);
            }
        }
        $this->redirect('1', "perfil/acesso");
    }

    function deletar($arrDadosForm) {
        $result = $this->delete($arrDadosForm);
        if ($result == true) {
            $this->redirect('1', "perfil/listarPerfil");
        } else {
            $this->redirect('2', "perfil/listarPerfil");
        }
    }

    function acesso($id) {
        return $this->listaDados('perfil', $id, 'str_perfil');
    }

    /*
     * Lista view pelo id do módulo
     */
    /* function listaView($idModulo){
      return $this->listaView($idModulo);
      } */
}

$oPerfil = new Perfil();
$classe = 'Perfil';
$oBjeto = $oPerfil;
@include_once '../application/request.php';
?>