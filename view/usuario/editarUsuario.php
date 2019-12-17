<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Editar dados <small>Registros do usuário</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-user"></i>
            <span>Usuário</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="icon-settings"></i>
            <a href="<?php echo RAIZ . "usuario/editarUsuario"; ?>">Editar dados</a>
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

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <!-- IMG -->
                <div class="profile-sidebar">
                    <div class="portlet light profile-sidebar-portlet ">
                        <div class="profile-userpic">
                            <img src="<?php echo IMG; ?>no-user-2.jpg" class="img-responsive" alt=""> 
                        </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"><?php echo $_SESSION ['LOGIN']['str_nome']; ?></div>
                            <div class="profile-usertitle-job"><?php echo $_SESSION ['LOGIN']['str_perfil']; ?> </div>
                        </div>
                        <div class="profile-usermenu"></div>
                    </div>
                </div>
                <!-- IMG -->
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="tab-pane" >
                                <div class="portlet box blue-madison" style="border-radius: 4px;">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-file-text-o"></i> - Formulário de Atualização de Dados </div>
                                        <div class="tools">
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                                        <form class="horizontal-form" role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'usuario.php' ?>">
                                            <div class="form-body">
                                                <h3 class="form-section">Informação Pessoal</h3>
                                                <input type="hidden" name="arrDadosForm[tabela]" value="gr_usuario" />
                                                <input type="hidden" id="id" name="arrDadosForm[id]" /> 
                                                <input type="hidden" id="campo_where" name="arrDadosForm[campo_where]" value="id_usuario" />
                                                <input type="hidden" name="arrDadosForm[method]" value="alterar" />
                                                <input type="hidden" name="arrDadosForm[acao]" value="editar" />

                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class="control-label">Nome:<span class="required" aria-required="true">*</span></label>
                                                            <input class="form-control" type="text" name=""  value="" id="nome" type="text" placeholder="Nome" disabled> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Login:<span class="required" aria-required="true">*</span></label>
                                                            <input class="form-control" type="text" name=""  value="" id="login" type="text" placeholder="Login" disabled> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class="control-label">Email:<span class="required" aria-required="true">*</span></label>
                                                            <input class="form-control" type="email" name="arrDadosForm[str_email]"  value="" id="email" type="text" placeholder="E-mail" required> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Telefone:<span class="required" aria-required="true">*</span></label>
                                                            <input class="form-control" type="text" name="arrDadosForm[str_telefone]"  value="" id="telefone" type="text" placeholder="Telefone" onkeyup="maskIt(this, event, '(##) #####-####')" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Unidade DPU / Área DPGU:<span class="required" aria-required="true">*</span></label>
                                                            <select id="def" class="form-control" name="def" required>
                                                                <option value="" selected>Selecione</option>
                                                                <option value="DPGU">DPGU - Administração Superior</option>
                                                                <option value="DPU">DPU - Órgão de Atuação (Unidade)</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        
                                                        <div class="form-group" id="unidade">
                                                            <label class="control-label">Unidade:</label>
                                                            <select class="bs-select form-control" data-live-search="true" data-size="5" name="arrDadosForm[id_unidade]" id="unidade_sel">
                                                            <?php
                                                                $resultUnidade = $oUsuario->listarUnidade();
                                                                while ($arUnidade = mssql_fetch_array($resultUnidade)){
                                                                    echo "<option value=".$arUnidade['id_unidade'].">".$arUnidade['str_uf']." - ".utf8_encode($arUnidade['str_descricao'])."</option>";
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group" id="secretaria">
                                                            <label class="control-label">Secretaria:</label>
                                                            <select class="bs-select form-control" data-live-search="true" data-size="5" name="arrDadosForm[id_secretaria]" id="secretaria_sel">
                                                            <?php
                                                                $resultSecretaria = $oUsuario->listarSecretaria();
                                                                while ($arSecretaria = mssql_fetch_array($resultSecretaria)){
                                                                    echo "<option value=".$arSecretaria['id_secretaria'].">".$arSecretaria['str_sigla']." - ".utf8_encode($arSecretaria['str_descricao'])."</option>";
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                            </div>
                                            <div class="form-actions right">
                                                <button type="submit" class="btn blue-madison btn-circle">
                                                    <i class="fa fa-check"></i> Salvar</button>
                                            </div>
                                        </form>
                                        <!-- END FORM-->
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
</div>

<!-- Ajax para editar Usuário -->
<script>
    $(document).ready(function () {
        
        $('#secretaria').css('display', 'none');
        $('#unidade').css('display', 'none');
        
        $('#def').change(function () {
            if ($('#def').val() == 'DPGU') {
                $('#secretaria').show('slow');
                $('#unidade').hide('slow');
            } else if ($('#def').val() == 'DPU') {
                $('#secretaria').hide('slow');
                $('#unidade').show('slow');
            } else {
                $('#secretaria').hide('slow');
                $('#unidade').hide('slow');
            }
        });
        
        
        var idUsuario = '<?php echo $_SESSION['LOGIN']['id_usuario'] ?>';
        $.ajax({
             type: 'POST',
             data: 'idUsuario='+idUsuario+'&method=listar&acao=ajax',
             url: '<?php echo CONTROLLER; ?>usuario.php', 
             success: function(data){
                  var response = $.parseJSON(data); 
                  $("#id").val(response.id);
                  $("#nome").val(response.nome);
                  $("#login").val(response.login);
                  $("#email").val(response.email);
                  $("#telefone").val(response.telefone);
                  $("#secretaria_sel").val(response.secretaria);
                  $("#unidade_sel").val(response.unidade);
                  
                  if(response.secretaria !== null) {
                        $("#def").val("DPGU");
                        $("#secretaria").css('display', 'block');
                  } else if (response.unidade !== null) {
                        $("#def").val("DPU");
                        $("#unidade").css('display', 'block');
                  } else {
                        $("#def").val();
                  }
            }
        });
        
        // Pulsante da Mensagem de Sucesso ou Erro
        UIGeneral.init();
    });
</script>
