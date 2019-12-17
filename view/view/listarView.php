    <!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
    <h1 class="page-title">
        Páginas do Sistema <small>Listagem de todas as páginas/view</small>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-settings"></i>
                <span>Administrador</span>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <i class="icon-screen-desktop"></i>
                <a href="<?php echo RAIZ . "view/listarView"; ?>">Páginas do Sistema</a>
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
                        <span class="caption-subject sbold uppercase">Controle de páginas</span>
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
                                <th style="width: 5% !important;" class="text-center">Ação</th>
                                <th>Páginas</th>
                                <th>Pasta</th>
                                <th>URL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $resultView = $oView->listar();
                            while ($arView = mssql_fetch_array($resultView)) {
                                ?>
                                <tr>
                                    <td align="center">
                                        <form action="<?php echo CONTROLLER . 'view.php'; ?>" method="POST">
                                            <button type="submit" class="btn btn-danger btn-xs mod" data-toggle="confirmation" data-original-title="Excluir view?">
                                                <input type='hidden' name='arrDadosForm[id]' value="<?php echo $arView['id_view']; ?>" />
                                                <input type="hidden" name="arrDadosForm[tabela]" value="gr_view" />
                                                <input type="hidden" name="arrDadosForm[method]" value="deletar" />
                                                <input type="hidden" name="arrDadosForm[campo_where]" value="id_view" />
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td><?php echo $arView ['str_view']; ?></td>
                                    <td><?php echo $arView ['str_modulo']; ?></td>
                                    <td><?php echo $arView ['str_modulo'] . '/' . $arView ['str_view']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
 
<?php
    include 'modal/novaView.php';
?>

<script>
    $(document).ready(function () {
        // Pulsante da Mensagem de Sucesso ou Erro
        UIGeneral.init();
    });
</script>