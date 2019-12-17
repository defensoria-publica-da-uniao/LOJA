<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Gerenciar Categoria <small>Subtitulo ou descrição</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-folder-alt"></i>
            <span>Produtos - Materiais</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="icon-share"></i>
            <a href="<?php echo RAIZ . "categorias/listarCategorias"; ?>">Categorias</a>
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
                    <span class="caption-subject sbold uppercase">Resultados</span>
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
                            <!-- class:[ all ]-> "Coluna visivél quando for TELEFONE e DESKTOP -->
                            <!-- class:[ min-phone-l ]-> "Coluna visivél quando for TELEFONE -->
                            <!-- class:[ min-tablet ]-> "Coluna visivél quando for TABLET -->
                            <!-- class:[ desktop ]-> "Coluna visivél quando for DESKTOP -->
                            <th style="width: 5% !important;" class="all text-center">Ação</th>
                            <th class="all text-center">Categoria</th>
                            <th class="min-tablet desktop text-center">Complexidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $resultCategorias=$oCategorias->listar();
                            while ($dadosInicial = mssql_fetch_array($resultCategorias)) {
                        ?>
                        <tr>
                            <td>
                                <div class="btn-toolbar" style="margin-left:0px !important;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default blue-madison mod popovers" data-toggle="modal" data-doc="<?php echo $dadosInicial['id_categoria']; ?>" data-target='#editarCategoria' data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Editar">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div> 
                                    <div style="float: right !important;" > <!-- class="btn-group"  -->
                                        <?php 
                                            if ($dadosInicial["str_status"] == 'D') { #Desativado
                                                $classIcon = 'fa fa-remove'; 
                                                $msgAcao = 'Ativar Categoria?';
                                                $corBtn = 'btn btn-danger';
                                             } else{ // Ativado
                                                $classIcon = 'fa fa-check-square'; 
                                                $msgAcao = 'Desativar Categoria?';
                                                $corBtn = 'btn btn-success';
                                             }
                                        ?>
                                        <form action="<?php echo CONTROLLER . 'categorias.php'; ?>" method="POST">
                                            <button type="submit" class="<?php echo $corBtn; ?> btn-xs mod" data-toggle="confirmation" data-original-title="<?php echo $msgAcao; ?>">
                                                <input type='hidden' name='arrDadosForm[str_status]' value="<?php echo $dadosInicial["str_status"]; ?>" />
                                                <input type='hidden' name='arrDadosForm[id]' value="<?php echo $dadosInicial['id_categoria']; ?>" />
                                                <input type="hidden" name="arrDadosForm[tabela]" value="tb_categoria" />
                                                <input type="hidden" name="arrDadosForm[campo_where]" value="id_categoria" />
                                                <input type="hidden" name="arrDadosForm[method]" value="desativar" />
                                                <i class="<?php echo $classIcon; ?>"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><?php echo utf8_encode($dadosInicial['str_categoria'])?></td>
                            <td class="text-center"><?php echo utf8_encode($dadosInicial['str_complexidade']) ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
        </div>

    </div>
</div>

<?php 
    include 'modal/cadastrarCategoria.php';
    include 'modal/editarCategoria.php';
?>
    
    <script>
    
        $(document).ready(function () {
        $('#editarCategoria').on('show.bs.modal', function (e) { 
           var idCategoria = $(e.relatedTarget).data('doc');
           
           $.ajax({
               type: 'POST',
              data: 'idCategoria='+idCategoria+'&method=listar&acao=ajax',             
               url: '<?php echo CONTROLLER; ?>categorias.php', 
               success: function(data){ 
                    var response = $.parseJSON(data); 
                    $("#str_categoria").val(response.categoria);
                    $("#id").val(response.id);  
                    
               }             
           });
        });
        // Pulsante da Mensagem de Sucesso ou Erro
        UIGeneral.init();
    });
</script>