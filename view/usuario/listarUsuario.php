    <!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
    <h1 class="page-title">
        Controle de Usuários <small>Pessoas registradas que tem acesso ao sistema.</small>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-settings"></i>
                <span>Administrador</span>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <i class="icon-users"></i>
                <a href="<?php echo RAIZ . "usuario/listarUsuario"; ?>">Controle de Usuários</a>
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
                        <span class="caption-subject sbold uppercase">Listagem de Usuários</span>
                    </div>
                    <div class="actions">
                        <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target='#novoCadastro' class="btn dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user-plus"></i> Novo registro
                        </button>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                        <thead>
                            <tr>
                                <th style="width: 5% !important;" class="text-center">Ação</th>
                                <th>Nome</th>
                                <th>Login</th>
                                <th>Perfil</th>
                                <th>Data do Cadastro</th>
                                <th>Criado Por</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $resultUsuario = $oUsuario->listar();
                                
                                //var_dump($oUsuario);
                                //exit();
                                
                                
                                while ($arUsuario = mssql_fetch_array($resultUsuario)){
                                $data_hora = date('d/m/Y H:i', strtotime($arUsuario['dt_registro']));
                            ?>
                            <tr>
                                <td>
                                    <div class="btn-toolbar" style="margin-left:0px !important;">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default blue-madison mod popovers" data-toggle="modal" data-doc="<?php echo $arUsuario['id_usuario']; ?>" data-target='#editarCadastro' data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Editar">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </div> 
                                        <div style="float: right !important;" > <!-- class="btn-group"  -->
                                            <?php 
                                                if( $arUsuario["str_situacao"] == 'D' ){ #Desativado
                                                    $classIcon = 'fa fa-remove'; 
                                                    $msgAcao = 'Ativar usuário?';
                                                    $corBtn = 'btn btn-danger';
                                                 } else{ // Ativado
                                                    $classIcon = 'fa fa-check-square'; 
                                                    $msgAcao = 'Desativar usuário?';
                                                    $corBtn = 'btn btn-success';
                                                 }
                                            ?>
                                            <form action="<?php echo CONTROLLER . 'usuario.php'; ?>" method="POST">
                                                <button type="submit" class="<?php echo $corBtn; ?> btn-xs mod" data-toggle="confirmation" data-original-title="<?php echo $msgAcao; ?>">
                                                   <input type='hidden' name='arrDadosForm[str_situacao]' value="<?php echo $arUsuario["str_situacao"]; ?>" />
                                                    <input type='hidden' name='arrDadosForm[id]' value="<?php echo $arUsuario['id_usuario']; ?>" />
                                                    <input type="hidden" name="arrDadosForm[tabela]" value="gr_usuario" />
                                                     <input type="hidden" name="arrDadosForm[campo_where]" value="id_usuario" />
                                                    <input type="hidden" name="arrDadosForm[method]" value="desativar" />
                                                    <i class="<?php echo $classIcon; ?>"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $arUsuario['str_nome']; ?></td>
                                <td><?php echo $arUsuario['str_login']; ?></td>
                                <td><?php echo $arUsuario['str_perfil']; ?></td>
                                <td><?php echo $data_hora ?></td>
                                <td><?php echo $arUsuario ['str_usr_criador']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                            
            </div>
            
            
            <div class="portlet light ">
                
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-users "></i>
                        <span class="caption-subject sbold uppercase">Quantidade</span>
                    </div>
                    <div class="actions">
                        
                    </div>
                </div>
                <div class="portlet-body">
                    <?php
                        $resultUsuarioAtivo = $oUsuario->listarQuantidade();
                    ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-2 col-md-4 col-lg-offset-3 col-lg-3 col-xl-offset-3 col-xl-3">
                            <div class="text-center ticket-counter">
                                <h4><?php echo $resultUsuarioAtivo[0]; ?></h4>
                                <p class="label label-md label-success bold uppercase">Usuários Ativos</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                            <div class="text-center ticket-counter">
                                <h4><?php echo $resultUsuarioAtivo[1]; ?></h4>
                                <p class="label label-md label-danger bold uppercase">Usuários Inativos</p>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                            <div class="text-center ticket-counter">
                                <h4><?php echo $resultUsuarioAtivo[2]; ?></h4>
                                <p class="label label-md label-info bold uppercase">Usuários Administrador</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                            <div class="text-center ticket-counter">
                                <h4><?php echo $resultUsuarioAtivo[3]; ?></h4>
                                <p class="label label-md label-info bold uppercase">Usuários Técnico</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                            <div class="text-center ticket-counter">
                                <h4><?php echo $resultUsuarioAtivo[4]; ?></h4>
                                <p class="label label-md label-info bold uppercase">Usuários Colaborador</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                            <div class="text-center ticket-counter">
                                <h4><?php echo $resultUsuarioAtivo[5]; ?></h4>
                                <p class="label label-md label-info bold uppercase">Usuários Clientes</p>
                            </div>
                        </div>
                    </div>
                </div>
                            
            </div>
        </div>
    </div>

<?php
    include 'modal/editarCadastro.php';
    include 'modal/novoCadastro.php'; 
?>

<script>
    $(document).ready(function () {
        $('#editarCadastro').on('show.bs.modal', function (e) {
           var idUsuario = $(e.relatedTarget).data('doc'); 
           $.ajax({
               type: 'POST',
               data: 'idUsuario='+idUsuario+'&method=listar&acao=ajax',
               url: '<?php echo CONTROLLER; ?>usuario.php', 
               success: function(data){
                    var response = $.parseJSON(data); 
                    $("#nome").val(response.nome);
                    $("#login").val(response.login);
                    $("#id").val(response.id);
                    $("#perfil").val(response.perfil);
               }
           });
        });
        
        // Pulsante da Mensagem de Sucesso ou Erro
        UIGeneral.init();
        
    });
    
</script>