<!-- MODAL | id=cadastrar -->
<div class="modal fade bs-modal-lg" id="cadastrarRegistro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>Cadastrar nova Categoria</b></h4>
            </div>
            
            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'categorias.php' ?>">
                <input type="hidden" name="arrDadosForm[tabela]" value="tb_categoria" />
                <input type="hidden" name="arrDadosForm[method]" value="cadastrar" />
                <input type="hidden" name="arrDadosForm[str_status]" value="A" />
                
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title" >Dados gerais</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                <div class="col-md-12">

                                    <div class="form-body">
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-12">
                                                <label style="text-align:left !important;" >Escolha o nome da Categoria:<span class="required" aria-required="true">*</span></label>
                                                <input class="form-control spinner" maxlength="255" name="arrDadosForm[str_categoria]" type="text" placeholder="Categoria" required="" > 
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-12">
                                                <label style="text-align:left !important;" >Escolha a complexidade para o serviços:<span class="required" aria-required="true">*</span></label>
                                                <select  class="form-control spinner"name="arrDadosForm[id_complexidade]" required="">
                                                    <option value=""></option>
                                                    <?php echo $oCategorias->listarComplexidade(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="background:#F5F5F5; border-radius: 0 0 10px 10px;">
                    <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-circle" >Cadastrar</button>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- FIM MODAL | id=cadastrar -->
