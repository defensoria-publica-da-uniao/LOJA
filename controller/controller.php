<?php

/*
 * Chamadas via formulario que sao passados link's diretos ao controle
 * é preciso fazer referencia ao arquivo config e class banco.
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../application/config.php';
    require_once '../model/Banco.php';
} else {

    if ($_SERVER['REQUEST_METHOD'] == 'GET' and @ $_GET['acao'] == 'sair') {
        require_once '../application/config.php';
        require_once '../model/Banco.php';
    }
}

class controller extends Banco {
    /*
     * Valida dados do usuario logado
     */

    public function validaLogin($modulo, $pagina) {

        if (isset($_SESSION['LOGIN']) && isset($_SESSION['VALID']) && isset($_SESSION['VALID']) == true) {


            @session_start();
// seta configurações fusuhorario e tempo limite de inatividade//
            date_default_timezone_set("Brazil/East");
            $tempolimite = 7200;
//fim das configurações de fusu horario e limite de inatividade//
// aqui ta o seu script de autenticação no momento em que ele for validado você seta as configurações abaixo.//
// seta as configurações de tempo permitido para inatividade//
            $_SESSION['registro'] = time(); // armazena o momento em que autenticado //
            $_SESSION['limite'] = $tempolimite; // armazena o tempo limite sem atividade //
            $_SESSION['ultimo_acesso'] = date('d/m/Y H:i:s');
// fim das configurações de tempo inativo//


            $acessoView = false;
            $urlSolicitada = strtolower($modulo) . '/' . strtolower($pagina);
            for ($i = 0; $i <= count($_SESSION['ACESSO']); $i++) {
                @$urlAutorizada = $_SESSION['ACESSO'][$i]['modulo'] . '/' . $_SESSION['ACESSO'][$i]['view'];
                if ($urlAutorizada == $urlSolicitada) {
                    $acessoView = true;
                    @$_SESSION['PERMISSAOVIEW']['cadastrar'] = $_SESSION['ACESSO'][$i]['cadastrar'];
                    @$_SESSION['PERMISSAOVIEW']['alterar'] = $_SESSION['ACESSO'][$i]['alterar'];
                    @$_SESSION['PERMISSAOVIEW']['excluir'] = $_SESSION['ACESSO'][$i]['excluir'];
                    @$_SESSION['PERMISSAOVIEW']['visualizar'] = $_SESSION['ACESSO'][$i]['visualizar'];
                    @$_SESSION['PERMISSAOVIEW']['listar'] = $_SESSION['ACESSO'][$i]['listar'];
                }
            }

            return $acessoView;
        }
    }

    /*
     * Remove caracteres inadequados da string
     */

    function validaString($str) {
        $arInject = array("'", '"', "\\\\", "\\0", "\\n", "\\r", "\Z", "\'", '\"', "\\", "\0", "\n", "\r", "\x1a",
            '"', "'", "ORDER", "order", "BY", "by", "FROM", "from", "WHERE", "where", "HAVING", "having",
            "LIKE", "like", "SELECT", "select", "INSERT", "insert", "DELETE", "delete", "UPDATE", "update", "<>", "<=",
            ">=", "*", "'1'");
        return str_replace($arInject, "", $str);
    }

    function redirect($msg, $url) {
        $_SESSION['MSG'] = $msg;
        echo $URL = RAIZ . $url;
        header("location: $URL");
    }

    /*
     * Passando data para formato PT 30/04/1984
     */

    public function dataPt($data) {
        if ($data == '--')
            return "";
        $dia = substr($data, 8, 2);
        $mes = substr($data, 5, 2);
        $ano = substr($data, 0, 4);
        if (!empty($data))
            return $dia . '/' . $mes . '/' . $ano;
        else
            return "";
    }

    /*
     * Passando data para formato EN 1984-04-30
     */

    public function dataEn($data) {
        $dia = substr($data, 0, 2);
        $mes = substr($data, 3, 2);
        $ano = substr($data, 6, 4);
        if (!empty($data))
            return $ano . '-' . $mes . '-' . $dia;
        else
            return "";
    }

    /*
     * Mascaras em geral ex: CPF ###.###.###-##
     */

    function mask($val, $mask) {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    function tirarAcentos($string) {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/", "/(ç)/"), explode(" ", "a A e E i I o O u U n N c "), $string);
    }

    function removeSingleQuotes($string) {
        $string = str_replace("'", "", $string);
        return $string;
    }

    /*
     * Limpa string, remove acentuação.
     */

    function removeAcentuacao($string) {
        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú', "'");
        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U', '');
        return str_replace($comAcentos, $semAcentos, $string);
    }

    function numDiaDaSemana($data) {
// 0 para domingo
// 6 sabado
        $timestamp = strtotime($this->dataEn($data));
        $dia = date('w', $timestamp);
        return $dia;
    }

    function js_alert($mensagem) {
        print "<script language=javascript> alert('" . $mensagem . "');</script>";
//return $function_ret;
    }

    function js_go($pagina) {
        print "<script language=javascript>self.location.href='$pagina';</script>";
    }

    function js_junto($mensagem, $pagina) {
        print "<script language=javascript> alert('" . $mensagem . "');</script>";
        print "<script language=javascript>self.location.href='" . RAIZ . "$pagina';</script>";
    }

    function verificaCadastroUsuario(){
        
        $consulta = $this->listaDados('gr_usuario',$_SESSION['LOGIN']['id_usuario'],null,'id_usuario');
        
        $dados= mssql_fetch_array($consulta);
      
        if($dados['str_telefone']=='' || $dados['str_email']==''){
            $this->js_junto('Complete seus dados para proseguir com a operação','usuario/editarUsuario');
        exit();
 
        }
    }

    function listarCategorias() {
        $sql = $this->listaDadosSituacao('tb_categoria', "'A'", 'str_categoria ASC', 'str_status');
        $option = '';
        while ($dados = mssql_fetch_array($sql)) {
            $id = $dados['id_categoria'];
            $nome = utf8_encode($dados['str_categoria']);
            if (empty($option)) {
                $option = "<option value='$id'>$nome</option>";
            } else {
                $option = $option . "<option value='$id'>$nome</option>";
            }
        }
        return $option;
    }

    function comboListar($tabela, $id, $nome, $idSelecionado = null, $order = null) {
        $sql = $this->listaDados($tabela, null, $order);
        $id_value = $id;
        $nome_select = $nome;
        $option = '';
        while ($dados = mssql_fetch_array($sql)) {
            $id = $dados[$id_value];
            $nome = utf8_encode($dados[$nome_select]);

            if ($idSelecionado <> null && $idSelecionado <> 'inicio') {
                if ($idSelecionado == $id) {
                    $option = $option . "<option value='$id'selected>$nome</option>";
                } else {
                    if (empty($option)) {
                        $option = "<option value=''></option>";
                        $option = $option . "<option value='$id'>$nome</option>";
                    } else {
                        $option = $option . "<option value='$id'>$nome</option>";
                    }
                }
            } else {
                if (empty($option)) {
                    $option = "<option value=''></option>";
                    $option = $option . "<option value='$id'>$nome</option>";
                } else {
                    $option = $option . "<option value='$id'>$nome</option>";
                }
            }
        }
        return $option;
    }

    function comboListarServidoresOutros() {
        $sql = $this->listaDadosCondicaoServidor('Servidor', 'Outro Orgao', 'st_situacao');
        $id_value = 'id_servidor';

        $option = '';

        while ($dados = mssql_fetch_array($sql)) {
            $id = $dados[$id_value];
            $nome = utf8_encode($dados['st_nome']);
            if (empty($option)) {
                $option = $option . "<option value=''></option>";
            } else {
                $option = $option . "<option value='$id'>$nome</option>";
            }
        }
        return $option;
    }

    //Combo de listagem para tabela generica
    function comboListarGenerica($tabela, $id_select, $generica_opcao, $nome_campo_where, $nome_campo_mostrar, $idSelecionado = null) {
        $sql = $this->listaDadosCondicaoServidor($tabela, $generica_opcao, $nome_campo_where);
        $id_value = $id_select;
        $option = '';
        while ($dados = mssql_fetch_array($sql)) {
            $id = $dados[$id_value];
            $valor_banco = utf8_encode($dados[$nome_campo_mostrar]);

            if ($idSelecionado <> null && $idSelecionado <> 'inicio') {
                if ($idSelecionado == $id) {
                    $option = $option . "<option value='$id'selected>$valor_banco</option>";
                } else {
                    if (empty($option)) {
                        $option = "<option value=''></option>";
                        $option = $option . "<option value='$id'>$valor_banco</option>";
                    } else {
                        $option = $option . "<option value='$id'>$valor_banco</option>";
                    }
                }
            } else {
                if (empty($option)) {
                    $option = "<option value=''></option>";
                    $option = $option . "<option value='$id'>$valor_banco</option>";
                } else {
                    $option = $option . "<option value='$id'>$valor_banco</option>";
                }
            }
        }
        return $option;
    }

//Função para calcular diferença de Dias
    function diferencaDias($data1, $data2) {
        $data_inicial = $data1;
        $data_final = $data2;

// Calcula a diferença em segundos entre as datas
        $diferenca = strtotime($data_final) - strtotime($data_inicial);

//Calcula a diferença em dias
        return $dias = floor($diferenca / (60 * 60 * 24));
    }

    function diffDatas($data1, $data2, $formato) {

        //Datas no formato date_create();
        $datetime1 = date_create($data1);
        $datetime2 = date_create($data2);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($formato);
    }

    function diminuiDias1($data, $dias) {
        $data = explode("-", $data);
        $nova_data = mktime(0, 0, 0, $data[1], $data[2] - $dias, $data[0]);
        return strftime("%Y-%m-%d", $nova_data);
    }

//Função para Padronizar Nome
    function padronizarNome($nome) {
        $arrPalavras = Array('da', 'das', 'de', 'des', 'do', 'dos');
        $nomeexplode = explode(' ', $nome);
        $nomeFinal = '';

        for ($i = 0; $i < count($nomeexplode); $i++) {

            if (empty($nomeFinal)) {
                $nomeCorreto = strtolower($nomeexplode[$i]);
                $nomeCorreto = ucfirst($nomeCorreto);
                $nomeFinal = $nomeCorreto;
            } else {
                $nomeVerifica = strtolower($nomeexplode[$i]);
                if (in_array($nomeVerifica, $arrPalavras)) {
                    $nomeCorreto = $nomeVerifica;
                } else {
                    $nomeCorreto = ucfirst($nomeVerifica);
                }

                $nomeFinal = $nomeFinal . ' ' . $nomeCorreto;
            }
        }
        return $this->validaString(utf8_decode($nomeFinal));
    }

    public function buscarLotacaoSGRHespecifico($estado, $unidade, $lotacao) {
//Sempre passar Estado
        //Passar Unidade e Lotação ou apenas Unidade
        $contador = 0;
        $var = Array();
        if (!empty($estado)) {
            $contador++;
            $var[] = $estado;
        }if (!empty($unidade)) {
            $contador++;
            $var[] = $unidade;
        }
        if (!empty($lotacao)) {
            $contador++;
            $var[] = $lotacao;
        }

        for ($x = 0; $x < $contador; $x++) {

            $result = $this->listarLotacaoSGHRespecifico($var[$x]);

            OCIDefineByName($result, 'CD', $cd);
            OCIDefineByName($result, 'DS', $ds);
            OCIDefineByName($result, 'SIGLA_UNID_TSE', $sigla);
            oci_execute($result);

            while (OCIFetch($result)) {
                $arr[] = array("cd" => $cd, "ds" => utf8_encode($ds), "sigla" => utf8_encode($sigla));
            }
            if (!isset($nome)) {
                $nome = $arr[$x]['sigla'];
            } else {
                $nome = $arr[$x]['sigla'] . ' - ' . $nome;
            }
        }

        return @utf8_encode($nome);
    }

    public function nomeLotacaoUnidadeDados($idLotUni, $LotorUni) {
//$LotorUni==1 Unidade -  $LotorUni==2 Lotação
        $nome = $this->buscarLotacaoSGRHespecifico($idLotUni, 0, 0);

        if ($LotorUni == 1 && empty($nome)) {
            $nome = "Sem Unidade";
        } else if ($LotorUni == 2 && empty($nome)) {
            $nome = "Sem Lotação";
        }

        return utf8_encode($nome);
    }

    function criaModel($modulo) {
        $class = ucfirst($modulo);
        $conteudo = "<?php
            @session_start();
            //Substituir require_once por _SESSION['PATH'];
            require_once '{$_SESSION['PATH']}controller/controller.php';
            class M{$class} extends controller{

            }

            ?>";
        $arquivo = $_SESSION['PATH'] . 'model/M' . $class . '.php';
        $fp = fopen($arquivo, "wb");
        fwrite($fp, $conteudo);
        if (fclose($fp)) {
            chmod($arquivo, 0775);
            return true;
        }
    }

    function criaController($modulo) {
        $newModulo = ucfirst($modulo);
        $class = $newModulo;
        $model = 'M' . $class;
        $conteudoController = "<?php
                @session_start();
                //Substituir require_once por _SESSION['PATH'];
                require_once '{$_SESSION['PATH']}model/{$model}.php';
                class {$class} extends {$model}{

                    function inicio(){ return 'Módulo {$modulo} criado com sucesso'; }

                }
                \$o{$newModulo} = new {$newModulo}();
                \$classe = '{$newModulo}';
                \$o{$newModulo} = \$o{$newModulo};
                @include_once '../application/request.php';

            ?>";
        $arquivoController = $_SESSION['PATH'] . 'controller/' . $modulo . '.php';
        $fp = fopen($arquivoController, "wb");
        fwrite($fp, $conteudoController);
        if (fclose($fp)) {
            chmod($arquivoController, 0775);
            return true;
        }
    }

    function criaView($modulo, $idModulo, $tabela_view, $view = null) {
        ((!empty($view)) ? $pagina = $view : $pagina = 'inicio' . ucfirst($modulo));
        $newModulo = ucfirst($modulo);
        $conteudo = '<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Página Início <small>Subtitulo ou descrição</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <span>Home</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo RAIZ . "inicio/inicio"; ?>">Página Início</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Diretório de navegação</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <a onclick="window.history.go(-1)" class="btn btn-fit-height grey-salt dropdown-toggle"><i class="fa fa-reply"></i> Voltar </a>
        </div>
    </div>
</div>
<!-- FIM TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

        <!-- ALERTAS -->
        <?php require HELPER . "mensagem.php"; ?>
        <!-- FIM ALERTAS -->

        <div class="m-heading-1 border-green m-bordered">
            <p> Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                <br>Texto Texto Texto Texto Texto Texto Texto Texto Texto 
            </p>
        </div>
        <div class="portlet light ">
            <div class="portlet-body">

                <!--
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"></div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"></div>
                </div>
                -->

            </div>
        </div>

    </div>
</div>
';
        $modulo;
        $pagina;
        $arquivo = $_SESSION['PATH'] . 'view/' . $modulo . '/' . $pagina . '.php';
        $fp = fopen($arquivo, "wb");
        fwrite($fp, $conteudo);
        if (fclose($fp)) {
            chmod($arquivo, 0775);

            //Salva view no banco
            $arrDadosForm['tabela'] = $tabela_view;
            $arrDadosForm['str_view'] = $pagina;
            $arrDadosForm['id_modulo'] = $idModulo;
            $this->insert($arrDadosForm);

            return true;
        }
    }

    function permissaoAdministrador($id_view, $tabela_permissao) {

        $arr['tabela'] = $tabela_permissao;
        $arr['id_view'] = $id_view;
        $arr['id_perfil'] = 1;
        $arr['visualizar'] = 1;
        $arr['cadastrar'] = 1;
        $arr['alterar'] = 1;
        $arr['excluir'] = 1;

        $this->insert($arr);
    }
    
    
    
    function checkCarrinho($idUsuario) {
        $consulta = $this->consultaCarrinho($idUsuario);
        return $retorno = mssql_num_rows($consulta);
    }

}

$oController = new controller();
?>