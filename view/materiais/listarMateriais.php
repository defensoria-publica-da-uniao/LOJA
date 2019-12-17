<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Gerenciar Materias <small>Listagem de produtos registrados</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-folder-alt"></i>
            <span>Produtos - Materiais</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="icon-layers"></i>
            <a href="<?php echo RAIZ . "materiais/listarMateriais"; ?>">Gerenciar Produtos</a>
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
                    <span class="caption-subject sbold uppercase">Materias registrados</span>
                </div>
                <div class="actions">
                    <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target='#cadastrarRegistro' class="btn dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-plus"></i> Novo registro
                    </button>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                    <thead>
                        <tr>
                            <th style="width: 5% !important;" class="text-center">Ação</th>
                            <th width="6%" class="text-center">Imagem</th>
                            <th class="text-center">Materiais</th>
                            <th class="text-center">Categoria</th>
                            <th class="text-center">Estoque</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $resultCategorias = $oMateriais->listar();
                            while ($dadosInicial = mssql_fetch_array($resultCategorias)) {
                        ?>
                        <tr>
                            <td>
                                <div class="btn-toolbar" style="margin-left:0px !important;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default blue-madison mod popovers" data-toggle="modal" data-doc="<?php echo $dadosInicial['id_material']; ?>" data-target='#editar' data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Editar">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div> 
                                    <div style="float: right !important;" > <!-- class="btn-group"  -->
                                        <?php 
                                            if ($dadosInicial["str_status"] == 'D') { #Desativado
                                                $classIcon = 'fa fa-remove'; 
                                                $msgAcao = 'Ativar Material?';
                                                $corBtn = 'btn btn-danger';
                                             } else{ // Ativado
                                                $classIcon = 'fa fa-check-square'; 
                                                $msgAcao = 'Desativar Material?';
                                                $corBtn = 'btn btn-success';
                                             }
                                        ?>
                                        <form action="<?php echo CONTROLLER . 'materiais.php'; ?>" method="POST">
                                            <button type="submit" class="<?php echo $corBtn; ?> btn-xs mod" data-toggle="confirmation" data-original-title="<?php echo $msgAcao; ?>">
                                                <input type='hidden' name='arrDadosForm[str_status]' value="<?php echo $dadosInicial["str_status"]; ?>" />
                                                <input type='hidden' name='arrDadosForm[id]' value="<?php echo $dadosInicial['id_material']; ?>" />
                                                <input type="hidden" name="arrDadosForm[tabela]" value="tb_material" />
                                                <input type="hidden" name="arrDadosForm[campo_where]" value="id_material" />
                                                <input type="hidden" name="arrDadosForm[method]" value="desativar" />
                                                <i class="<?php echo $classIcon; ?>"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="mt-element-card mt-element-overlay">
                                    <div class="mt-card-item">
                                        <div class="mt-card-avatar mt-overlay-1">
                                            <a href="<?php echo PUBLICO . 'anexos/' . $dadosInicial['str_nome_criptografado']; ?>" class="fancybox-button" data-rel="fancybox-button">
                                                <img class="img-responsive" src="<?php echo PUBLICO . 'anexos/' . $dadosInicial['str_nome_criptografado'];?>" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><?php echo utf8_encode($dadosInicial['str_material']) ?></td>
                            <td class="text-center"><?php echo utf8_encode($dadosInicial['str_categoria']) ?></td>
                            <td class="text-center"><?php echo $dadosInicial['int_qtd_estoque']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
        </div>

    </div>
</div>

<?php
    include 'modal/cadastrarMaterial.php';
    include 'modal/editarMaterial.php';
?>

<script>

    function criarAkel(valor){
    var Estoque=valor;
    $("#touchspin_6_editar").TouchSpin({
        min: 1,
        max: 1000000000,
        initval: Estoque,
        buttondown_class: "btn grey-salsa",
        buttonup_class: "btn grey-salsa"
    });
    }
    $(document).ready(function () {
        
        $('#editar').on('show.bs.modal', function (e) {
            var idMaterial = $(e.relatedTarget).data('doc');
            
            $.ajax({
                type: 'POST',
                data: 'idMaterial='+idMaterial+'&method=listar&acao=ajax',
                url: '<?php echo CONTROLLER; ?>materiais.php',
                success: function (data) {
                    //retorno de array json                   
                    var response = $.parseJSON(data);
                    var id_categoria=response.id_categoria;
                    //Valores substituidos no formulario
                    $("#material").val(response.material);
                    $("#id").val(response.id);
                    $("#touchspin_6_editar").val(response.numero);
                    $("#descricao").val(response.descricao);
                   var anexo_principal=response.id_anexo_principal;
                  
                   
                    //Ajax para chamar anexos
                    $.ajax({
                        type: 'POST',
                        data: 'idMaterial=' + idMaterial + '&anexo_principal='+anexo_principal+'&method=listarAnexos&acao=ajax',
                        url: '<?php echo CONTROLLER; ?>materiais.php',
                        success: function (data) {
                            $('.fetched-data3').html(data);
                        }
                    });
                    //Ajax para carregar a categoria
                    $.ajax({
                        type: 'POST',
                        data: 'id_categoria=' + id_categoria + '&method=listarCategoriasSelecionado&acao=ajax',
                        url: '<?php echo CONTROLLER; ?>materiais.php',
                        success: function (data) {
                            $('.id_categoria').html(data);

                        }
                    });
                    // Resetar o valor do estoque 
                    criarAkel(response.numero).load();
                }
            });
        });
        
        // Pulsante da Mensagem de Sucesso ou Erro
        UIGeneral.init();
    });
</script>
  
<style>
    .div1{
        border: 1px solid; 
        border-color: #47D655 !important;
        box-shadow: 0 5px 20px rgba(46, 209, 59, 82), 0 -1px 0 rgba(0, 0, 0, 0) inset
    }
    .div2{
        border: 1px solid #e7ecf1; 
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.25), 0 -1px 0 rgba(0, 0, 0, 0) inset
    }
    .div3{
        border: 1px solid;
        border-color: red !important;
        box-shadow: 0 5px 20px rgba(209, 86, 79, 82), 0 -1px 0 rgba(0, 0, 0, 0) inset
    }
</style>
