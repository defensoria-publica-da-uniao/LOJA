<?php 
    $oController->verificaCadastroUsuario();
?>
<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Solicitar Serviço <small>Briefing</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-folder-alt"></i>
            <span>Produtos - Materiais</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="icon-basket-loaded"></i>
            <a href="<?php echo RAIZ . "materiais/materiais"; ?>">Produtos e Serviços</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="icon-bubbles"></i>
            <a href="<?php echo RAIZ . "servico/formulario"; ?>">Solicitar Serviço</a>
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

        <div class="tab-pane" id="form_wizard_1">
            <div class="portlet box blue-madison" style="border-radius: 4px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file-text-o"></i> - Solicitar Serviço - <font style='font-style:italic;'>Briefing</font> </div>
                    <div class="tools">

                    </div>
                </div>
                <div class="portlet-body form">
                    
                    <form class="form-horizontal" action="<?php echo CONTROLLER.'servico.php'; ?>" id="submit_form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="method" value="cadastrarServico">
                        <div class="form-wizard">
                            <div class="form-body">
                                <ul class="nav nav-pills nav-justified steps">
                                    <li>
                                        <a href="#tab1" data-toggle="tab" class="step">
                                            <span class="number"> 1 </span>
                                            <span class="desc">
                                                <i class="fa fa-check"></i> Objetivos </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab2" data-toggle="tab" class="step">
                                            <span class="number"> 2 </span>
                                            <span class="desc">
                                                <i class="fa fa-check"></i> Público-Alvo </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab3" data-toggle="tab" class="step active">
                                            <span class="number"> 3 </span>
                                            <span class="desc">
                                                <i class="fa fa-check"></i> Distribuição </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab4" data-toggle="tab" class="step">
                                            <span class="number"> 4 </span>
                                            <span class="desc">
                                                <i class="fa fa-check"></i> Adicionais </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab5" data-toggle="tab" class="step">
                                            <span class="number"> 5 </span>
                                            <span class="desc">
                                                <i class="fa fa-check"></i> Confirmação </span>
                                        </a>
                                    </li>
                                </ul>
                                
                                <div id="bar" class="progress progress-striped active" role="progressbar">
                                    <div class="progress-bar progress-bar-success" style="width: 20%"> 
                                    </div>
                                </div>
                                
                                <div class="tab-content">

                                    <div class="alert alert-danger display-none">
                                        <button class="close" data-dismiss="alert"></button> Você tem alguns erros de formulário. Verifique abaixo.
                                    </div>
                                    <div class="alert alert-success display-none">
                                        <button class="close" data-dismiss="alert"></button> A validação do seu formulário foi bem-sucedida!
                                    </div>
                                    <!-- Objetivos -->
                                    <div class="tab-pane active" id="tab1">
                                        <h3 class="block">Objetivos</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Categoria do Serviço
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <select name="id_categoria" id="select2" class="form-control" required>
                                                    <option value=""></option>
                                                    <?php echo $oServico->listarCategorias(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Objetivo que deseja atingir
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" rows="2" name="pergunta1" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Principais problemas que deseja corrigir
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" rows="2" name="pergunta2" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Ponto que queira ressaltar
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" rows="2" name="pergunta3" required></textarea>
                                                <span class="help-block"> Serviço, nomes, endereço, hora, ... </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Ponto que queira evitar
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" rows="2" name="pergunta4" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIM Objetivos -->
                                    <!-- Público-Alvo -->
                                    <div class="tab-pane" id="tab2">
                                        <h3 class="block">Público-Alvo</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Quem são as pessoas que vão receber o material?
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" rows="2" name="pergunta5" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Qual quantidade de pessoas que irá atender?
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input id="touchspin_6" type="text" value="" name="pergunta6">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Por que as pessoas vão gostar?
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" rows="2" name="pergunta7" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIM Público-Alvo -->
                                    <!-- Distribuição -->
                                    <div class="tab-pane" id="tab3">
                                        <h3 class="block">Distribuição</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Onde o material será distribuído ou exposto?
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" rows="2" name="pergunta8" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Periodo de distribuição ou exposição
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <div class="input-group date-picker input-daterange" data-date="15/12/2019" data-date-format="yyyy/mm/dd">
                                                    <input type="text" class="form-control" name="pergunta9">
                                                    <span class="input-group-addon"> até </span>
                                                    <input type="text" class="form-control" name="pergunta10"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Data do evento
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <div class="input-group date-picker input-daterange" data-date="15/12/2019" data-date-format="yyyy/mm/dd">
                                                    <input type="text" class="form-control" name="pergunta11">
                                                    <span class="input-group-addon" style="border-width: 1px 1px;"> <i class="fa fa-calendar"></i> </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIM Distribuição -->
                                    <!-- Distribuição -->
                                    <div class="tab-pane" id="tab4">
                                        <h3 class="block">Distribuição</h3>
                                        <h4 class="form-section">Informações Adicionais</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Onde o material será distribuído ou exposto
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" rows="2" name="pergunta12" required>PERGUNTA REPETIDA - PARTE 3</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label col-md-3">Anexos</label>
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                                    <div>
                                                        <span class="btn red btn-outline btn-file">
                                                            <span class="fileinput-new"> Selecionar Imagem </span>
                                                            <span class="fileinput-exists">Arquivos Carregados </span>
                                                            <input type="file" name="arquivo[]" multiple="multiple">  </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                    </div>
                                                </div>
                                                <span class="help-block" style="color:red;"> Somente irá aparecer uma imagem caso tenha seleciona mais de 2 arquivos. </span>
                                                <span class="help-block"> Apenas imagens com limites de <b>10mb</b> cada. </span>
                                            </div>
                                        </div>
                                     
                                    </div>
                                    <!-- FIM Distribuição -->
                                    <!-- Confirmação -->
                                    <div class="tab-pane" id="tab5">
                                        <h3 class="block">Confirme todos os dados inseridos</h3>
                                        <h4 class="form-section">Objetivos</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Categoria do serviço:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="id_categoria"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Objetivo que deseja atingir:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="pergunta1"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Principais problemas que deseja corrigir:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="pergunta2"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Ponto que queira ressaltar:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="pergunta3"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Ponto que queira evitar:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="pergunta4"> </p>
                                            </div>
                                        </div>
                                        
                                        <h4 class="form-section">Público-Alvo</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Quem são as pessoas que vão receber o material:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="pergunta5"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Qual quantidade de pessoas que irá atender:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="pergunta6"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Por que as pessoas vão gostar:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="pergunta7"> </p>
                                            </div>
                                        </div>
                                        
                                        <h4 class="form-section">Distribuição</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Onde o material será distribuído ou exposto:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="pergunta8"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Periodo de distribuição ou exposição:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="pergunta9"> </p>
                                                <p class="form-control-static" data-display="pergunta10"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Data do evento:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="pergunta11"> </p>
                                            </div>
                                        </div>
                                        
                                        <h4 class="form-section">Adicionais</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Onde o material será distribuído ou exposto:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="pergunta12"> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIM Confirmação -->
                                </div>
                            </div>
                            <div class="form-actions right">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="javascript:;" class="btn btn-circle grey-cascade button-previous">
                                            <i class="fa fa-angle-left"></i> Voltar </a>
                                        <a href="javascript:;" class="btn btn-circle blue-madison button-next"> Próximo
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <!--
                                        <a href="javascript:;" class="btn btn-circle btn-success button-submit"> Confirmar e Enviar
                                            <i class="fa fa-check"></i>
                                        </a>-->
                                        <input type="submit" value="Confirmar e Enviar" class="btn btn-circle btn-success button-submit" data-toggle="confirmation" data-original-title="Enviar Formulário?">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>



            </div>
        </div>

    </div>
</div>
