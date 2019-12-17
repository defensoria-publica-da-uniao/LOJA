<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MServico.php';

class servico extends MServico {

    function cadastrarServico($arrDados) {
        
        
        
        
        
        //Criando Solicitação
        $arrSolicitacao['tabela'] = 'tb_solicitacao';
        $arrSolicitacao['id_usuario'] = $_SESSION['LOGIN']['id_usuario'];
        $arrSolicitacao['dt_solicitacao_inicial'] = date('Y-m-d H:i:s');
        $arrSolicitacao['id_tipo_especifico']= 2 ;

        $criarSolicitacao = $this->insert($arrSolicitacao);

        if ($criarSolicitacao == true) {
            
            //Criar servico_solicitação
            $id_solicitacao = $this->maxIdInsert('tb_solicitacao', 'id_solicitacao');
            $arrServicoSolicitacao['id_solicitacao'] = $id_solicitacao;
            $arrServicoSolicitacao['tabela'] = 'tb_servico_solicitacao';
            $arrServicoSolicitacao['id_categoria'] = $arrDados['id_categoria'];
            

            $criarServicoSolicitacao = $this->insert($arrServicoSolicitacao);

            
            
            
            if ($criarServicoSolicitacao == true) {
                //Criar Briefing
                $arrBriefing['tabela'] = 'tb_briefing';
                $id_servico_solicitacao = $this->maxIdInsert('tb_servico_solicitacao', 'id_servico_solicitacao');
                $arrBriefing['id_servico_solicitacao'] = $id_servico_solicitacao;
                $arrBriefing['str_pergunta_1'] = $this->removeSingleQuotes($arrDados['pergunta1']);
                $arrBriefing['str_pergunta_2'] = $this->removeSingleQuotes($arrDados['pergunta2']);
                $arrBriefing['str_pergunta_3'] = $this->removeSingleQuotes($arrDados['pergunta3']);
                $arrBriefing['str_pergunta_4'] = $this->removeSingleQuotes($arrDados['pergunta4']);
                $arrBriefing['str_pergunta_5'] = $this->removeSingleQuotes($arrDados['pergunta5']);
                $arrBriefing['qtd_pessoas_atende'] = $arrDados['pergunta6'];
                $arrBriefing['str_pergunta_7'] = $this->removeSingleQuotes($arrDados['pergunta7']);
                $arrBriefing['str_pergunta_8'] = $this->removeSingleQuotes($arrDados['pergunta8']);
                $arrBriefing['dt_periodo_inicial'] = $arrDados['pergunta9'];
                $arrBriefing['dt_periodo_final'] = $arrDados['pergunta10'];
                $arrBriefing['dt_evento'] = $arrDados['pergunta11'];
                $arrBriefing['str_pergunta_12'] = $this->removeSingleQuotes($arrDados['pergunta12']);

                $criarBriefing = $this->insert($arrBriefing);
                
                
                if ($criarBriefing == true) {
                    //Criar anexos
                    $total = count($_FILES['arquivo']['name']);
                    $tamanho_arquivo = 10485760;

                
                
                    //Verificando tamanho do arquivo
                    if ($total > 0) {


                        for ($i = 0; $i < $total; $i++) {
                            if ($_FILES['arquivo']['size'][$i] <= $tamanho_arquivo) {
                                if (isset($_FILES['arquivo']['name'][$i]) && $_FILES['arquivo']['error'][$i] == 0) {

                                    $arquivo_tmp = $_FILES['arquivo']['tmp_name'][$i];

                                    $nome = utf8_decode($_FILES['arquivo']['name'][$i]);

                                    // Pega a extensão
                                    $extensao = pathinfo($nome, PATHINFO_EXTENSION);
                                    // Converte a extensão para minúsculo

                                    $extensao = strtolower($extensao);

                                    if (strstr('.jpg;.jpeg;.gif;.png;.pdf;', $extensao)) {

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
                                            $arrDadosForm['tabela'] = 'tb_anexos';
                                            $arrDadosForm['str_nome_original'] = $nome;
                                            $arrDadosForm['str_nome_criptografado'] = $novoNome;
                                            $arrDadosForm['id_servico_solicitacao'] = $id_servico_solicitacao;


                                            $result = $this->insert($arrDadosForm);


                                        } else {
                                            //Nao conseguiu mover
                                             $this->redirect('', 'servico/solicitacaoServicos');
                                        }
                                    } else {
                                        //Extensão não permitida                 
                                         $this->redirect('14', 'servico/solicitacaoServicos');
                                    }
                                }
                            } else {
                                //Tamanho acima do permitida
                                 $this->redirect('15', 'servico/solicitacaoServicos');
                            }
                        }
                    } 
                    
                    //Criar histórico
                    $arrHistorico['tabela'] = 'tb_historico';
                    $arrHistorico['id_generica'] = '5';
                    $arrHistorico['dt_atualizacao'] = date('Y-m-d H:i:s');
                    $arrHistorico['int_status'] = '1';
                    $arrHistorico['id_solicitacao'] = $id_solicitacao;
                    
                    
                  $criarHistórico = $this->insert($arrHistorico);
                  
                  if($criarHistórico==true){
                      
                      $this->insertAuditoria(4);
                                      
                          //envia email
                //Classe pra enviar email
        @require 'enviaEmail.php';
        //consulta pra pegar email
          $sqlListagemUsuario = $this->listaDados('gr_usuario', $_SESSION['LOGIN']['id_usuario'], null, 'id_usuario');
            $dadosUsu = mssql_fetch_array($sqlListagemUsuario);
            
        $email=$dadosUsu['str_email'];
        $assunto='Confirmação da Solicitação de Serviço';
        $corpo='Seu Pedido de Serviço foi solicitado com sucesso para a ASCOM';
       $objEmail = new EnviaEmail($email,$assunto,$corpo);
                      $this->redirect('1', 'servico/minhasSolicitacoesServicos');
                  }else{
                      //Não criou histórico
                 
                      $this->redirect('24', 'servico/solicitacaoServicos');
                  }
                    
                } else {
                    //Nao criou Briefing
                    $this->redirect('25', 'servico/solicitacaoServicos');
                }
            } else {
                //Nao criou serviço solicitacao
                  $this->redirect('26', 'servico/solicitacaoServicos');
            }
        } else {
            //Nao criou solicitação
            $this->redirect('27', 'servico/solicitacaoServicos');
        }
    }
    
    
    public function selectSituacao() {

        $result = $this->SelectGenericaEspecifica();

        return $result; 
    }
    
    function DetalheGenericaUsuario($par) {
        $result = $this->ServicoGenericaUsuario($par);
        
        return $result;
    }
    
    public function listarServicosSolicitacao() {
            
        
            if (empty($_POST)) {
            if (!isset($_SESSION['p1'])) {
               
                $data = date('Y-m-d');
                $_SESSION['mensagemSolicitacaoServico'] = 'Aberto';
                return $this->listaSolicitacaoServicos(0, $data, $data);
            } else {

                 
                $p1 = $_SESSION['p1'];
                $p2 = $_SESSION['p2'];
                $p3 = $_SESSION['p3'];

                unset($_SESSION['p1'], $_SESSION['p2'], $_SESSION['p3']);

                $lista = $this->listaDados('tb_generica', $p1, null, 'id_generica');
                $resultLista = mssql_fetch_array($lista);

                $nome = $resultLista['str_descricao'];

                $_SESSION['mensagemSolicitacaoServico'] = $nome;

                return $this->listaSolicitacaoServicos($p1, $p2, $p3);
            }
        } else {
            
            session_start();
            $_SESSION['mensagemSolicitacaoServico'] = $nome;

            //convertendo data
            $data_inicial = explode('/', $_POST['dt_solicitacao_inicial']);

            $data_i = $data_inicial[2] . '-' . $data_inicial[1] . '-' . $data_inicial[0];

            $data_final = explode('/', $_POST['dt_solicitacao_final']);

            $data_f = $data_final[2] . '-' . $data_final[1] . '-' . $data_final[0];



            $_SESSION['p1'] = $_POST['situacao'];
            $_SESSION['p2'] = $data_i.' 00:00:00';
            $_SESSION['p3'] = $data_f.' 23:59:59';

            $this->redirect('0', 'servico/solicitacaoServicos');
        }
    }
      public function listarServicosSolicitacaoCliente() {
            
        
            if (empty($_POST)) {
            if (!isset($_SESSION['p1'])) {
               
                $data = date('Y-m-d');
                $_SESSION['mensagemSolicitacaoServico'] = 'Aberto';
                return $this->listaSolicitacaoServicosCliente(0, $data, $data);
            } else {                 
                $p1 = $_SESSION['p1'];
                $p2 = $_SESSION['p2'];
                $p3 = $_SESSION['p3'];

                unset($_SESSION['p1'], $_SESSION['p2'], $_SESSION['p3']);

                $lista = $this->listaDados('tb_generica', $p1, null, 'id_generica');
                $resultLista = mssql_fetch_array($lista);

                $nome = $resultLista['str_descricao'];

                $_SESSION['mensagemSolicitacaoServico'] = $nome;

                return $this->listaSolicitacaoServicosCliente($p1, $p2, $p3);
            }
        } else {
            
            session_start();
            $_SESSION['mensagemSolicitacaoServico'] = $nome;

            //convertendo data
            $data_inicial = explode('/', $_POST['dt_solicitacao_inicial']);

            $data_i = $data_inicial[2] . '-' . $data_inicial[1] . '-' . $data_inicial[0];

            $data_final = explode('/', $_POST['dt_solicitacao_final']);

            $data_f = $data_final[2] . '-' . $data_final[1] . '-' . $data_final[0];



            $_SESSION['p1'] = $_POST['situacao'];
            $_SESSION['p2'] = $data_i.' 00:00:00';
            $_SESSION['p3'] = $data_f.' 23:59:59';

            $this->redirect('0', 'servico/minhasSolicitacoesServicos');
        }
    }
    
    public function DetalheSolicitacaoServico($par) {
        $result = $this->SolicitacaoServicoDetalhado($par);

        return $result;
    }
    
    public function updateSituacao() {
        $id_solicitacao = $_POST['id_solicitacao'];

        $motivo = $_POST['motivo'];
        $generica = $_POST['generica'];

        $dados_atualizar['tabela'] = 'tb_historico';
        $dados_atualizar['campo_where'] = 'id_solicitacao';
        $dados_atualizar['id'] = $id_solicitacao;
        $dados_atualizar['int_status'] = '0';
        $email=$_POST['email'];
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
                $total = count($_FILES['arquivo']['name']);
                $tamanho_arquivo = 10485760;
                 
                //Verificando tamanho do arquivo
                if ($total > 0 && $_FILES['arquivo']['name']['0']<> '') {

                    
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
                                        $arrDadosForm['id_historico'] = $this->maxIdInsert('tb_historico', 'id_historico');

                                        $result33 = $this->insert($arrDadosForm);
                                        
                                    } else {
                                        $this->redirect('2', "servico/solicitacaoDetalhada/$id_solicitacao");
                                        die();
                                    }
                                } else {
                                    //Extensão não permitida
                                    $this->redirect('14', "servico/solicitacaoDetalhada/$id_solicitacao");
                                    die();
                                }
                            }else{

                                 $this->redirect('22', "servico/solicitacaoDetalhada/$id_solicitacao");
                                 die();
                            }
                        } else {
                            $nomes_arquivos = $_FILES['arquivo']['name'][$i];
                            //Tamanho acima do permitida
                            $this->redirect('15', "servico/solicitacaoDetalhada/$id_solicitacao");
                            die();
                        }
                    } else{
                        $this->redirect('23', "servico/solicitacaoDetalhada/$id_solicitacao");
                        die();
                    }
                }
                   
                }
            } else {
                $this->redirect('21', "servico/solicitacaoDetalhada/$id_solicitacao");
                die();
            }
            
        if ($result33 == true) {
            
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
       
       $this->redirect('1', "servico/solicitacaoDetalhada/$id_solicitacao");
        } else {
            
            $this->redirect('2', "servico/solicitacaoDetalhada/$id_solicitacao");
        }
    }

    public function DetalheBriefing ($par) {
        $result = $this->Briefing($par);

        return $result;
    }
    
    public function BriefingAnexo ($par) {
        $result = $this->BriefingImg($par);
        
        return $result;
    }

}

$oServico = new servico();
$classe = 'Servico';
$oBjeto = $oServico;
@include_once '../application/request.php';
