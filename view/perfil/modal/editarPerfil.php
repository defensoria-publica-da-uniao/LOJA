
<div class="modal fade bs-modal-lg" id="editarCadastro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>EDITAR PERFIL</b></h4>
            </div>
            
            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'perfil.php' ?>">
                <div class="modal-body">

                    <div id="resultModal" class="fetched-data">
                        <input type="hidden" name="arrDadosForm[tabela]" value="gr_perfil" />
                        <input type="hidden" id="id" name="arrDadosForm[id]" />
                        <input type="hidden" name="arrDadosForm[method]" value="alterar" />
                        <input type="hidden" name="arrDadosForm[campo_where]" value="id_perfil" />
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">Nome do perfil:<span class="required" aria-required="true">*</span></label>
                                <input type="text" name="arrDadosForm[str_perfil]" maxlength="50" value="" id="perfil" class="form-control spinner" placeholder="Descrição" required> 
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer" style="background:#F5F5F5; border-radius: 0 0 10px 10px;">
                    <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-circle">Alterar cadastro</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
