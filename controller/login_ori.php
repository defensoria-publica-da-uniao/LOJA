<?php
@session_start();
require_once $_SESSION['PATH'].'model/MLogin.php';
class Login extends MLogin{
    
    function acessar($arrDadosForm){ 
        $autenticacao = $this->validaAcesso($arrDadosForm);
        
        if(pg_num_rows($autenticacao)){   
            $arrLogin = pg_fetch_array($autenticacao); 
            $arDadosLogin['id_usuario'] = $arrLogin['id_usuario'];
            $arDadosLogin['str_nome'] = $arrLogin['str_nome']; 
            $arDadosLogin['str_login'] = $arrLogin['str_login']; 
            $arDadosLogin['str_senha'] = $arrLogin['str_senha'];
            $arDadosLogin['str_senha'] = $arrLogin['str_senha'];
            $arDadosLogin['id_perfil'] = $arrLogin['id_perfil'];
            $_SESSION['LOGIN'] = $arDadosLogin;
            $_SESSION['VALID'] = TRUE;
            
            $resultPermissoes = $this->permissoes($_SESSION['LOGIN']['id_perfil']);
            $arPer = array();
            $cont = 0;
            while ($arPermissao = pg_fetch_array($resultPermissoes)){
                $arP[$cont]['modulo'] = strtolower($this->removeAcentuacao($arPermissao['str_modulo']));
                $arP[$cont]['view'] = strtolower($this->removeAcentuacao($arPermissao['str_view']));
                $arP[$cont]['cadastrar'] = $arPermissao['cadastrar'];
                $arP[$cont]['alterar'] = $arPermissao['alterar'];
                $arP[$cont]['excluir'] = $arPermissao['visualizar'];
                $arP[$cont]['visualizar'] = $arPermissao['excluir'];
                $cont++;
            }
            $_SESSION['ACESSO'] = $arP;
            $this->redirect('null', 'inicio/inicio');
            
        } else{
            $this->redirect('5', 'login/inicio');
        }
    }
    
    function acessoLdap($arrDadosForm){
      
            $arAdmin = array('tiago.machado');
            $dom = '@dpu.gov.br';
            $ldap_server = "ldap://10.0.2.253";
            $auth_user = "dpu\\" . $arrDadosForm['str_login'];
            $auth_pass = $arrDadosForm['str_senha'];
            $usuario = $arrDadosForm['str_login'];
            $base_dn = "ou=DPGU, dc=dpu, dc=gov, dc=br";
            $filter = "(&(objectClass=user)(objectCategory=person)(cn=*)(samaccountname=$usuario))";

            if (!($connect=ldap_connect($ldap_server))) {
                $this->redirect('3', "login/inicio"); 
                exit;
            }

            if (!($bind=ldap_bind($connect, $auth_user, $auth_pass))) {
                $this->redirect('5', "login/inicio"); //Erro na autenticação
                exit;
            }

            if (!($search=ldap_search($connect, $base_dn, $filter))) {
                $this->redirect('4', "login/inicio"); //Erro na consulta do usuario
                exit;
            }

            $number_returned = ldap_count_entries($connect,$search);
            $info = ldap_get_entries($connect, $search);
           
            for ($i=0; $i<$info["count"]; $i++) {
                $arDadosUsu['nome'] = $info[$i]["displayname"][0];
                $arDadosUsu['email'] = $info[$i]["mail"][0];
                $arDadosUsu['login'] = $info[$i]["samaccountname"][0];
                $arDadosUsu['usncreated'] = $info[$i]['usncreated'][0];

                $tipo=explode(" ", $info[$i]['title'][0]);
                $arDadosUsu['tipo'] = $tipo[0];

                $OU =  array('OU=','CN=','DC=');
                $distinguishedname = str_replace($OU,'', explode(",", $info[$i]['distinguishedname'][0]));

                // Capturando unidade 
                if($distinguishedname[3] == "DPGU"){
                        $arDadosUsu['unidade'] = str_replace('_LDA','',$distinguishedname[2]);
                }					

                // Capturando unidade do Defensor
                if($arDadosUsu['tipo'] == "DEFENSOR"){
                        $arDadosUsu['unidade'] = str_replace('OU=','',$distinguishedname[1]);
                }

                // Capturando unidade DPGU
                if($distinguishedname[3] == "BRASILIA_DPGU"){
                        $arDadosUsu['unidade'] = 'DPGU';
                }
            }

            if(!empty($arDadosUsu)){  
                
                $_SESSION['LOGIN'] = $arDadosLogin;
                $_SESSION['VALID'] = TRUE;
                $_SESSION['usuario'] = $arDadosUsu;
                $this->redirect(null, 'inicio/inicio');
            }
           else{ 
               session_destroy();
               $this->redirect(3, 'login/inicio');
            }
    }
            
    function inicio(){
        
    }
    
    function sair(){
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