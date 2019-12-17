<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MView.php';

class View extends MView {

    function cadastrar($arrDadosForm = null) {
        $arrDadosForm['str_view'] = $this->removeAcentuacao($arrDadosForm['str_view']);
        $arrDadosForm['str_view'] = trim($arrDadosForm['str_view']);
        
        $resultM = $this->listaDados('gr_modulo', $arrDadosForm['id_modulo'], null, 'id_modulo');
        $arM = mssql_fetch_array($resultM);

        $this->criaView($arM['str_modulo'], $arM['id_modulo'], 'gr_view', $arrDadosForm['str_view']);
        $idViewCriado = $this->maxIdInsert('gr_view', 'id_view');
        $this->permissaoAdministrador($idViewCriado, 'gr_acesso');
        $this->redirect('1', "view/listarView");
    }

    function alterar($arrDadosForm) {
        $arrDadosForm['str_view'] = strtolower($this->removeAcentuacao($arrDadosForm['str_view']));
        $result = $this->update($arrDadosForm);
        $this->redirect('1', "view/listarView");
    }

    function listar($arrDadosForm = null) {
        if (isset($arrDadosForm['idView']) and $arrDadosForm['acao'] == 'ajax') {
            $result = $this->listarView($_POST['idView'], 'str_view');
            while ($arDados = mssql_fetch_array($result)) {
                $arr['id'] = $arDados['id_view'];
                $arr['view'] = $arDados['str_view'];
                $arr['modulo'] = $arDados['id_modulo'];
            }
            echo json_encode($arr);
        } else {
            return $this->listarView();
        }
    }

    function listarModulo() {
        return $this->listaDados('modulo', null, 'str_modulo');
    }

    function deletar($arrDadosForm) {
        $result = $this->deleteView($arrDadosForm);
        $this->redirect('1', "view/listarView");
    }

}

$oView = new View();
$classe = 'View';
$oBjeto = $oView;
@include_once '../application/request.php';
?>