<?php
    $select1 = $oServico->selectSituacao();
    $sql = $oServico->DetalheSolicitacaoServico($p1);
    $sql2 = $oServico->DetalheGenericaUsuario($p1);
    $sql3 = $oServico->DetalheGenericaUsuario($p1);
    $tss = mssql_fetch_array($sql);
    $id_servico_solicitacao = $tss['id_servico_solicitacao'];
    $dados2 = mssql_fetch_array($sql2);
    $generica_atual = $dados2['id_generica'];

    $briefing = $oServico->DetalheBriefing($id_servico_solicitacao);
    $datalheBriefing = mssql_fetch_array($briefing);
    $img = $oServico->BriefingAnexo($id_servico_solicitacao);

    if ($dados2['str_uni'] == null) {
        $sigla = $dados2['str_sec'];
    } else {
        $sigla = $dados2['str_uni'];
    }
?>

<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Detalhes do Serviço - <font  class="bold font-blue-soft" ><?php echo utf8_encode($_SESSION['mensagemSolicitacaoServico']);?></font>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-bubbles"></i>
            <a href="<?php echo RAIZ . "servico/minhasSolicitacoesServicos"; ?>">Minhas Solicitações de Serviços</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Detalhes do Serviço - <font  class="bold font-blue-soft" ><?php echo utf8_encode($_SESSION['mensagemSolicitacaoServico']);?></font></span>
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
        
        <div class="portlet light ">
            
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-grey-mint bold uppercase">Dados do usuário solicitante</span>
                </div>
                <div class="tools">
                </div>
            </div>
            <div class="portlet-body">
                <div class="form-body">
                <?php
                    if ($_SESSION['LOGIN']['id_perfil'] != 7) {
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Nome Completo</label>
                            <input type="text" class="form-control" value="<?php echo $dados2['str_nome']; ?>" disabled="" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="text" class="form-control" value="<?php echo $dados2['str_email']; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Unidade</label>
                            <input type="text" class="form-control" value="<?php echo utf8_encode($sigla) ; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Telefone</label>
                            <input type="text" class="form-control" value="<?php echo $dados2['str_telefone']; ?>" disabled>
                        </div>
                    </div>
                </div>
                <?php } ?>
                </div>

            </div>
            
        </div>
        
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                
                <div class="portlet box grey-gallery" style="border-radius: 4px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file-o"></i> - Histórico do serviço</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                            <thead>
                                <tr>
                                    <!-- class:[ all ]-> "Coluna visivél quando for TELEFONE e DESKTOP -->
                                    <!-- class:[ min-phone-l ]-> "Coluna visivél quando for TELEFONE -->
                                    <!-- class:[ min-tablet ]-> "Coluna visivél quando for TABLET -->
                                    <!-- class:[ desktop ]-> "Coluna visivél quando for DESKTOP -->
                                    <th width="15%" class="all">Data</th>
                                    <th width="15%" width="25%"class="all">Situação</th>
                                    <th width="60%" class="min-phone-l min-tablet desktop">Motivo</th>
                                    <th width="10%" class="min-phone-l min-tablet desktop">Anexo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($listagem = mssql_fetch_array($sql3)) {
                                ?>
                                <tr>
                                    <td><?php echo date('d/m/Y H:i:s', strtotime($listagem['dt_atualizacao'])); ?></td>
                                    <td><?php echo utf8_encode($listagem['str_descricao']); ?></td>
                                    <td><?php echo utf8_encode($listagem['str_motivo']); ?></td>
                                    <td>
                                        <?php if(empty($listagem['str_nome_original'])) { 
                                        } else { ?>

                                            <!-- LOOP PARA CARREGAR QUANDO TIVER MAIS DE DUAS IMAGENS -->

                                            <div class="btn-group pull-right">
                                                <a href="../../public/anexos/<?php echo utf8_encode($listagem['str_nome_criptografado']); ?>" class="btn dark btn-xs btn-outline fancybox-button" data-rel="fancybox-button">
                                                    <?php echo substr(utf8_encode($listagem['str_nome_original']), 0, 10);?>
                                                </a> 
                                            </div>

                                            <!-- LOOP PARA CARREGAR QUANDO TIVER MAIS DE DUAS IMAGENS -->

                                        <?php } ?>
                                     </td>
                                </tr>
                                <?php } ?>   
                            </tbody>
                        </table>

                    </div>
                </div>
                
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet box grey-gallery" style="border-radius: 4px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file-text-o"></i> - Informações detalhadas do <font style='font-style:italic;'>briefing</font> </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                     
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
                                                <i class="fa fa-check"></i> Informações Adicionais </span>
                                        </a>
                                    </li>

                                </ul>

                                <hr>

                                <div class="tab-content">
                                    <!-- INICIO Parte 1 -->
                                    <div class="tab-pane active" id="tab1">
                                        <h3 class="block">Objetivos</h3>
                                        <div class="row static-info">
                                            <div class="col-md-4 name" align="right" > Categoria do serviço : </div>
                                            <div class="col-md-8 value"><?php echo utf8_encode($datalheBriefing['str_categoria']); ?></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name" align="right" > Objetivo que deseja atingir : </div>
                                            <div class="col-md-8 value"><?php echo $datalheBriefing['str_pergunta_1']; ?></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name" align="right" > Principais problemas que deseja corrigir : </div>
                                            <div class="col-md-8 value"><?php echo $datalheBriefing['str_pergunta_2']; ?></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name" align="right" > Ponto que queira ressaltar : </div>
                                            <div class="col-md-8 value"><?php echo $datalheBriefing['str_pergunta_3']; ?></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name" align="right" > Ponto que queira evitar : </div>
                                            <div class="col-md-8 value"><?php echo $datalheBriefing['str_pergunta_4']; ?></div>
                                        </div>
                                    </div>
                                    <!-- FIM Parte 1 -->
                                    <!-- INICIO Parte 2 -->
                                    <div class="tab-pane" id="tab2">
                                        <h3 class="block">Público-Alvo</h3>
                                        <div class="row static-info">
                                            <div class="col-md-4 name" align="right" > Quem são as pessoas que vão receber o material : </div>

                                            <div class="col-md-8 value"><?php echo $datalheBriefing['str_pergunta_5']; ?></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name" align="right" > Qual quantidade de pessoas que irá atender : </div>
                                            <div class="col-md-8 value"><?php echo $datalheBriefing['qtd_pessoas_atende']; ?></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name" align="right" > Por que as pessoas vão gostar : </div>
                                            <div class="col-md-8 value"><?php echo $datalheBriefing['str_pergunta_7']; ?></div>
                                        </div>
                                    </div>
                                    <!-- FIM Parte 2 -->
                                    <!-- INICIO Parte 3 -->
                                    <div class="tab-pane" id="tab3">
                                        <h3 class="block">Distribuição</h3>
                                        <div class="row static-info">
                                            <div class="col-md-4 name" align="right" > Onde o material será distribuído ou exposto : </div>
                                            <div class="col-md-8 value"><?php echo $datalheBriefing['str_pergunta_8']; ?></div>
                                        </div>
                                        <div class="row static-info">
                                           <div class="col-md-4 name" align="right" > Periodo de distribuição ou exposição : </div>
                                            <div class="col-md-8 value"><?php echo date('d/m/Y', strtotime($datalheBriefing['dt_periodo_inicial'])); ?> até
                                            <?php echo date('d/m/Y', strtotime($datalheBriefing['dt_periodo_final'])); ?></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name" align="right" > Data do evento : </div>
                                            <div class="col-md-8 value"><?php echo date('d/m/Y', strtotime($datalheBriefing['dt_evento'])); ?></div>
                                        </div>                                                           
                                    </div>
                                    <!-- Fim Parte 3 -->
                                    <!-- INICIO Parte 4 -->
                                    <div class="tab-pane" id="tab4">
                                        <h3 class="block">Informações Adicionais</h3>
                                        <div class="row static-info">
                                            <div class="col-md-4 name" align="right" > Onde o material será distribuído ou exposto  : </div>

                                            <div class="col-md-8 value"><?php echo $datalheBriefing['str_pergunta_12']; ?></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name" align="right" > Anexo briefing  : </div>
                                            <div class="col-md-8 value">
                                                <div class="row">
                                                    <?php while($imagemBriefing = mssql_fetch_array($img)){ ?>
                                                    <div class="col-sm-3">
                                                        <div class="mt-element-card mt-element-overlay">
                                                            <div class="mt-card-item">
                                                                <div class="mt-card-avatar mt-overlay-1">
                                                                    <a href="../../public/anexos/<?php echo $imagemBriefing['str_nome_criptografado']; ?>" class="fancybox-button" data-rel="fancybox-button">
                                                                        <img class="img-responsive" src="../../public/anexos/<?php echo $imagemBriefing['str_nome_criptografado']; ?>" alt="">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <!-- FIM Parte 4 -->
                                    <h3 class="block">Datas Importantes</h3>
                                    <div class="row static-info">
                                        <div class="col-md-4 name" align="right" > Data da Solicitação : </div>
                                        <div class="col-md-8 value"><?php echo date('d/m/Y - H:i', strtotime($dados2['dt_solicitacao_inicial'])); ?></div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-4 name" align="right" style="color: red;"> Data do evento : </div>
                                        <div class="col-md-8 value" style="color: red;"><?php echo date('d/m/Y', strtotime($datalheBriefing['dt_evento'])); ?></div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-4 name" align="right" > Periodo de distribuição ou exposição : </div>
                                        <div class="col-md-8 value"><?php echo date('d/m/Y', strtotime($datalheBriefing['dt_periodo_inicial'])); ?> até <?php echo date('d/m/Y', strtotime($datalheBriefing['dt_periodo_final'])); ?></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
        </div>
        
        <?php
            if ($_SESSION['LOGIN']['id_perfil'] == 1) {
        ?>
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet box blue-madison" style="border-radius: 4px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file-text-o"></i> - Andamento desta solicitação </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body form">
                        
                        <form  class="rounded" method="POST" action="<?php echo CONTROLLER . 'servico.php'; ?>" enctype="multipart/form-data" onSubmit="return valida_form()">
                            <input type="hidden" name="method" value="updateSituacao">
                            <input type="hidden" name="id_solicitacao" value="<?php echo $p1; ?>">
                            <input type="hidden" name="email" value="<?php echo $dados2['str_email']; ?>">
                        
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3 col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group" style="padding-left: 15px;">
                                            <label>Situação <?php echo $generica_atual ;?></label>
                                            <div class="mt-radio-list">
                                            <?php 
                                                while ($lista = mssql_fetch_array($select1)) { 
                                                    $checked = '';
                                                    if($lista['id_generica'] == $generica_atual){
                                                        $checked = 'checked';
                                                    }
                                                        ?>
                                                    <label class="mt-radio"> <?php echo $lista['str_descricao']; ?>
                                                        <input type="radio" value="<?php echo $lista['id_generica']; ?>" name="generica" <?php echo $checked;?>/>
                                                        <span></span>
                                                    </label>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-9 col-md-8 col-lg-8 col-xl-8">
                                        <div class="form-group">
                                            <label>Motivo</label>
                                            <textarea class="form-control" rows="11" name="motivo" maxlength="1000" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Anexos</label>
                                            <br>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <!-- <span class="fileinput-filename"> </span> --> Arquivos
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                        <span class="fileinput-new"> Selecionar </span>
                                                        <span class="fileinput-exists"> Remover e Carregar </span>
                                                        <input type="file" name="arquivo[]" multiple="multiple"> </span>
                                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                </div>
                                            </div>
                                            <span class="help-block"> Apenas imagens com limites de <b>10mb</b> cada. </span>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-actions right">
                                <button type="submit" class="btn blue-madison btn-circle">
                                    <i class="fa fa-check"></i> Enviar</button>
                            </div>
                        
                        </form>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
        </div>
        
        <?php } elseif ($_SESSION['LOGIN']['id_perfil'] == 7 && $dados2['str_descricao'] == 'Aguardando Resposta do Cliente') { ?>

        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet box red-mint" style="border-radius: 4px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file-text-o"></i> - Andamento desta solicitação </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body form">
                        
                        <form  class="rounded" method="POST" action="<?php echo CONTROLLER . 'servico.php'; ?>" enctype="multipart/form-data" onSubmit="return valida_form()">
                            <input type="hidden" name="method" value="updateSituacao">
                            <input type="hidden" name="id_solicitacao" value="<?php echo $p1; ?>">                                        
                            <input type="hidden" name="email" value="<?php echo $dados2['str_email']; ?>">
                        
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3 col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group" style="padding-left: 15px;">
                                            <label>Situação</label>
                                            <div class="mt-radio-list">
                                                <label class="mt-radio"> Aguardando Resposta
                                                    <input type="radio" value="18" name="generica" checked/>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-9 col-md-8 col-lg-8 col-xl-8">
                                        <div class="form-group">
                                            <label>Motivo</label>
                                            <textarea class="form-control" rows="11" name="motivo" maxlength="1000" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <button type="submit" class="btn blue-madison btn-circle">
                                    <i class="fa fa-check"></i> Enviar</button>
                            </div>
                        
                        </form>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
        </div>
        
        <?php }else{ } ?>

    </div>
</div>



<script>
    $(document).ready(function () {
        // Pulsante da Mensagem de Sucesso ou Erro
        UIGeneral.init();
    });
</script>