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
                <h4 class="modal-title"><b>CADASTRO DE NOVA VIEW</b></h4>
            </div>
            
            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'view.php' ?>">
                <div class="modal-body">
                    <div class="fetched-data">
                        <input type="hidden" name="arrDadosForm[tabela]" value="gr_view" />
                        <input type="hidden" name="arrDadosForm[method]" value="cadastrar" />
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Nome da página?<span class="required" aria-required="true">*</span></label>
                                <input class="form-control spinner" maxlength="20" name="arrDadosForm[str_view]" id="view" type="text" required> 
                            </div>
                            
                            <div class="form-group col-md-6"> 
                                <label class="control-label">Página será relacionado a qual Módulo? <span class="required" aria-required="true">*</span></label>
                                <select name="arrDadosForm[id_modulo]" id="modulo" class="bs-select form-control" data-live-search="true" data-size="5" required>
                                    <?php
                                        echo $oController->comboListar('gr_modulo', 'id_modulo', 'str_modulo');
                                    ?>
                                </select>
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