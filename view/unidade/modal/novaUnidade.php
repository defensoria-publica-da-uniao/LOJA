<script type="text/javascript">
    $(function () {
        $("#formLogin").validate();
        $("#formLogin").submit(function () {
            if ($("#formLogin").valid()) {
                enviaForm();
            }
        });
    });  
</script>

<!-- Enviar formulário clicando em Enter -->
<script type="text/javascript">
document.onkeyup=function(e){
    if(e.which == 13){
        document.form_login.submit();
    }
}
</script>

<div class="modal fade bs-modal-lg " id="novoCadastro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>CADASTRO DE UNIDADE</b></h4>
            </div>
            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'unidade.php' ?>">
                <div class="modal-body">
                    <div id="resultModal" class="fetched-data_dpu">
                        <!-- CONTEUDO -->
                        <input type="hidden" name="arrDadosForm[tabela]" value="tb_unidade" />
                        <input type="hidden" name="arrDadosForm[method]" value="cadastrar" />
                        <input type="hidden" name="arrDadosForm[str_situacao]" value="A" />
                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                            <div class="form-group col-md-6">
                                <label style="text-align:left !important;" >Estado:</label>
                                <select name="arrDadosForm[id_estado]" id="estado" class="form-control" required>
                                    <option value=""> Selecione o estado</option>
                                    <?php
                                        $result = $oUnidade->listarEstados();
                                        while ($arEstados = mssql_fetch_array($result)) {
                                            echo "<option value='" . $arEstados['id_estado'] . "'>" . $arEstados['str_uf'] . " - " . utf8_encode($arEstados['str_estado']) . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label style="text-align:left !important;" >Unidade:</label>
                                <input class="form-control spinner" maxlength="50" name="arrDadosForm[str_descricao]" id="perfil" type="text" placeholder="Unidade" required> 
                            </div>
                            <div class="form-group col-md-12">
                                <label style="text-align:left !important;" >Email:</label>
                                <input class="form-control spinner" maxlength="50" name="arrDadosForm[str_email]" id="perfil" type="email" placeholder="Email" required> 
                            </div>
                        </div>
                        <!-- FIM CONTEUDO -->
                    </div>
                </div>
                <div class="modal-footer" style="background:#F5F5F5">
                    <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-circle">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>