<?php
    $select1 = $oMateriais->selectSituacao();
    $sql = $oMateriais->DetalheSolicitacaoMaterial($p1);
    $sql2 = $oMateriais->DetalheGenericaUsuario($p1);
    $sql3 = $oMateriais->DetalheGenericaUsuario($p1);
    $dados2 = mssql_fetch_array($sql2);
    $generica_atual = $dados2['id_generica'];

    if ($dados2['str_uni'] == null) {
        $sigla = $dados2['str_sec'];
    } else {
        $sigla = $dados2['str_uni'];
    }
?>

<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Solicitação Detalhada <small>Subtitulo ou descrição</small>
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
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Data solicitação</label>
                                <input type="text" class="form-control" value="<?php echo date('d/m/Y - H:i', strtotime($dados2['dt_solicitacao_inicial'])); ?>" disabled="" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Situação atual</label>
                                <h2 style="margin-top: 5px;"><span class="label label-primary"><?php echo utf8_encode($dados2['str_descricao']); ?></span></h2>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>

            </div>
            
        </div>
        
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">
                
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
                                    <th width="25%" class="text-center all">Data</th>
                                    <th width="10%" class="text-center all">Situação</th>
                                    <th width="65%" class="min-phone-l min-tablet desktop">Motivo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($listagem = mssql_fetch_array($sql3)) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo date('d/m/Y H:i:s', strtotime($listagem['dt_atualizacao'])); ?></td>
                                    <td class="text-center"><?php echo utf8_encode($listagem['str_descricao']); ?></td>
                                    <td><?php echo utf8_encode($listagem['str_motivo']); ?></td>
                                </tr>
                                <?php } ?>   
                            </tbody>
                        </table>

                    </div>
                </div>
                
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
                
                <div class="portlet box grey-gallery" style="border-radius: 4px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file-o"></i> - Detalhes da Solicitação</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_6">
                            <thead>
                                <tr>
                                    <!-- class:[ all ]-> "Coluna visivél quando for TELEFONE e DESKTOP -->
                                    <!-- class:[ min-phone-l ]-> "Coluna visivél quando for TELEFONE -->
                                    <!-- class:[ min-tablet ]-> "Coluna visivél quando for TABLET -->
                                    <!-- class:[ desktop ]-> "Coluna visivél quando for DESKTOP -->
                                    <th class="text-center all">Material</th>
                                    <th class="text-center all">Categoria</th>
                                    <th class="text-center min-phone-l min-tablet desktop">Qtd. Solicitada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($listagem = mssql_fetch_array($sql)) {
                                ?>
                                <tr>
                                    <td class="text-center"><span class="label label-primary"> <?php echo utf8_encode($listagem['str_material']); ?> </span></td>
                                    <td class="text-center"><span class="label label-info"> <?php echo utf8_encode($listagem['str_categoria']); ?> </span></td>
                                    <td class="text-center"><?php echo $listagem['qtd_solicitacao']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                
            </div>
        </div>
        
        
        <!-- DETALHES DA SOLICIACAO -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <?php
                    if ($_SESSION['LOGIN']['id_perfil'] == 1) {
                ?>
                <div class="portlet box blue-madison" style="border-radius: 4px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file-text-o"></i> - Andamento desta solicitação </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body form">
                        
                        <form  class="rounded" method="POST" action="<?php echo CONTROLLER . 'materiais.php'; ?>" enctype="multipart/form-data" onSubmit="return valida_form()">
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
                <?php } elseif ($_SESSION['LOGIN']['id_perfil'] == 7 && $dados2['str_descricao'] == 'Aguardando Resposta do Cliente') { ?>
                <div class="portlet box blue-madison" style="border-radius: 4px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file-text-o"></i> - Andamento desta solicitação </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body form">
                        
                        <form  class="rounded" method="POST" action="<?php echo CONTROLLER . 'materiais.php'; ?>" enctype="multipart/form-data" onSubmit="return valida_form()">
                            <input type="hidden" name="method" value="updateSituacao">
                            <input type="hidden" name="id_solicitacao" value="<?php echo $p1; ?>">
                        
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3 col-md-4 col-lg-4 col-xl-4">
                                        <div class="form-group" style="padding-left: 15px;">
                                            <label>Situação <?php echo $generica_atual ;?></label>
                                            <div class="mt-radio-list">
                                                <label class="mt-radio" >Aguardando Resposta
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
                <?php }else{ } ?>
            </div>
        </div>
        <!-- FIM DETALHES DA SOLICIACAO -->
        
    </div>
</div>
