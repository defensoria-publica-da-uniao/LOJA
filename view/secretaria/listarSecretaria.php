<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Listar Secretaria <small>Listagem registradas no sistema</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-settings"></i>
            <span>Administrador</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>DPU</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="icon-size-fullscreen"></i>
            <a href="<?php echo RAIZ . "secretaria/listarSecretaria"; ?>">Secretarias</a>
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
            
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet-title">
                <div class="caption font-dark">
                    <span class="caption-subject bold uppercase">Controle de Unidades</span>
                </div>
                <div class="actions">
                    <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target='#novoCadastro' class="btn dropdown-toggle" data-toggle="dropdown">
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

                            <th class="all" style="width: 5% !important;">Ação</th>
                            <th class="all">Secretaria</th>
                            <th class="min-tablet desktop">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $resultSecretaria = $oSecretaria->listar();
                            while ($arSecretaria = mssql_fetch_array($resultSecretaria)){
                        ?>
                        <tr>
                            <td>
                                <div class="btn-toolbar" style="margin-left:0px !important;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default blue-madison mod popovers" data-toggle="modal" data-doc="<?php echo $arSecretaria['id_secretaria']; ?>" data-target='#editarCadastro' data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Editar">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div>
                                        <?php 
                                            if( $arSecretaria["str_situacao"] == 'D' ){ #Desativado
                                                $classIcon = 'fa fa-remove'; 
                                                $msgAcao = 'Ativar secretaria?';
                                                $corBtn = 'btn btn-danger';
                                             } else{ // Ativado
                                                $classIcon = 'fa fa-check-square'; 
                                                $msgAcao = 'Desativar secretaria?';
                                                $corBtn = 'btn btn-success';
                                             }
                                        ?>
                                    <div style="float: right !important;" > <!-- class="btn-group"  -->
                                        <form action="<?php echo CONTROLLER . 'secretaria.php'; ?>" method="POST">
                                            <button type="submit" class="<?php echo $corBtn; ?> btn-xs mod" data-toggle="confirmation" data-original-title="<?php echo $msgAcao; ?>">
                                                <input type='hidden' name='arrDadosForm[str_situacao]' value="<?php echo $arSecretaria["str_situacao"]; ?>" />
                                                <input type='hidden' name='arrDadosForm[id]' value="<?php echo $arSecretaria['id_secretaria']; ?>" />
                                                <input type="hidden" name="arrDadosForm[tabela]" value="gr_secretaria" />
                                                <input type="hidden" name="arrDadosForm[campo_where]" value="id_secretaria" />
                                                <input type="hidden" name="arrDadosForm[method]" value="desativar" />
                                                <i class="<?php echo $classIcon; ?>"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo utf8_encode($arSecretaria['str_sigla']) . " - " . utf8_encode($arSecretaria['str_descricao']); ?></td>
                            <td><?php echo utf8_encode($arSecretaria['str_email']); ?></td>
                        </tr>
                        <?php 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
            
        </div>

    </div>
</div>

<?php
    include 'modal/editarSecretaria.php';
    include 'modal/novaSecretaria.php'; 
?>

<!-- Ajax para editar Secretarias DPGU -->
<script>
    $(document).ready(function () {
        $('#editarCadastro').on('show.bs.modal', function (e) {
            var idSecretaria = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'POST',
                data: 'idSecretaria='+idSecretaria+'&method=listar&acao=ajax',
                url: '<?php echo CONTROLLER; ?>secretaria.php', 
                success: function(data){
                     var response = $.parseJSON(data); 
                     $("#id").val(response.id_secretaria);
                     $("#secretaria_pai").val(response.id_secretaria_pai);
                     $("#sigla").val(response.sigla);
                     $("#secretaria").val(response.descricao);
                     $("#email").val(response.email);
                }
            });
        });
        //Mensagem de Sucesso/Erro Pulsante
        UIGeneral.init();
    });
</script>