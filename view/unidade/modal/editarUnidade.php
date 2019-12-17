
<div class="modal fade bs-modal-lg " id="editarCadastro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>EDITAR UNIDADE</b></h4>
            </div>
            
            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'unidade.php' ?>">
                <div class="modal-body">
                    <div id="resultModal" class="fetched-data_dpu">
                        <input type="hidden" name="arrDadosForm[tabela]" value="tb_unidade" />
                        <input type="hidden" id="id" name="arrDadosForm[id]" />
                        <input type="hidden" id="campo_where" name="arrDadosForm[campo_where]" value="id_unidade" />
                        <input type="hidden" name="arrDadosForm[method]" value="alterar" />

                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                            <div class="form-group col-md-6">
                                <label style="text-align:left !important;" >Estado:<span class="required" aria-required="true">*</span></label>
                                <select name="arrDadosForm[id_estado]" id="estado"  class="bs-select form-control" data-live-search="true" data-size="5" required>
                                    <option value=""> Selecione o estado</option>
                                    <?php
                                        $result = $oUnidade->listarEstados();
                                        while ($arEstados = mssql_fetch_array($result)) {
                                            echo "<option value='" . $arEstados['id_estado'] . "'";
                                            //if para adicionar o selected no option
                                            echo ">" . $arEstados['str_uf'] . " - " . utf8_encode($arEstados['str_estado']) . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label style="text-align:left !important;" >Unidade:<span class="required" aria-required="true">*</span></label>
                                <input class="form-control" type="text" name="arrDadosForm[str_descricao]"  value="arrDadosForm[str_descricao]" id="unidade" type="text" placeholder="Unidade"> 
                            </div>
                        </div>
                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                            <div class="form-group col-md-12">
                                <label style="text-align:left !important;" >Email:<span class="required" aria-required="true">*</span></label>
                                <input class="form-control" type="text" name="arrDadosForm[str_email]"  value="arrDadosForm[str_descricao]" id="email" type="text" placeholder="E-mail" required> 
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