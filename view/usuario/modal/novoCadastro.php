<script type="text/javascript">
    $(function() {
        $("#formLogin").validate();
        $("#formLogin").submit(function() {
            if ($("#formLogin").valid()) {
                enviaForm();
            }
        });
    });
</script>

<!-- Enviar formulário clicando em Enter -->
<script type="text/javascript">
    document.onkeyup = function(e) {
        if (e.which == 13) {
            document.form_login.submit();
        }
    }
</script>




<div class="modal fade bs-modal-lg" id="novoCadastro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>CADASTRAR NOVO USUÁRIO</b></h4>
            </div>
            <div class="modal-body">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" >Dados gerais</h3>
                    </div>
                    <div class="panel-body">

                        <div class="form-body">
                            <form id="busca_usuario">
                                <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                    <div class="form-group col-md-6">
                                        <label style="text-align:left !important;" >Login:<span class="required" aria-required="true">*</span></label>
                                        <input class="form-control spinner" maxlength="40" name="str_login" id="str_login" type="text" placeholder="Login" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label style="text-align:left !important;" >Verifique se o usuário existe na rede:</label>
                                        <button type="submit" class="form-control btn btn-primary mt-ladda-btn ladda-button btn-circle" >Pesquisar</button>
                                    </div>
                                </div>
                            </form>
                            <div class="fetched-data" style=" display: none;">
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-12'>
                                        <label style='text-align:left !important;' >Nome completo:<span class="required" aria-required="true">*</span></label>
                                        <input class='form-control spinner' maxlength='100' name='nome_usuario' id='nome_usuario' type='text' placeholder='Nome completo' required='' value='' disabled>
                                    </div>
                                </div>
                            </div>

                            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'usuario.php' ?>">
                                <input type="hidden" name="arrDadosForm[tabela]" value="gr_usuario" />
                                <input type="hidden" name="arrDadosForm[str_situacao]" value="A" />
                                <input type="hidden" name="arrDadosForm[method]" value="cadastrar" />
                                <input type="hidden" name="arrDadosForm[str_nome]" id ="nome_usuario2" value=""/>
                                <input type="hidden" name="arrDadosForm[str_login]" id ="login2" value=""/>
                                <input type="hidden" name="arrDadosForm[dt_registro]"  value="<?php echo date('Y-m-d H:i:s'); ?>"/>
                                <input type="hidden" name="arrDadosForm[str_usr_criador]" value="<?php echo $_SESSION ['LOGIN']['str_login'] ?>"/>
                                <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                    <div class="form-group col-md-6">
                                        <label style="text-align:left !important;">Selecione o perfil:<span class="required" aria-required="true">*</span></label>
                                        <div class="form-group">
                                            <select name="arrDadosForm[id_perfil]" id="modulo" class="form-control" required>
                                                <option value=""></option>
                                                <?php
                                                $result = $oUsuario->listarPerfil();
                                                while ($arPerfil = mssql_fetch_array($result)) {
                                                    echo "<option value='" . $arPerfil['id_perfil'] . "'>" . $arPerfil['str_perfil'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6" >
                                        <label style="text-align:left !important; color:#fff;">.</label>
                                        <div class="form-group" align="right">
                                            <button type="button" class="btn btn-default mt-ladda-btn ladda-button btn-circle" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success mt-ladda-btn ladda-button btn-circle"> Cadastrar </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer" style="background:#F5F5F5; border-radius: 0 0 10px 10px;">
            </div>
        </div>
    </div>
</div>

<script>
    // PEGANDO DATA E HORA ATUAIS
    // Função para formatar 1 em 01
    const zeroFill = n => {
        return ('0' + n).slice(-2);
    }

    // Cria intervalo
    const interval = setInterval(() => {
        // Pega o horário atual
        const now = new Date();

        // Formata a data conforme dd/mm/aaaa hh:ii:ss
        const dataHora = zeroFill(now.getUTCDate()) + '/' + zeroFill((now.getMonth() + 1)) + '/' + now.getFullYear() + ' ' + zeroFill(now.getHours()) + ':' + zeroFill(now.getMinutes()) + ':' + zeroFill(now.getSeconds());

        // Exibe na tela usando a div#data-hora
        document.getElementById('data-hora').value = dataHora;
    }, 1000);
    // FIM PEGANDO DATA E HORA ATUAIS
</script>

<script>

    $(document).ready(function() {
        $('#busca_usuario').submit(function(event) {
            event.preventDefault();// using this page stop being refreshing
            var login = $('#str_login').val();

            $.ajax({
                type: 'POST',
                url: '<?php echo CONTROLLER; ?>usuario.php',
                data: 'str_login=' + login + '&method=buscaUsuario',
                success: function(data) {
                    var response = $.parseJSON(data);
                    $('.fetched-data').fadeIn(100);
                    $('#nome_usuario').val(response.nome);
                    $('#nome_usuario2').val(response.nome);
                    $('#login2').val(login);
                }
            });

        });
    });

</script>
