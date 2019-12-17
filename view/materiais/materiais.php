<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Produtos e Serviços
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
            <div class="tabbable-custom nav-justified">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#tab_material" data-toggle="tab"> <i class="icon-layers"></i> Materias </a>
                    </li>
                    <li>
                        <a href="#tab_servicos" data-toggle="tab"> <i class="icon-bubbles"></i> Serviços </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_material">
                        <!-- CONTEÚDO MATERIAL -->
                        <br>
                        <div class="mt-element-card mt-element-overlay">
                            <div class="row">
                                <?php
                                    $arrayDadosForm['materiais_ativos'] = 1;
                                    $dados = $oMateriais->listar($arrayDadosForm);
                                    while ($dadosListar = mssql_fetch_array($dados)) {
                                ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <div class="mt-card-item">
                                        <div class="mt-card-avatar mt-overlay-1 ">
                                            <img src="../public/anexos/<?php echo $dadosListar['str_nome_criptografado'] ?>" alt="">
                                            <!--<img src="<?php echo IMG . "manutencao.jpg" ?>" alt="">  -->
                                            <div class="mt-overlay">
                                                <ul class="mt-info">
                                                    <li>
                                                        <a class="btn red-mint circle bold" href="des_material/<?php echo $dadosListar['id_material']; ?>">
                                                            <i class="glyphicon glyphicon-shopping-cart"></i> Saiba Mais
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mt-card-content">
                                            <h3 class="mt-card-name uppercase"><?php echo substr(utf8_encode($dadosListar['str_material']), 0, 20);?></h3>
                                            <p class="mt-card-desc font-grey-mint uppercase" style="color:#888888 !important; font-size: 12px !important;"><?php echo utf8_encode($dadosListar['str_categoria']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>


                        <!-- FIM CONTEÚDO MATERIAL -->
                    </div>
                    <div class="tab-pane" id="tab_servicos">
                        <!-- CONTEÚDO SERVIÇOS -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <center>
                                    <img src="<?php echo IMG; ?>diversas/ascom.jpg" width="100%" alt=""> 
                                </center>
                                <hr>
                                <div class="mt-element-card mt-element-overlay">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <div class="mt-card-item">
                                                <div class="mt-card-avatar mt-overlay-1 mt-scroll-right">
                                                    <img src="<?php echo IMG; ?>manutencao.jpg" alt=""> 
                                                    <div class="mt-overlay">
                                                        <ul class="mt-info">
                                                            <li>
                                                                <a class="btn default btn-outline" href="javascript:;">
                                                                    <i class="icon-magnifier"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="btn default btn-outline" href="javascript:;">
                                                                    <i class="icon-link"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mt-card-content">
                                                    <h3 class="mt-card-name">Descrição</h3>
                                                    <p class="mt-card-desc font-grey-mint">Managing Director</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <div class="mt-card-item">
                                                <div class="mt-card-avatar mt-overlay-1 mt-scroll-down">
                                                    <img src="<?php echo IMG; ?>manutencao.jpg" alt=""> 
                                                    <div class="mt-overlay mt-top">
                                                        <ul class="mt-info">
                                                            <li>
                                                                <a class="btn default btn-outline" href="javascript:;">
                                                                    <i class="icon-magnifier"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="btn default btn-outline" href="javascript:;">
                                                                    <i class="icon-link"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mt-card-content">
                                                    <h3 class="mt-card-name">Descrição</h3>
                                                    <p class="mt-card-desc font-grey-mint">Finance Director</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <div class="mt-card-item">
                                                <div class="mt-card-avatar mt-overlay-1 mt-scroll-up">
                                                    <img src="<?php echo IMG; ?>manutencao.jpg" alt=""> 
                                                    <div class="mt-overlay">
                                                        <ul class="mt-info">
                                                            <li>
                                                                <a class="btn default btn-outline" href="javascript:;">
                                                                    <i class="icon-magnifier"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="btn default btn-outline" href="javascript:;">
                                                                    <i class="icon-link"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mt-card-content">
                                                    <h3 class="mt-card-name">Descrição</h3>
                                                    <p class="mt-card-desc font-grey-mint">Creative Director</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <div class="mt-card-item">
                                                <div class="mt-card-avatar mt-overlay-1 mt-scroll-left">
                                                    <img src="<?php echo IMG; ?>manutencao.jpg" alt=""> 
                                                    <div class="mt-overlay">
                                                        <ul class="mt-info">
                                                            <li>
                                                                <a class="btn default btn-outline" href="javascript:;">
                                                                    <i class="icon-magnifier"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="btn default btn-outline" href="javascript:;">
                                                                    <i class="icon-link"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mt-card-content">
                                                    <h3 class="mt-card-name">Descrição</h3>
                                                    <p class="mt-card-desc font-grey-mint">HR Director</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="modal-footer" style="margin: -10px; background-color: #f5f5f5; text-align: center !important;" >
                                        
                                    <!-- VERIFICAR SE O IF VAI ENTRAR AQUI... POIS O ORIGINAL NÃO VAI PARA LUGAR NENHUM -->
                                    <a href="<?php echo RAIZ.'servico/formulario'; ?>" style="margin-top: 0px;" target="" class=" btn btn-circle btn-success uppercase" align="center">Solicitar Serviço</a>
                                
                                </div>
                            </div>
                        </div>
                        <!-- FIM CONTEÚDO SERVIÇOS -->
                        
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
