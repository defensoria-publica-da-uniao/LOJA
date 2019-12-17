<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MCategorias.php';

class categorias extends MCategorias {

    function listar($arrDadosForm = null) {

        if (isset($arrDadosForm['idCategoria']) and $arrDadosForm['acao'] == 'ajax') {
            $result = $this->listaDados('tb_categoria', $_POST['idCategoria'], null, 'id_categoria');
            while ($arDados = mssql_fetch_array($result)) {
                $arr['id'] = $arDados['id_categoria'];
                $arr['categoria'] = utf8_encode($arDados['str_categoria']);
            }
            echo json_encode($arr);
        } else {
            return $this->listaCategoriaCompleto();
        }
    }

    function listarComplexidade() {
        $sql = $this->listaDados('tb_complexidade');
        $option = '';
        while ($dados = mssql_fetch_array($sql)) {
            $id = $dados['id_complexidade'];
            $nome = utf8_encode($dados['str_complexidade']);
            $prazo = $dados['prazo_criacao'];
            if (empty($option)) {
                $option = "<option value='$id'>$nome - $prazo Dias</option>";
            } else {
                $option = $option . "<option value='$id'>$nome - $prazo Dias </option>";
            }
        }
        return $option;
    }

    function cadastrar($arrDadosForm = null) {

        // recebendo valores do formulário 
        $str_categoria = $arrDadosForm['str_categoria'];

        //Deixando tudo minúsculo
        $str_categoria = mb_strtolower("$str_categoria", 'UTF-8');
        //Deixando so a primeira letra maiscula
        $str_categoria = ucfirst($str_categoria);
        //Tirando todos os ascentos
        $str_categoria_verifica = $this->tirarAcentos($str_categoria);

        //Convertendo para o formato do banco 
        $arrDadosForm['str_categoria'] = utf8_decode(ucfirst($arrDadosForm['str_categoria']));

        // Check já foi cadastrada.
        $retorno_check = $this->select_check('tb_categoria', 'str_categoria_verifica', "'$str_categoria_verifica'");
      
        
        if ($retorno_check > 0) {
            //Ja cadastrado
            $this->redirect('12', "categorias/listarCategorias");
        } else {
            //Nova categoria
            $arrDadosForm['str_categoria_verifica'] = $str_categoria_verifica;
            $result = $this->insert($arrDadosForm);
               $this->insertAuditoria(10);
            $this->redirect('1', "categorias/listarCategorias");
        }
    }

    function desativar($arrDadosForm) {
        $arrDadosForm['str_status'];
        (($arrDadosForm['str_status'] == 'D') ? $arrDadosForm['str_status'] = 'A' : $arrDadosForm['str_status'] = 'D' );
        $result = $this->update($arrDadosForm);
           $this->insertAuditoria(11);
        $this->redirect('1', "categorias/listarCategorias");
    }

    function alterar($arrDadosForm) {
        $arrDadosForm['str_categoria'] = utf8_decode($arrDadosForm['str_categoria']);
        $result = $this->update($arrDadosForm);
           $this->insertAuditoria(12);
        $this->redirect('1', "categorias/listarCategorias");
    }

}

$oCategorias = new categorias();
$classe = 'Categorias';
$oBjeto = $oCategorias;
@include_once '../application/request.php';
