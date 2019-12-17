<?php
    $oMateriais->abrirSessaoUsuarioExterno();
    $dados = $oMateriais->listaMaterialEspecifico($p1);
?>
<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Detalhes do Material <small>Saiba mais sobre este produto</small>
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
            <i class="icon-layers"></i>
            <span>Detalhes do Material</span>
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

        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase">Informações do Material: <scan class="font-blue"><?php echo $dados['material']; ?></scan></span>
                </div>
                <div class="actions">
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="row">
                            <?php for ($j = 0; $j < count($dados['imagem']); $j++) { ?>
                            <div class="col-sm-6">
                                <div class="mt-element-card mt-element-overlay">
                                    <div class="mt-card-item">
                                        <div class="mt-card-avatar mt-overlay-1">
                                            <a href="<?php echo PUBLICO; ?>/anexos/<?php echo $dados['imagem'][$j]; ?>" class="fancybox-button" data-rel="fancybox-button">
                                                <img class="img-responsive" src="<?php echo PUBLICO; ?>/anexos/<?php echo $dados['imagem'][$j]; ?>" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <br>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                        <div class="panel panel-default">
                            <div class="panel-heading"> Descrição Geral </div>
                            <div class="panel-body">
                                <?php echo $dados['descricao']; ?>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item"> 
                                    Material: <span class="label label-primary"> <?php echo $dados['material']; ?> </span>
                                </li>
                                <li class="list-group-item"> 
                                    Categoria: <span class="label label-info"> <?php echo $dados['categoria']; ?> </span>
                                </li>
                            </ul>
                        </div>
                        <form method="POST" action="<?php echo CONTROLLER . 'materiais.php'; ?>" class="form-horizontal ">
                            <input type="hidden" name="idProduto"  value="<?php echo $dados['id']; ?>">
                            <input type="hidden" name="nomeProduto"  value="<?php echo $dados['material']; ?>">
                            <input type="hidden" name="imagemProduto"  value="addCarrinho">
                            <input type="hidden" name="maxEstoque"  value="<?php echo $dados['qtd_estoque']; ?>">
                            
                            <div class="form-body">

                                <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                    <div class="form-group col-md-6">   

                                    <label class="control-label" >Quantidade:<span class="required" aria-required="true">*</span></label>
                                    <input id="touchspin_des_material" name="int_qtd_estoque" type="text" value="" required>
                                    <span class="help-block"> Seja <b>eficiente</b> e solicite somente o necessário. Estoque de <?php echo $dados['qtd_estoque']; ?>.</span>  
                                    </div>
                                    <div class="form-group col-md-6" style="margin-left: 40px;">
                                        <?php if (isset($_SESSION['VALID'])) { ?>
                                            <input type="hidden" name="arrDadosForm[method]"   value="addCarrinhoUsuarioInterno">
                                            <input type="submit" value="Adicionar Ao carrinho" class="cbp-l-project-details-visit btn btn-circle blue uppercase" align="left" >
                                            <a href="<?php echo RAIZ . 'materiais/carrinho'; ?>" target="" class="cbp-l-project-details-visit btn btn-circle red-mint uppercase">Finalizar Pedido</a>
                                        <?php } else { ?>
                                            <input type="hidden" name="method"   value="addCarrinhoUsuarioExterno">
                                            <input type="submit" value="Adicionar Ao carrinho" class="cbp-l-project-details-visit btn btn-circle blue-hoki uppercase" align="left" >
                                            <a href="<?php echo RAIZ . 'materiais/final_pedido'; ?>" target="" class="cbp-l-project-details-visit btn red-mint btn-info uppercase">Finalizar Pedido</a>
                                        <?php } ?>
                                    </div>
                                </div>

                           </div> 
                        </form>
                    </div>
                </div>

            </div>
            
            
        </div>

    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function () {
        
        ValorMaximo = <?php echo $dados['qtd_estoque']; ?>;
        $("#touchspin_des_material").TouchSpin({
            min: 1,
            max: ValorMaximo,
            buttondown_class: "btn grey-salsa",
            buttonup_class: "btn grey-salsa"
        });
        
    });
</script>