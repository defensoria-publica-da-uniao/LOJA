<?php
    $sql = $oServico->listarServicosSolicitacaoCliente();
    $sql2 = $oServico->selectSituacao();
?>
<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Minhas Solicitações de Serviços
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-bubbles"></i>
            <a href="<?php echo RAIZ . "servico/minhasSolicitacoesServicos"; ?>">Minhas Solicitações de Serviços</a>
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
        
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
                <div class="dashboard-stat blue-soft">
                    <div class="visual">
                        <i class="fa fa-folder-open fa-icon-medium"></i>
                    </div>
                    <div class="details">
                        <div class="number"> 200 </div>
                        <div class="desc"> Em Aberto </div>
                    </div>
                    <a class="more" href="javascript:;"> Veja Mais
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-soft">
                    <div class="visual">
                        <i class="fa fa-signal"></i>
                    </div>
                    <div class="details">
                        <div class="number"> 150 </div>
                        <div class="desc"> Em Andamento </div>
                    </div>
                    <a class="more" href="javascript:;"> Veja Mais
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-soft">
                    <div class="visual">
                        <i class="fa fa-times-circle fa-icon-medium"></i>
                    </div>
                    <div class="details">
                        <div class="number"> 50 </div>
                        <div class="desc"> Cancelado </div>
                    </div>
                    <a class="more" href="javascript:;"> Veja Mais
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
                <div class="dashboard-stat blue-soft">
                    <div class="visual">
                        <i class="fa fa-check-circle fa-icon-medium"></i>
                    </div>
                    <div class="details">
                        <div class="number "> 200 </div>
                        <div class="desc"> Concluído </div>
                    </div>
                    <a class="more" href="javascript:;"> Veja Mais
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-soft">
                    <div class="visual">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>
                    <div class="details">
                        <div class="number"> 150 </div>
                        <div class="desc"> Aguardando Resposta do Cliente </div>
                    </div>
                    <a class="more" href="javascript:;"> Veja Mais
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-soft">
                    <div class="visual">
                        <i class="fa fa-exclamation-triangle fa-icon-medium"></i>
                    </div>
                    <div class="details">
                        <div class="number"> 50 </div>
                        <div class="desc"> Aguardando Resposta do Fornecedor </div>
                    </div>
                    <a class="more" href="javascript:;"> Veja Mais
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="note note-info">
            <p> Utilize os filtros para adquirir novos resultados </p>
        </div>
        
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <span class="caption-subject bold uppercase">Data da Solicitação - <font  class="bold font-blue-soft" >Todos</font> | Situação - <font  class="bold font-blue-soft" ><?php echo utf8_encode($_SESSION['mensagemSolicitacaoServico']);?></font></span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
         
                <div class="clearfix">
                    <h4 class="block">Filtros</h4>
                    <form  class="horizontal-form" method="POST" action="<?php echo CONTROLLER .'servico.php'; ?>" enctype="multipart/form-data" onSubmit="return valida_form()">
                        <input type="hidden" name="method" value="listarServicosSolicitacaoCliente">

                        <div class="form-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label">Data da Solicitação<span class="required" aria-required="true">*</span></label>
                                        <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="dd/mm/yyyy">
                                            <input type="text" class="form-control" placeholder="Data Inicial" name="dt_solicitacao_inicial" id="dt_solicitacao_inicial" required >
                                            <span class="input-group-addon"> até </span>
                                            <input type="text" class="form-control" placeholder="Data Final"  name="dt_solicitacao_final" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Situação<span class="required" aria-required="true">*</span></label>
                                            <select  name="situacao" id="filtro_setor" class="form-control" >
                                                <?php 
                                                    while($dadoSelect = mssql_fetch_array($sql2)){
                                                       echo '<option value="'.$dadoSelect['id_generica'].'">'.$dadoSelect['str_descricao'].'</option>'; 
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label" style=" color:#ffffff !important;">.</label><br>
                                            <input type="submit" name="Submit"  class="btn btn-primary" value="Filtrar" /> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="clearfix">
                    <h4 class="block">Resultados</h4>
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                        <thead>
                            <tr>
                                <!-- class:[ all ]-> "Coluna visivél quando for TELEFONE e DESKTOP -->
                                <!-- class:[ min-phone-l ]-> "Coluna visivél quando for TELEFONE -->
                                <!-- class:[ min-tablet ]-> "Coluna visivél quando for TABLET -->
                                <!-- class:[ desktop ]-> "Coluna visivél quando for DESKTOP -->
                                <th class="text-center all">Detalhar</th>
                                <th class="text-center min-phone-1 min-tablet desktop">Solicitação</th>
                                <th class="text-center min-phone-1 min-tablet desktop">Solicitante</th>
                                <th class="text-center min-phone-1 min-tablet desktop">Data da Solicitação</th>
                                <th class="text-center all">Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($dadosInicial = mssql_fetch_array($sql)) {
                                    $id_solicitacao=$dadosInicial['id_solicitacao'];
                            ?>
                            <tr>
                                <td class="text-center">
                                    <a href="solicitacaoDetalhada/<?php echo $id_solicitacao; ?>">
                                        <button type="button" class="btn blue-madison btn-xs ">
                                            <i class="glyphicon glyphicon-edit"></i>
                                        </button>
                                    </a>
                                </td>
                                <td class="text-center"><?php echo $id_solicitacao; ?></td>
                                <td class="text-center"><?php echo utf8_encode($dadosInicial['str_nome']) ?></td>
                                <td class="text-center"><?php echo date('d/m/Y H:i:s', strtotime($dadosInicial['dt_solicitacao_inicial'])); ?></td>
                                <td class="text-center"><?php echo utf8_encode($dadosInicial['str_descricao']); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
                
            </div>

        </div>

        
        
    </div>
</div>


<script>
    $(document).ready(function () {
        // Pulsante da Mensagem de Sucesso ou Erro
        UIGeneral.init();
    });
</script>