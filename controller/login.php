<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MLogin.php';

class Login extends MLogin {

    function acessar($arrDadosForm) {


        $arrDadosForm = $_POST['arrDadosForm'];
        $auth_pass = $arrDadosForm['str_senha'];
        $usuario = $arrDadosForm['str_login'];

        //Verificando se existe na rede
        $dom = '@dpu.gov.br';
        $ldap_server = "ldap://10.0.2.253";
        $auth_user = "dpu\\" . $usuario;

        $base_dn = "ou=DPGU, dc=dpu, dc=gov, dc=br";

        $filter = "(&(objectClass=user)(objectCategory=person)(cn=*)(samaccountname=$usuario))";
        //$filter = "(&(&(&(objectCategory=person)(objectClass=user)(!(userAccountControl:1.2.840.113556.1.4.803:=2)))(samaccountname=$usuario)(|(description=estag*)(description=terc*)(description=colab*)(description=serv*)(description=defe*))))";
        if (!($connect = ldap_connect($ldap_server))) {
            $this->redirect('3', "login/inicio");
            exit;
        }

        if (!($bind = ldap_bind($connect, $auth_user, $auth_pass))) {
            $this->redirect('4', "login/inicio"); //Erro na autenticação
            exit;
        }

        if (!($search = ldap_search($connect, $base_dn, $filter))) {
            $this->redirect('5', "login/inicio"); //Erro na consulta do usuario
            exit;
        }

        //Se chegou ate aqui é pq existe na rede
        //Verificar se existe no banco
        $buscarUsuario = $this->validaAcesso($arrDadosForm);


        $resultadoUsuario = mssql_num_rows($buscarUsuario);

//Usuario Não cadastrado no Banco
        if ($resultadoUsuario == 0) {
            $this->redirect('10', "login/inicio"); //Usuário sem acesso ao sistema
            exit;
        }

        //Usuario cadastrado no Banco
        else {

            while ($dadosUsuario = mssql_fetch_array($buscarUsuario)) {
                $idUsuario = $dadosUsuario['id_usuario'];
                $nomeUsuario = $dadosUsuario['str_nome'];
                $perfilUsuario = $dadosUsuario['id_perfil'];

                $estatusUsuario = $dadosUsuario['str_situacao'];
                $loginUsuario = $dadosUsuario['str_login'];
                $str_perfilUsuario = $dadosUsuario['str_perfil'];
            }
            //Usuário Inativo
            if ($estatusUsuario == 'D') {
                $this->redirect('11', "login/inicio"); //Usuário sem acesso ao sistema
                exit;
            } //Usuário Ativo
            else {

                $arDadosLogin['id_usuario'] = $idUsuario;
                $arDadosLogin['str_nome'] = $nomeUsuario;
                $arDadosLogin['str_login'] = $loginUsuario;
                $arDadosLogin['str_senha'] = base64_encode($auth_pass);
                $arDadosLogin['id_perfil'] = $perfilUsuario;
                $arDadosLogin['str_perfil'] = $str_perfilUsuario;
                $_SESSION['LOGIN'] = $arDadosLogin;
                $_SESSION['VALID'] = TRUE;

                $resultPermissoes = $this->permissoes($_SESSION['LOGIN']['id_perfil']);
                $arPer = array();
                $cont = 0;
                while ($arPermissao = mssql_fetch_array($resultPermissoes)) {
                    $arP[$cont]['modulo'] = strtolower($this->removeAcentuacao($arPermissao['str_modulo']));
                    $arP[$cont]['view'] = strtolower($this->removeAcentuacao($arPermissao['str_view']));
                    $arP[$cont]['cadastrar'] = $arPermissao['cadastrar'];
                    $arP[$cont]['alterar'] = $arPermissao['alterar'];
                    $arP[$cont]['excluir'] = $arPermissao['visualizar'];
                    $arP[$cont]['visualizar'] = $arPermissao['excluir'];
                    $cont++;
                }

                $_SESSION['ACESSO'] = $arP;
                $this->redirect('null', 'inicio/home');
            }
        }
    }

    function inicio() {

    }

    function sair() {
        $this->fechaConexao();
        session_destroy();
        unset($_GET);
        unset($_POST);
        $this->redirect(null, "login/inicio");
    }

}

$oLogin = new Login();
$classe = 'Login';
$oBjeto = $oLogin;
@include_once '../application/request.php';
?>