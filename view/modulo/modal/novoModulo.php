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
                <h4 class="modal-title"><b>CADASTRO DE MÓDULO</b></h4>
            </div>
            
            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'modulo.php' ?>">
                <div class="modal-body">
                    <div class="fetched-data">
                        <input type="hidden" name="arrDadosForm[tabela]" value="gr_modulo" />
                        <input type="hidden" name="arrDadosForm[method]" value="cadastrar" />
                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">Nome do módulo?<span class="required" aria-required="true">*</span></label>
                                <input class="form-control spinner" maxlength="20" name="arrDadosForm[str_modulo]" id="modulo" type="text" placeholder="Máximo de 20 caracteres" required>
                                <span class="help-block"> Proibido caracteres especiais, acentuação, palavras separadas por espaço. </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background:#F5F5F5; border-radius: 0 0 10px 10px;">
                    <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-circle">Cadastrar</button>
                </div>
            </form>
            
        </div>
    </div>
</div>