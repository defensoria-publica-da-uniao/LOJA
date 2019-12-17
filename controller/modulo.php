<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MModulo.php';

class Modulo extends MModulo {

    function cadastrar($arrDadosForm = null) {
        $arrDadosForm['str_modulo'] = strtolower($this->removeAcentuacao($arrDadosForm['str_modulo']));
        $resultM = $this->verificaModulo($arrDadosForm['tabela'], $arrDadosForm['str_modulo']);
        if (mysqli_num_rows($resultM) > 0) {
            $this->redirect('12', "modulo/listarModulo");
        }

        $result = $this->insert($arrDadosForm);
        $idModuloCriado = $this->maxIdInsert($arrDadosForm['tabela'], 'id_modulo');

        if ($result) {
            $caminho = $_SESSION['PATH'] . 'view/';
            $modulo = $arrDadosForm['str_modulo'];

            if (!is_dir($caminho . $modulo)) {

                if (mkdir($caminho . $modulo, 0777)) {
                    $this->criaModel($modulo);
                    $this->criaController($modulo);
                    $this->criaView($modulo, $idModuloCriado, 'gr_view');
                    $idViewCriado = $this->maxIdInsert('gr_view', 'id_view');
                    $this->permissaoAdministrador($idViewCriado, 'gr_acesso');
                }
            }
        }

        $this->redirect('1', "modulo/listarModulo");
    }

    function alterar($arrDadosForm) {
        $arrDadosForm['str_modulo'] = strtolower($this->removeAcentuacao($arrDadosForm['str_modulo']));
        $result = $this->update($arrDadosForm);
        $this->redirect('1', "modulo/listarModulo");
    }

    function listar($arrDadosForm = null) {
        if (isset($arrDadosForm['idModulo']) and $arrDadosForm['acao'] == 'ajax') {
            $result = $this->listaDados('gr_modulo', $_POST['idModulo'], 'str_modulo');
            while ($arDados = mssql_fetch_array($result)) {
                $arr['id'] = $arDados['id_modulo'];
                $arr['modulo'] = $arDados['str_modulo'];
            }
            echo json_encode($arr);
        } else {
            return $this->listaDados('gr_modulo', null, 'str_modulo');
        }
    }

    function desativar($arrDadosForm) {
        $result = $this->delete($arrDadosForm);
        $this->redirect('1', "modulo/listarModulo");
    }

    public function cadastrar_modulos_views() {

        require_once '../application/config.php';

        require_once '../model/Geral.php';

        $oGeral = new Geral();
        $pasta = '../view/';

        if (is_dir($pasta)) {
            $diretorio = dir($pasta);
            if ($diretorio <> '.') {
                while (($modulo = $diretorio->read()) !== false) {

                    if ($modulo <> '.' && $modulo <> '..') {
                        //Verificando se ja existe o modulo para cadastrar
                        $consultaModulo = $oGeral->modulo($modulo);
                        $checkModulo = mssql_num_rows($consultaModulo);

                        if (empty($checkModulo)) {
                            //Inserindo Modulo
                            $oGeral->insert2('gr_modulo', 'str_modulo', "'$modulo'");
                        }
                        echo 'modulo = ' . $modulo . '  </br> views = ';
                        $pastaemodulo = $pasta . $modulo . '/';
                        //verificando se existe views nos modulos
                        if (is_dir($pastaemodulo)) {
                            $diretorio2 = dir($pastaemodulo);
                            while (($view = $diretorio2->read()) !== false) {
                                if ($view <> '.' && $view <> '..') {
                                    $explode = explode('.', $view);
                                    $view_final = $explode[0];
                                    echo $view_final . ' / ';

                                    //Pegando id do modulo
                                    $consultaModuloid = $oGeral->modulo($modulo);
                                    $arrModulo = mssql_fetch_array($consultaModuloid);
                                    $id_modulo = $arrModulo['id_modulo'];

                                    //verificando se ja existe essa view cadastrada
                                    $consultaView = $oGeral->view($view_final, $id_modulo);
                                    $checkview = mssql_num_rows($consultaView);

                                    if (empty($checkview)) {
                                        //Inserindo view
                                        $oGeral->insert2('gr_view', 'id_modulo,str_view', "'$id_modulo','$view_final'");

                                        //Buscando id_view
                                        $consultaView = $oGeral->view($view_final, $id_modulo);
                                        $arrView = mssql_fetch_array($consultaView);
                                        $id_view = $arrView['id_view'];

                                        //Ver quantos tipos de usuário existem no sistema
                                        $consultaPerfil = $oGeral->select2('gr_perfil');

                                        //Inserindo a permissao dos perfis na view
                                        while ($arrPerfil = mssql_fetch_array($consultaPerfil)) {
                                            $id_perfil = $arrPerfil['id_perfil'];
                                            $str_perfil = $arrPerfil['str_perfil'];
                                            if ($str_perfil == 'Tecnico') {
                                                $oGeral->insert2('gr_acesso', 'id_view,id_perfil,visualizar,cadastrar,alterar,excluir'
                                                        , "'$id_view','$id_perfil','1','1','1','1'");
                                            } else {
                                                $oGeral->insert2('gr_acesso', 'id_view,id_perfil,visualizar,cadastrar,alterar,excluir'
                                                        , "'$id_view','$id_perfil','0','0','0','0'");
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        echo'<hr>';
                    }
                }
            }
            $diretorio->close();
        } else {
            echo 'A pasta não existe.';
        }
    }

}

$oModulo = new Modulo();
$classe = 'Modulo';
$oBjeto = $oModulo;
@include_once '../application/request.php';
?>