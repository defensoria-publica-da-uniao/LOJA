<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MMateriais.php';

class materiais extends MMateriais {

    function listar($arrDadosForm = null) {

        if (isset($arrDadosForm['idMaterial']) and $arrDadosForm['acao'] == 'ajax') {
            $result = $this->listaDados('tb_material', $arrDadosForm['idMaterial'], null, 'id_material');
            while ($arDados = mssql_fetch_array($result)) {
                $arr['id'] = $arDados['id_material'];
                $arr['material'] = utf8_encode($arDados['str_material']);
                $arr['numero'] = $arDados['int_qtd_estoque'];
                $arr['id_categoria'] = $arDados['id_categoria'];
                $arr['descricao'] = utf8_encode($arDados['str_descricao']);
                $arr['id_anexo_principal'] = $arDados['id_anexo_principal'];
            }
           echo json_encode($arr);
        } else if (isset($arrDadosForm['materiais_ativos'])) {
            return $this->listaMateriaisCompleto(2);
        } else {
            return $this->listaMateriaisCompleto(1);
        }
    }

    function listarAnexos($arrDadosForm = null) {

        if (isset($arrDadosForm['idMaterial']) and $arrDadosForm['acao'] == 'ajax') {
            $id_material = $arrDadosForm['idMaterial'];
            $result_anexos = $this->listaDados('tb_anexos', $_POST['idMaterial'], null, 'id_material');
            $js = 1;
            while ($arDados2 = mssql_fetch_array($result_anexos)) {
                $id_anexo = $arDados2['id_anexos'];
                $nome_original = $arDados2['str_nome_original'];
                $nome = $arDados2['str_nome_criptografado'];

                if ($id_anexo == $arrDadosForm['anexo_principal']) {
                    $div = 'div1';
                    $chek = 'checked';
                    $disabled = 'disabled';
                } else {
                    $div = 'div2';
                    $chek = '';
                    $disabled = '';
                }
                $imagens .= "
        

<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>
    <div class='mt-card-item' >
        <div class='$div' id='div$js'>
            <div class='mt-card-avatar mt-overlay-1'>
                <img src='../public/anexos/$nome'  />
            </div>
            <div class='mt-card-content'>
                <p class='mt-card-desc font-grey-mint'>
                    Excluir Imagem 
                    <input type='checkbox' id='$js' name='arrDadosForm[id_anexos_excluir][]' value='$id_anexo' $disabled onclick='excluir(this.id)'; >
                </p>
                <h4 class='mt-card-name'>
                    Imagem Principal
                    <input type='radio'id='$js' name='arrDadosForm[id_anexos]' value='$id_anexo' $chek onclick='desabilitar(this.id)';>
                </h4>
            </div>
        </div>
    </div>
</div>


                ";
                $js++;
            }
            $valor_total_magens = $js - 1;
            $divid = "  <input type='hidden'  name='arrDadosForm[id_material]' value='$id_material' /> "
                    . "<input type='hidden'  id='total_imagens' value='$valor_total_magens' /> ";
            echo $imagens . $divid;
            //<input type='checkbox' name='id_anexos' value='$id_anexo'>
        }
    }

    function listarCategoriasSelecionado($arrDadosForm = null) {

        $sql = $this->listaDados('tb_categoria', null, 'str_categoria ASC');
        $option = '';
        while ($dados = mssql_fetch_array($sql)) {
            $id = $dados['id_categoria'];
            $nome = utf8_encode($dados['str_categoria']);
            if ($arrDadosForm['id_categoria'] == $id) {
                $option = "<option value='$id' selected>$nome</option>";
            } else if (empty($option)) {
                $option = "<option value='$id'>$nome</option>";
            } else {
                $option = $option . "<option value='$id'>$nome</option>";
            }
        }
        echo $option;
    }

    function cadastrar($arrDadosForm = null) {

       
        // recebendo valores do formulário 
        $str_material = $arrDadosForm['str_material'];

        //Deixando tudo minúsculo
        $str_material = mb_strtolower("$str_material", 'UTF-8');
        //Deixando so a primeira letra maiscula
        $str_material = ucfirst($str_material);
        //Tirando todos os ascentos
        $str_material_verifica = $this->removeAcentuacao($str_material);
        //Retira Aspas e Apostrofos
        $str_material_verifica = $this->removeSingleQuotes($str_material_verifica);

        //Convertendo para o formato do banco 
        $arrDadosForm['str_material'] = utf8_decode(ucfirst($arrDadosForm['str_material']));
        //Retira Aspas e Apostrofos
        $arrDadosForm['str_material'] = $this->removeSingleQuotes($arrDadosForm['str_material']);

        // Check já foi cadastrada.
        $retorno_check = $this->select_check('tb_material', 'str_material_verifica', "'$str_material_verifica'");


        if ($retorno_check > 0) {

            //Ja cadastrado
            $this->redirect('13', "materiais/listarMateriais");
        } else {
            $arrDadosForm['str_material_verifica'] = $str_material_verifica;

            if ($arrDadosForm['int_qtd_estoque'] == 0) {

                $arrDadosForm['int_qtd_estoque'] = '0';
            }

            //Retira Aspas e Apostrofos
            $arrDadosForm['str_descricao'] = $this->removeSingleQuotes($arrDadosForm['str_descricao']);
            $arrDadosForm['str_descricao'] = trim(utf8_decode($arrDadosForm['str_descricao']));
            $result = $this->insert($arrDadosForm);

            $ultimo_id = $this->maxIdInsert('tb_material', 'id_material');
            if ($result == true) {
                $total = count($_FILES['arquivo']['name']);
                $tamanho_arquivo = 10485760;


                //Verificando tamanho do arquivo
                if ($total > 0) {

                    $anexo_principal = '';
                    for ($i = 0; $i < $total; $i++) {

                        /* valor largura maxima */ $validWidth = 667;
                        /* valor altura maxima */ $validHeight = 500;

                        /* atribuindo valor da largura e altura para variaveis */
                        list($largura, $altura) = getimagesize($_FILES['arquivo']['tmp_name'][$i]);
                        
                    
                //Verificando Largura e altura        
                if($largura <= $validWidth && $altura <= $validHeight){
                        
                    //Verificando Tamanho do arquivo
                        if ($_FILES['arquivo']['size'][$i] <= $tamanho_arquivo) {
                            if (isset($_FILES['arquivo']['name'][$i]) && $_FILES['arquivo']['error'][$i] == 0) {

                                $arquivo_tmp = $_FILES['arquivo']['tmp_name'][$i];

                                $nome = utf8_decode($_FILES['arquivo']['name'][$i]);

                                // Pega a extensão
                                $extensao = pathinfo($nome, PATHINFO_EXTENSION);
                                // Converte a extensão para minúsculo

                                $extensao = strtolower($extensao);


                                if (strstr('.jpg;.jpeg;.gif;.png;', $extensao)) {

                                    // Cria um nome único para esta imagem
                                    // Evita que duplique as imagens no servidor.
                                    // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                                    $novoNome = uniqid(time()) . '.' . $extensao;

                                    // Concatena a pasta com o nome
                                    $destino = '../public/anexos/' . $novoNome;

                                    // tenta mover o arquivo para o destino
                                    if (@move_uploaded_file($arquivo_tmp, $destino)) {
                                        //echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
                                        //echo ' < img src = "' . $destino . '" />';
                                        unset($arrDadosForm);
                                        $arrDadosForm['tabela'] = 'tb_anexos';
                                        $arrDadosForm['str_nome_original'] = $nome;
                                        $arrDadosForm['str_nome_criptografado'] = $novoNome;
                                        $arrDadosForm['id_material'] = $ultimo_id;

                                        $result = $this->insert($arrDadosForm);

                                        if (empty($anexo_principal)) {
                                            $anexo_principal = 'true';
                                            //Pegar o anexo que acabou de ser inserido
                                            $ultimo_id_anexo = $this->maxIdInsert('tb_anexos', 'id_anexos');
                                            //Atualizar tabela meterial com o id_anexo principal
                                            $dados_atualizar['tabela'] = 'tb_material';
                                            $dados_atualizar['id_anexo_principal'] = $ultimo_id_anexo;
                                            $dados_atualizar['campo_where'] = 'id_material';
                                            $dados_atualizar['id'] = $ultimo_id;
                                            $this->update($dados_atualizar);
                                        }
                                        
                                        
                                    } else {
                                        $this->redirect('2', "materiais/listarMateriais");
                                        die();
                                    }
                                } else {
                                    //Extensão não permitida
                                    $this->redirect('14', "materiais/listarMateriais");
                                    die();
                                }
                            }else{
                                 $this->redirect('22', "materiais/listarMateriais");
                                 die();
                            }
                        } else {
                            $nomes_arquivos = $_FILES['arquivo']['name'][$i];
                            //Tamanho acima do permitida
                            $this->redirect('15', "materiais/listarMateriais");
                            die();
                        }
                    } else{
                        $this->redirect('23', "materiais/listarMateriais");
                        die();
                    }
                }
                    if ($result == 1) {
                        $this->insertAuditoria(13);
                        $this->redirect('1', "materiais/listarMateriais");
                        die();
                    } else {
                        $this->redirect('2', "materiais/listarMateriais");
                        die();
                    }
                }
            } else {
                $this->redirect('21', "materiais/listarMateriais");
                die();
            }
        }
    }

    function desativar($arrDadosForm) {
        $id_material = $arrDadosForm['id'];
        
        
        $arrDadosForm['str_status'];
        (($arrDadosForm['str_status'] == 'D') ? $arrDadosForm['str_status'] = 'A' : $arrDadosForm['str_status'] = 'D' );

        $result = $this->update($arrDadosForm);
        if ($result == true) {
            if($arrDadosForm['str_status'] == 'D') {
                $this->insertAuditoria(14,'id_material',$id_material);
            } else {
                $this->insertAuditoria(19,'id_material',$id_material);
            }
        }
        $this->redirect('1', "materiais/listarMateriais");
    }

    function alterar($arrDadosForm) {
        
        $id_material = $arrDadosForm['id'];
        
        
        $arrDadosForm['str_material'] = utf8_decode($arrDadosForm['str_material']);
        $arrDadosForm['str_descricao'] = trim(utf8_decode($arrDadosForm['str_descricao']));
        $result = $this->update($arrDadosForm);

        if ($result == true) {
            echo $total = count($_FILES['arquivo']['name']);
            $tamanho_arquivo = 10485760;

            //Verificando tamanho do arquivo
             if ($total > 0) {

                    $anexo_principal = '';
                    for ($i = 0; $i < $total; $i++) {

                        /* valor largura maxima */ $validWidth = 667;
                        /* valor altura maxima */ $validHeight = 500;

                        /* atribuindo valor da largura e altura para variaveis */
                        list($largura, $altura) = getimagesize($_FILES['arquivo']['tmp_name'][$i]);
                        
                    
                //Verificando Largura e altura        
                if($largura <= $validWidth && $altura <= $validHeight){
                        
                    //Verificando Tamanho do arquivo
                    if ($_FILES['arquivo']['size'][$i] <= $tamanho_arquivo) {
                        if (isset($_FILES['arquivo']['name'][$i]) && $_FILES['arquivo']['error'][$i] == 0) {

                            $arquivo_tmp = $_FILES['arquivo']['tmp_name'][$i];

                            $nome = utf8_decode($_FILES['arquivo']['name'][$i]);

                            // Pega a extensão
                            $extensao = pathinfo($nome, PATHINFO_EXTENSION);
                            // Converte a extensão para minúsculo

                            $extensao = strtolower($extensao);

                            if (strstr('.jpg;.jpeg;.gif;.png;', $extensao)) {

                                // Cria um nome único para esta imagem
                                // Evita que duplique as imagens no servidor.
                                // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                                $novoNome = uniqid(time()) . '.' . $extensao;

                                // Concatena a pasta com o nome
                                $destino = '../public/anexos/' . $novoNome;

                                // tenta mover o arquivo para o destino
                                if (@move_uploaded_file($arquivo_tmp, $destino)) {
                                    //echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
                                    //echo ' < img src = "' . $destino . '" />';
                                    $id = $arrDadosForm[id];
                                    unset($arrDadosForm);
                                    $arrDadosForm['tabela'] = 'tb_anexos';
                                    $arrDadosForm['str_nome_original'] = $nome;
                                    $arrDadosForm['str_nome_criptografado'] = $novoNome;
                                    $arrDadosForm['id_material'] = $id;

                                    $result = $this->insert($arrDadosForm);
                                } else {
                                    $this->redirect('2', "materiais/listarMateriais");
                                    //die();
                                }
                            } else {
                                //Extensão não permitida
                                $this->redirect('14', "materiais/listarMateriais");
                                die();
                            }
                        }
                    } else {
                        $nomes_arquivos = $_FILES['arquivo']['name'][$i];
                        //js_alert('Arquivo(s) com tamanho excedido(s) :' . $nomes_arquivos . '');
                        $this->redirect('2', "materiais/listarMateriais");
                    }
                    } else{
                        $this->redirect('23', "materiais/listarMateriais");
                        die();
                    }
                }
                if ($result == 1) {
                    $this->insertAuditoria(15,'id_material',$id_material);
                    $this->redirect('1', "materiais/listarMateriais");
                } else {
                    $this->redirect('2', "materiais/listarMateriais");
                }
            } else {
                $this->redirect('1', "materiais/listarMateriais");
            }
        } else {
            $this->redirect('2', "materiais/listarMateriais");
        }
        $this->redirect('1', "materiais/listarMateriais");
    }

    function listaMaterialEspecifico($par) {
        $result = $this->listaDados('tb_material', $par, null, 'id_material');
        while ($dados = mssql_fetch_array($result)) {
            $arr['id'] = $dados['id_material'];
            $arr['material'] = utf8_encode($dados['str_material']);
            $arr['qtd_estoque'] = $dados['int_qtd_estoque'];
            $arr['id_categoria'] = $dados['id_categoria'];
            $arr['descricao'] = utf8_encode($dados['str_descricao']);
        }
        $result = $this->listaDados('tb_anexos', $par, null, 'id_material');
        while ($dados = mssql_fetch_array($result)) {
            $arr['imagem'][] = $dados['str_nome_criptografado'];
        }
        $result = $this->listaDados('tb_categoria', $arr['id_categoria'], null, 'id_categoria');
        while ($dados = mssql_fetch_array($result)) {
            $arr['categoria'] = utf8_encode($dados['str_categoria']);
        }
        return $arr;
    }

    function DetalheSolicitacaoMaterial($par) {
        $result = $this->SolicitacaoMaterialDetalhada($par);

        return $result;
    }

    function DetalheGenericaUsuario($par) {
        $result = $this->MaterialGenericaUsuario($par);


        return $result;
    }

    function alteracoesImagens($arrDadosForm) {

        $id_material = $arrDadosForm['id_material'];

        //Update imagem principal
        $arrDadosForm1['tabela'] = 'tb_material';
        $arrDadosForm1['campo_where'] = 'id_material';
        $arrDadosForm1['id_anexo_principal'] = $arrDadosForm['id_anexos'];
        $arrDadosForm1['id'] = $arrDadosForm['id_material'];

        $result1 = $this->update($arrDadosForm1);

        //Delete de imagens selecionadas

        $arrDadosForm2['tabela'] = 'tb_anexos';
        $arrDadosForm2['campo_where'] = 'id_anexos';

        for ($i = 0; $i < count($arrDadosForm['id_anexos_excluir']); $i++) {
            $arrDadosForm2['id'] = $arrDadosForm['id_anexos_excluir'][$i];
            $sql = $this->listaDados('tb_anexos', $arrDadosForm2['id'], null, 'id_anexos');
            $dados = mssql_fetch_array($sql);
            $nome_criptografado = $dados['str_nome_criptografado'];

            $result2 = $this->delete($arrDadosForm2);
            if ($result2 == true) {
                $destino = '../public/anexos/' . $nome_criptografado;
                unlink($destino);
            }
        }

        $this->redirect('1', "materiais/listarMateriais");
    }

    function buscarCarrinho() {
        if (!isset($_SESSION['DADOSUSUARIOFORA']['idProduto'])) {
            echo'<div class="row">
            <div class="col-md-12 page-500">
                <div class=" number font-blue"><i class="glyphicon glyphicon-shopping-cart"></i></div>
                <div class=" details">
                    <h3 class="font-blue">Opa! Seu carrinho encontra-se vazio.</h3>
                    <p> Verifique os produtos e serviços disponiveis em nossa loja.
                    </p>
                    <p>
                        <a href="materiais" class="btn blue btn-outline"> Produtos e Serviços </a>
                        <br>
                    </p>
                </div>
            </div>
        </div>';
        }
    }

    function listarCarrinho() {
        
    }

    function addCarrinhoUsuarioExterno() {
        
        
        
        

        //Check Ja tiver algo no carrinho
        if (isset($_SESSION['DADOSUSUARIOFORA']['idProduto'])) {
            //Ja existe o produto no carrinho
            if (in_array($_POST['idProduto'], $_SESSION['DADOSUSUARIOFORA']['idProduto'])) {
                for ($i = 0; $i < count($_SESSION['DADOSUSUARIOFORA']['idProduto']); $i++) {
                    if ($_SESSION['DADOSUSUARIOFORA']['idProduto'][$i] == $_POST['idProduto']) {
                        $totalPedido = $_POST['qtdProduto'] + $_SESSION['DADOSUSUARIOFORA']['qtdProduto'][$i];
                        //Conferindo se valor pedido e o somado é maior que total no estoque
                        if ($totalPedido > $_SESSION['DADOSUSUARIOFORA']['maxEstoque'][$i]) {
                            $_SESSION['DADOSUSUARIOFORA']['qtdProduto'][$i] = $_SESSION['DADOSUSUARIOFORA']['maxEstoque'][$i];
                        } else {
                            $_SESSION['DADOSUSUARIOFORA']['qtdProduto'][$i] = $totalPedido;
                        }
                    }
                }
            }//Nao existe o produto no carrinho 
            else {
                $_SESSION['DADOSUSUARIOFORA']['maxEstoque'][] = $_POST['maxEstoque'];
                $_SESSION['DADOSUSUARIOFORA']['nomeProduto'][] = $_POST['nomeProduto'];
                $_SESSION['DADOSUSUARIOFORA']['idProduto'][] = $_POST['idProduto'];
                $_SESSION['DADOSUSUARIOFORA']['qtdProduto'][] = $_POST['qtdProduto'];
                $_SESSION['DADOSUSUARIOFORA']['imgProduto'][] = $this->listaAnexoPrincipal($_POST['idProduto']);
            }
        }//Primeiro Produto no Carrinho
        else {
            $_SESSION['DADOSUSUARIOFORA']['maxEstoque'][] = $_POST['maxEstoque'];
            $_SESSION['DADOSUSUARIOFORA']['nomeProduto'][] = $_POST['nomeProduto'];
            $_SESSION['DADOSUSUARIOFORA']['idProduto'][] = $_POST['idProduto'];
            $_SESSION['DADOSUSUARIOFORA']['qtdProduto'][] = $_POST['qtdProduto'];
            $_SESSION['DADOSUSUARIOFORA']['imgProduto'][] = $this->listaAnexoPrincipal($_POST['idProduto']);
        }

        $this->redirect('0', 'materiais/final_pedido');
    }

    function addCarrinhoUsuarioInterno() {

    
        
        $id_produto = $_POST['idProduto'];
        $nome_produto = $_POST['nomeProduto'];
        $maxEstoque = $_POST['maxEstoque'];
        $qtd_produto = $_POST['int_qtd_estoque'];

       


        $result1 = $this->listaDados('tb_solicitacao_provisoria', $_SESSION['LOGIN']['id_usuario'], null, 'id_usuario');
        
        
        $verificar = mssql_num_rows($result1);

        $solicitacao = mssql_fetch_array($result1);

        if ($verificar != 0) {
            
            

            $id_solicitacao_provisoria = $solicitacao['id_solicitacao_provisoria'];

            $existe_produto = 0;

            $result = $this->listaDados('tb_material_solicitacao_provisoria', $id_solicitacao_provisoria, null, 'id_solicitacao_provisoria');

            while ($info = mssql_fetch_array($result)) {
               
                if ($id_produto == $info['id_material']) {
                  


                    //Somar quantidade do produto
                    $existe_produto = 1;
                    $totalPedido = $qtd_produto + $info['qtd_solicitacao'];

                    if ($totalPedido > $maxEstoque) {
                   
                        $qtd_produto = $maxEstoque;
                      
                    } else {
                       
                        $qtd_produto = $totalPedido;
                    }
                    $arrDadosUpdate['tabela'] = 'tb_material_solicitacao_provisoria';
                    $arrDadosUpdate['campo_where'] = 'id_material_solicitacao_provisoria';
                    $arrDadosUpdate['id'] = $info['id_material_solicitacao_provis'];
                    $arrDadosUpdate['qtd_solicitacao'] = $qtd_produto;

                    $this->update($arrDadosUpdate);
                    
                }
            }
            if ($existe_produto == 0) {
                

                $arrDadosMat['tabela'] = 'tb_material_solicitacao_provisoria';
                $arrDadosMat['id_material'] = $id_produto;
                $arrDadosMat['qtd_solicitacao'] = $qtd_produto;
                $arrDadosMat['id_solicitacao_provisoria'] = $id_solicitacao_provisoria;

               
                $this->insert($arrDadosMat);
                
                
            }
        } else {

            $arrDadosSoli['tabela'] = 'tb_solicitacao_provisoria';
            $arrDadosSoli['id_usuario'] = $_SESSION['LOGIN']['id_usuario'];
            $arrDadosSoli['dt_solicitacao_inicial'] = date('Y-m-d H:i:s');

            $result2 = $this->insert($arrDadosSoli);

            if ($result2 == true) {
                $arrDadosMatSoli['tabela'] = 'tb_material_solicitacao_provisoria';
                $arrDadosMatSoli['id_material'] = $id_produto;
                $arrDadosMatSoli['id_solicitacao_provisoria'] = $this->maxIdInsert('tb_solicitacao_provisoria', 'id_solicitacao_provisoria');
                $arrDadosMatSoli['qtd_solicitacao'] = $qtd_produto;

                $result3 = $this->insert($arrDadosMatSoli);
            }
        }
        $this->redirect('1', 'materiais/carrinho');
    }

    function abrirSessaoUsuarioExterno() {
        if (!isset($_SESSION['DADOSUSUARIOFORA'])) {
            //Abrindo sessao para guarda daddos do usuário (Sem login)
            $_SESSION['DADOSUSUARIOFORA']['IP'] = $_SERVER['REMOTE_ADDR'];
        } else {
            
        }
    }

    function removerProduto($arrDadosForm) {
        if (isset($_SESSION['DADOSUSUARIOFORA']['idProduto'])) {
            for ($i = 0; $i < max($_SESSION['DADOSUSUARIOFORA']['idProduto']); $i++) {
                if ($_SESSION['DADOSUSUARIOFORA']['idProduto'][$i] == $_POST['idProduto']) {
                    unset($_SESSION['DADOSUSUARIOFORA']['maxEstoque'][$i]);
                    unset($_SESSION['DADOSUSUARIOFORA']['nomeProduto'][$i]);
                    unset($_SESSION['DADOSUSUARIOFORA']['idProduto'][$i]);
                    unset($_SESSION['DADOSUSUARIOFORA']['qtdProduto'][$i]);
                    unset($_SESSION['DADOSUSUARIOFORA']['imgProduto'][$i]);
                }
            }

            if (max($_SESSION['DADOSUSUARIOFORA']['idProduto']) == 0) {
                unset($_SESSION['DADOSUSUARIOFORA']);
            }

            $this->redirect('1', 'materiais/final_pedido');
        } else {
            $arrDadosForm2['tabela'] = 'tb_material_solicitacao_provisoria';
            $arrDadosForm2['id'] = $arrDadosForm['id_material_solicitacao_provisoria'];
            $arrDadosForm2['campo_where'] = 'id_material_solicitacao_provisoria';

            $this->delete($arrDadosForm2);
            $this->redirect('1', 'materiais/carrinho');
        }
    }

    function AtualizarQtdProduto($arrDadosForm) {
        if (isset($_SESSION['DADOSUSUARIOFORA']['idProduto'])) {
            for ($i = 0; $i < max($_SESSION['DADOSUSUARIOFORA']['idProduto']); $i++) {
                if ($_SESSION['DADOSUSUARIOFORA']['idProduto'][$i] == $_POST['idProduto']) {
                    //Conferindo se valor pedido e o somado é maior que total no estoque                   
                    if ($_POST['qtdProduto'] >= $_SESSION['DADOSUSUARIOFORA']['maxEstoque'][$i]) {
                        $_SESSION['DADOSUSUARIOFORA']['qtdProduto'][$i] = $_SESSION['DADOSUSUARIOFORA']['maxEstoque'][$i];
                    } else {
                        $_SESSION['DADOSUSUARIOFORA']['qtdProduto'][$i] = $_POST['qtdProduto'];
                    }
                }
            }

            if (max($_SESSION['DADOSUSUARIOFORA']['idProduto']) == 0) {
                unset($_SESSION['DADOSUSUARIOFORA']);
            }
            $this->redirect('1', 'materiais/final_pedido');
        } else {
            if ($arrDadosForm['qtd_solicitacao'] >= $arrDadosForm['int_qtd_estoque']) {
                $arrDadosForm['qtd_solicitacao'] = $arrDadosForm['int_qtd_estoque'];
            }
            $arrDadosForm2['qtd_solicitacao'] = $arrDadosForm['qtdProduto'];
            $arrDadosForm2['id'] = $arrDadosForm['idMaterialSolicitacaoProvis'];
            $arrDadosForm2['tabela'] = 'tb_material_solicitacao_provisoria';
            $arrDadosForm2['campo_where'] = 'id_material_solicitacao_provisoria';
            $this->update($arrDadosForm2);
            $this->redirect('1', 'materiais/carrinho');
        }
    }

    function finalizarPedido() {
   
        $this->verificaCadastroUsuario();
        //recebendo id_usuario do form
        $id_usuario = $_POST['id_usuario'];
        $id_solicitacao_provisoria = $_POST['id_solicitacao_provisoria'];

        //Inserindo dados do carrinho na tabela definitiva tb_solicitacao
        $arrDadosSolicitacao['tabela'] = 'tb_solicitacao';
        $arrDadosSolicitacao['dt_solicitacao_inicial'] = date('Y-m-d H:i:s');
        $arrDadosSolicitacao['id_usuario'] = $_POST['id_usuario'];
        $arrDadosSolicitacao['id_tipo_especifico']=1;
        
        $result = $this->insert($arrDadosSolicitacao);
   
        if($result==true){
        //Criar Histórico
         $arrDadosHist['tabela'] = 'tb_historico';
        $arrDadosHist['id_generica'] = '5';
        $arrDadosHist['id_solicitacao'] = $this->maxIdInsert('tb_solicitacao', 'id_solicitacao');
        $arrDadosHist['dt_atualizacao'] = date('Y-m-d H:i:s');
        $arrDadosHist['int_status'] = '1';

        $resultHist = $this->insert($arrDadosHist);
        
        }

        //Inserindo dados do carrinho na tabela definitiva tb_materiais_solicitacao
        if ($result == true) {

            //INNER JOIN das tabelas com o parametro id_usuario que recebemos do form
            $result = $this->consultaCarrinho($id_usuario);

            while ($dados = mssql_fetch_array($result)) {
                $arrDadosMateriais['id_solicitacao'] = $this->maxIdInsert('tb_solicitacao', 'id_solicitacao');
                $arrDadosMateriais['tabela'] = 'tb_material_solicitacao';
                $arrDadosMateriais['id_material'] = $dados['id_material'];
                $arrDadosMateriais['qtd_solicitacao'] = $dados['qtd_solicitacao'];

                $result2 = $this->insert($arrDadosMateriais);


                //Buscando dados para subtração da quantidade
                if ($resultHist == true) {

                    $tabela = 'tb_material';
                    $id = $dados['id_material'];
                    $campo_where = 'id_material';

                    $sqlListagem = $this->listaDados($tabela, $id, '', $campo_where);

                    $listagem = mssql_fetch_array($sqlListagem);

                    //Listando dados e subtraindo quantidade em estoque
                    $dadosUpdate['tabela'] = 'tb_material';
                    $dadosUpdate['int_qtd_estoque'] = $listagem['int_qtd_estoque'] - $dados['qtd_solicitacao'];
                    $dadosUpdate['campo_where'] = 'id_material';
                    $dadosUpdate['id'] = $dados['id_material'];

                    $subtracao = $this->update($dadosUpdate);

                    if ($subtracao == true) {
                        $ok = 1;
                    } else {
                        $ok = 0;
                    }
                }
            }
            
            
            
            
            //Se der certo, excluir dados provisorios nas tabelas abaixo
            if ($ok == 1) {
                
               
                $dadosDelete['tabela'] = 'tb_material_solicitacao_provisoria';
                $dadosDelete['id'] = $id_solicitacao_provisoria;
                $dadosDelete['campo_where'] = 'id_solicitacao_provisoria';

                $result3 = $this->delete($dadosDelete);

                $dadosDelete2['tabela'] = 'tb_solicitacao_provisoria';
                $dadosDelete2['id'] = $id_solicitacao_provisoria;
                $dadosDelete2['campo_where'] = 'id_solicitacao_provisoria';

                $result4 = $this->delete($dadosDelete2);

                if($result4 == true){
                $this->insertAuditoria();  
                
                
        // NÃO ESTÁ FUNCIONANDO - SAMUEL RESOLVE          
                //envia email
                //Classe pra enviar email
        //        @require 'enviaEmail.php';
                //consulta pra pegar email
        //        $sqlListagemUsuario = $this->listaDados('gr_usuario', $_SESSION['LOGIN']['id_usuario'], null, 'id_usuario');
        //        $dadosUsu = mssql_fetch_array($sqlListagemUsuario);
        //        $email=$dadosUsu['str_email'];
        //        $assunto='Confirmação da Solicitação';
        //        $corpo='Seu Pedido de materiais foi solicitado com sucesso para a ASCOM';
        //        $objEmail = new EnviaEmail($email,$assunto,$corpo);
        // NÃO ESTÁ FUNCIONANDO - SAMUEL RESOLVE    
               
           
       
                $this->redirect('1', 'materiais/minhasSolicitacoesMateriais');
               
                
                }
            } else {
                $this->redirect('2', 'materiais/carrinho');
            }
        }
    }

    public function listarMateriaisSolicitacao() {

        if (empty($_POST)) {
            if (!isset($_SESSION['p1'])) {
                $data = date('Y-m-d');
                $_SESSION['mensagemSolicitacaoMaterial'] = 'Aberto';
                return $this->listaSolicitacaoMateriais(0, $data, $data);
            } else {

                $p1 = $_SESSION['p1'];
                $p2 = $_SESSION['p2'];
                $p3 = $_SESSION['p3'];

                unset($_SESSION['p1'], $_SESSION['p2'], $_SESSION['p3']);

                $lista = $this->listaDados('tb_generica', $p1, null, 'id_generica');
                $resultLista = mssql_fetch_array($lista);

                $nome = $resultLista['str_descricao'];

                $_SESSION['mensagemSolicitacaoMaterial'] = $nome;

                return $this->listaSolicitacaoMateriais($p1, $p2, $p3);
            }
        } else {
            session_start();
            $_SESSION['mensagemSolicitacaoMaterial'] = $nome;

            //convertendo data
            $data_inicial = explode('/', $_POST['dt_solicitacao_inicial']);

            $data_i = $data_inicial[2] . '-' . $data_inicial[1] . '-' . $data_inicial[0];

            $data_final = explode('/', $_POST['dt_solicitacao_final']);

            $data_f = $data_final[2] . '-' . $data_final[1] . '-' . $data_final[0];



            $_SESSION['p1'] = $_POST['situacao'];
            $_SESSION['p2'] = $data_i.' 00:00:00';
            $_SESSION['p3'] = $data_f.' 23:59:59';

            $this->redirect('0', 'materiais/solicitacaoMateriais');
        }
    }
    
     public function listarMateriaisSolicitacaoCliente() {

        if (empty($_POST)) {
            if (!isset($_SESSION['p1'])) {
                $data = date('Y-m-d');
                $_SESSION['mensagemSolicitacaoMaterial'] = 'Aberto';
                return $this->listaSolicitacaoMateriaisCliente(0, $data, $data);
            } else {

                $p1 = $_SESSION['p1'];
                $p2 = $_SESSION['p2'];
                $p3 = $_SESSION['p3'];

                unset($_SESSION['p1'], $_SESSION['p2'], $_SESSION['p3']);

                $lista = $this->listaDados('tb_generica', $p1, null, 'id_generica');
                $resultLista = mssql_fetch_array($lista);

                $nome = $resultLista['str_descricao'];

                $_SESSION['mensagemSolicitacaoMaterial'] = $nome;

                return $this->listaSolicitacaoMateriaisCliente($p1, $p2, $p3);
            }
        } else {
            session_start();
            $_SESSION['mensagemSolicitacaoMaterial'] = $nome;

            //convertendo data
            $data_inicial = explode('/', $_POST['dt_solicitacao_inicial']);

            $data_i = $data_inicial[2] . '-' . $data_inicial[1] . '-' . $data_inicial[0];

            $data_final = explode('/', $_POST['dt_solicitacao_final']);

            $data_f = $data_final[2] . '-' . $data_final[1] . '-' . $data_final[0];



            $_SESSION['p1'] = $_POST['situacao'];
            $_SESSION['p2'] = $data_i.' 00:00:00';
            $_SESSION['p3'] = $data_f.' 23:59:59';

            $this->redirect('0', 'materiais/minhasSolicitacoesMateriais');
        }
    }

    public function selectSituacao() {

        $result = $this->SelectGenericaEspecifica();

        return $result;
    }

    public function updateSituacao() {
        $id_solicitacao = $_POST['id_solicitacao'];

        $motivo = $_POST['motivo'];
        $generica = $_POST['generica'];
        $email=$_POST['email'];


        $dados_atualizar['tabela'] = 'tb_historico';
        $dados_atualizar['campo_where'] = 'id_solicitacao';
        $dados_atualizar['id'] = $id_solicitacao;
        $dados_atualizar['int_status'] = '0';

        $update = $this->update($dados_atualizar);

        if ($update == true) {
            $dados_insert['tabela'] = 'tb_historico';
            $dados_insert['id_solicitacao'] = $id_solicitacao;
            $dados_insert['int_status'] = '1';
            $dados_insert['str_motivo'] = utf8_decode($motivo);
            $dados_insert['dt_atualizacao'] = date('Y-m-d H:i:s');
            $dados_insert['id_generica'] = $generica;


            $insert = $this->insert($dados_insert);
        }
        if ($insert == true) {

            $verifica = $this->verificaResponsavel($id_solicitacao);

            if ($verifica == false) {


                $update_soli['tabela'] = 'tb_solicitacao';
                $update_soli['campo_where'] = 'id_solicitacao';
                $update_soli['id'] = $id_solicitacao;
                $update_soli['id_responsavel'] = $_SESSION['LOGIN']['id_usuario'];

                $updateSoli = $this->update($update_soli);
            }
        }



        if ($insert == true) {
            $this->insertAuditoria(16);
            
             //envia email
                //Classe pra enviar email
        @require 'enviaEmail.php';
        //consulta pra pegar email
  
       $situacao=$this->pegar_string_generica($generica);         
       $assunto='Alteração da Solicitação de Serviço';
       $corpo='Seu Pedido de Serviço foi alterado para a situação : <b>'.$situacao.'</b>';       
       $objEmail = new EnviaEmail($email,$assunto,$corpo);
       
            $this->redirect('1', "materiais/solicitacaoDetalhada/$id_solicitacao");
        } else {
            $this->redirect('2', "materiais/solicitacaoDetalhada/$id_solicitacao");
        }
    }

}

$oMateriais = new materiais();
$classe = 'Materiais';
$oBjeto = $oMateriais;
@include_once '../application/request.php';
