<?php
    $consultaCarrinho = $oController->consultaCarrinho($_SESSION['LOGIN']['id_usuario']);
    $valorCarrinho = mssql_num_rows($consultaCarrinho);
?>

<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Carrinho <small>Produtos registrados para pedidos</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="glyphicon glyphicon-shopping-cart"></i>
            <a href="<?php echo RAIZ . "materiais/carrinho"?>">Carrinho</a>
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

        <?php if ($valorCarrinho <> 0) { ?>
        <div class="portlet light ">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet-title">
                <div class="caption font-dark">
                    <span class="caption-subject bold uppercase">Produtos no carrinho</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                    <thead>
                        <tr>
                            <!-- class:[ all ]-> "Coluna visivél quando for TELEFONE e DESKTOP -->
                            <!-- class:[ min-phone-l ]-> "Coluna visivél quando for TELEFONE -->
                            <!-- class:[ min-tablet ]-> "Coluna visivél quando for TABLET -->
                            <!-- class:[ desktop ]-> "Coluna visivél quando for DESKTOP -->
                            <th width="6%" class="all">Produto</th>
                            <th width="30%" class="min-phone-l min-tablet desktop">Descrição</th>
                            <th width="20%" class="min-phone-l min-tablet desktop">Quantidade</th>
                            <th width="20%" class="all text-center" >Remover da lista</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $contador = 0;
                            while ($dadosCarrinho = mssql_fetch_array($consultaCarrinho)) {
                            $id_solicitacao_provisoria = $dadosCarrinho['id_solicitacao_provisoria'];
                        ?>
                        <tr>
                            <td>
                                <div class="mt-element-card mt-element-overlay">
                                    <div class="mt-card-item">
                                        <div class="mt-card-avatar mt-overlay-1">
                                            <a href="<?php echo PUBLICO . 'anexos/' . $dadosCarrinho['str_nome_criptografado']; ?>" class="fancybox-button" data-rel="fancybox-button">
                                                <img class="img-responsive" src="<?php echo PUBLICO . 'anexos/' . $dadosCarrinho['str_nome_criptografado']; ?>" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="<?php echo utf8_encode($dadosCarrinho['str_material']); ?>" disabled> 
                                </div>
                            </td>
                            <td>
                                <form action="<?php echo CONTROLLER . 'materiais.php'; ?>" method="POST">
                                    <input type="hidden" name="method" value="AtualizarQtdProduto" />
                                    <input type="hidden" name="idMaterialSolicitacaoProvis" value="<?php echo $dadosCarrinho['id_material_solicitacao_provis']; ?>" />
                                    <div class="input-group">
                                        <input id="touchspin_11_<?php echo $contador; ?>" type="text" name="qtdProduto" value="<?php echo $dadosCarrinho['qtd_solicitacao']; ?>" >
                                        <!-- <input type="number" class="form-control" name="qtdProduto" value="<?php echo $dadosCarrinho['qtd_solicitacao']; ?>" max="<?php echo $dadosCarrinho['int_qtd_estoque']; ?>" min="1" required> -->
                                        <span class="input-group-btn">
                                            <button class="btn blue-madison" type="submit">Atualizar</button>
                                        </span>
                                        
                                    </div>
                                    <span class="help-block"> Estoque de <?php echo $dadosCarrinho['int_qtd_estoque']; ?> </span>
                                </form>
                            </td>
                            <td align="center">
                                <form action="<?php echo CONTROLLER . 'materiais.php'; ?>" method="POST">
                                   
                                        <input type="hidden" name="method" value="removerProduto" />
                                        <input type="hidden" name="id_material_solicitacao_provisoria" value="<?php echo $dadosCarrinho['id_material_solicitacao_provis']; ?>" />
                                         <button type="submit" class="btn btn-danger" data-toggle="confirmation" data-original-title="Remover produto">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php 
                                if(empty($MaxEstoqu)){
                                       $MaxEstoqu = $dadosCarrinho['int_qtd_estoque']; 
                                }else{
                                 $MaxEstoqu .= '-'.$dadosCarrinho['int_qtd_estoque']; 
                                }

                                $contador = $contador +1;
                            } 
                        ?>
                    </tbody>
                   
                </table>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <hr>
                        <center>
                        <form action="<?php echo CONTROLLER . 'materiais.php'; ?>" method="POST">
                            <input type="hidden" name="method" value="finalizarPedido" />
                            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['LOGIN']['id_usuario'];?>" />
                            <input type="hidden" name="id_solicitacao_provisoria" value="<?php echo $id_solicitacao_provisoria; ?>" />
                            <input type="submit"  class="btn btn-success uppercase" value="Finalizar Pedido">
                        </form>
                        </center>
                    </div>
                </div>
                
            </div>
        <!-- END EXAMPLE TABLE PORTLET-->
        
        </div>
        <br>
        <?php } else { ?>
        
        <div class="row">
            <div class="col-md-12 page-500">
                <div class=" number font-blue"><i class="glyphicon glyphicon-shopping-cart"></i></div>
                <div class=" details">
                    <h3 class="font-blue">Opa! Seu carrinho encontra-se vazio.</h3>
                    <p> Verifique os produtos e serviços disponiveis em nossa loja.
                    </p>
                    <p>
                        <a href="<?php echo RAIZ . "materiais/materiais"; ?>" class="btn blue btn-outline"> Produtos e Serviços </a>
                        <br>
                    </p>
                </div>
            </div>
        </div>
        
        <?php } ?>
        
    </div>
</div>







<script type="text/javascript">
    
    $(document).ready(function () {
        var Maxarray;
        var MaxTemp;
        var contid;
        var contTotal;

        //definando valor maximo for
        contTotal=<?php echo $contador; ?>
        //recebendo array php
        Maxarray= '<?php echo $MaxEstoqu; ?>';                              
        //transformando array js
        Maxarray=Maxarray.split('-');
        //alert(Maxarray);
        for (i = 0; i < contTotal; i++) { 
            MaxTemp =Maxarray[i];
            //alert("quantidade: " + MaxTemp) 
            contid = '#touchspin_11_'+i;
            $(contid).TouchSpin({
                buttondown_class: "btn grey-salsa",
                buttonup_class: "btn grey-salsa",
                min: 1,
                max: MaxTemp,
            });

        }
        
        // Pulsante da Mensagem de Sucesso ou Erro
        UIGeneral.init();
    });
</script>



