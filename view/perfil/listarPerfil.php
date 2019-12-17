    <!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
    <h1 class="page-title">
        Perfil de Usuário <small>Cada perfil pode ser configurado para acessar uma área restrita do sistema.</small>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-settings"></i>
                <span>Administrador</span>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <i class="icon-shield"></i>
                <a href="<?php echo RAIZ . "perfil/listarPerfil"; ?>">Perfil de Usuário</a>
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
                        <i class="fa fa-list "></i>
                        <span class="caption-subject sbold uppercase">Controle de Perfil</span>
                    </div>
                    <div class="actions">
                        <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target='#novoCadastro' class="btn dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-street-view"></i> Novo registro
                        </button>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                        <thead>
                            <tr>
                                <th style="width: 5% !important;" class="text-center">Ação</th>
                                <th>Perfil</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                                $resultPerfil = $oPerfil->listar();
                                while ($arPerfil  = mssql_fetch_array($resultPerfil)){
                            ?>
                            <tr>
                                <td>
                                    <div class="btn-toolbar" style="margin-left:0px !important;">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default blue-madison mod popovers" data-toggle="modal" data-doc="<?php echo $arPerfil['id_perfil']; ?>" data-target='#editarCadastro' data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Editar">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </div>
                                        <div style="float: right !important;" > <!-- class="btn-group"  -->
                                            <div id="acaoAlterar" class="">
                                                <form action="<?php echo CONTROLLER . 'perfil.php'; ?>" method="POST">
                                                    <button type="submit" class="btn btn-danger btn-xs mod" data-toggle="confirmation" data-original-title="Excluir perfils?">
                                                        <input type='hidden' name='arrDadosForm[id]' value="<?php echo $arPerfil['id_perfil']; ?>" />
                                                        <input type="hidden" name="arrDadosForm[tabela]" value="gr_perfil" />
                                                        <input type="hidden" name="arrDadosForm[method]" value="deletar" />
                                                        <input type="hidden" name="arrDadosForm[campo_where]" value="id_perfil" />
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $arPerfil ['str_perfil']; ?></td>
                            </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                    
                </div>
                            
            </div>
        </div>
    </div>



<?php 
    include 'modal/editarPerfil.php';
    include 'modal/novoPerfil.php'; 
?>

<!-- Ajax para editar Unidade DPU e Área DPGU -->
<script>
    $(document).ready(function () { 
        $('#editarCadastro').on('show.bs.modal', function (e) { 
           var idPerfil = $(e.relatedTarget).data('doc');
           
           $.ajax({
               type: 'POST',
               data: 'idPerfil='+idPerfil+'&method=listar&acao=ajax',
               url: '<?php echo CONTROLLER; ?>perfil.php', 
               success: function(data){ 
                    var response = $.parseJSON(data); 
                    $("#perfil").val(response.perfil);
                    $("#id").val(response.id);
                    
               }
           });
        });
        
        // Pulsante da Mensagem de Sucesso ou Erro
        UIGeneral.init();
    });
</script>
