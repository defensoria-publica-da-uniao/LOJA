<?php 
    $consulta=$oUsuario->auditoria();
?>
<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Histórico Geral <small>Listagem de ações realizadas</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-settings"></i>
            <span>Administrador</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Auditoria</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="icon-eye"></i>
            <a href="<?php echo RAIZ . "usuario/auditoria"; ?>">Histórico Geral</a>
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
                <div class="caption font-dark">
                    <span class="caption-subject bold uppercase"> Histórico Geral</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table id="sample_1" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th class="text-center">Data e Hora</th>
                            <th class="text-center">Usuário</th>
                            <th class="text-center">Ação Realizada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($dados=mssql_fetch_array($consulta)) { ?>
                            <tr>
                                <td class="text-center"><?php echo  date('d/m/Y H:i:s', strtotime($dados['dt_ocorrido']));?></td>
                               <td class="text-center"><?php echo $dados['str_login'];?></td>
                               <td class="text-center"><?php echo utf8_encode($dados['str_descricao']);?></td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>

            </div>

            
        </div>

    </div>
</div>
