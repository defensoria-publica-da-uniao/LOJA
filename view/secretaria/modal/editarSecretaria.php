
<div class="modal fade bs-modal-lg " id="editarCadastro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="page-title" align="center">
                    <span class="caption-subject font-dark bold uppercase">
                        <div class="m-heading-1 border-blue m-bordered">
                            <h4><b>Editar cadastro de secretaria</b>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            </h4>
                        </div>
                    </span>
                </div>
            </div>
            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'secretaria.php' ?>">
                <div class="modal-body">
                    <div id="resultModal" class="fetched-data_dpu">
                        <input type="hidden" name="arrDadosForm[tabela]" value="gr_secretaria" />
                        <input type="hidden" id="id" name="arrDadosForm[id]" />
                        <input type="hidden" id="campo_where" name="arrDadosForm[campo_where]" value="id_secretaria" />
                        <input type="hidden" name="arrDadosForm[method]" value="alterar" />

                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                            <div class="form-group col-md-12">
                                <label style="text-align:left !important;" >Secretaria Pai:</label>
                                <select name="arrDadosForm[id_secretaria_pai]" id="secretaria_pai" class="form-control" required>
                                    <option value=""> Selecione uma opção.</option>
                                    <?php
                                        $result = $oSecretaria->listarTodasSecretarias();
                                        while ($arSecretaria = mssql_fetch_array($result)) {
                                            echo "<option value='" . $arSecretaria['id_secretaria'] . "'";
                                            //if para adicionar o selected no option
                                            echo ">" . $arSecretaria['str_sigla'] . " - " . utf8_encode($arSecretaria['str_descricao']) . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                            <div class="form-group col-md-6">
                                <label style="text-align:left !important;" >Sigla:</label>
                                <input class="form-control spinner" maxlength="50" name="arrDadosForm[str_sigla]" id="sigla" type="text" placeholder="Sigla" required> 
                            </div>
                            <div class="form-group col-md-6">
                                <label style="text-align:left !important;" >Secretaria:</label>
                                <input class="form-control spinner" maxlength="50" name="arrDadosForm[str_descricao]" id="secretaria" type="text" placeholder="Secretaria" required> 
                            </div>
                            <div class="form-group col-md-12">
                                <label style="text-align:left !important;" >Email:</label>
                                <input class="form-control spinner" maxlength="50" name="arrDadosForm[str_email]" id="email" type="email" placeholder="E-mail" required> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background:#F5F5F5">
                    <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-circle">Alterar unidade</button>
                </div>
            </form>
        </div>
    </div>
</div>