<!-- MODAL | id=cadastrar -->
<div class="modal fade bs-modal-lg" id="cadastrarRegistro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>Cadastrar Novo Material</b></h4>
            </div>

            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'materiais.php' ?>" enctype="multipart/form-data">
                <input type="hidden" name="arrDadosForm[tabela]" value="tb_material" />
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
                                                <label style="text-align:left !important;" >Escolha o nome do material:<span class="required" aria-required="true">*</span></label>
                                                <input class="form-control spinner" maxlength="100" name="arrDadosForm[str_material]" type="text" required > 
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-12">
                                                <label style="text-align:left !important;" >Escolha a descrição do material:<span class="required" aria-required="true">*</span></label>
                                                <textarea  class="form-control spinner" rows="5" maxlength="1000" name="arrDadosForm[str_descricao]" required></textarea>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-6">
                                                <label style="text-align:left !important;" >Escolha a categoria:<span class="required" aria-required="true">*</span></label>
                                                <select  class="form-control" id="select2" name="arrDadosForm[id_categoria]" required>
                                                    <option value=""></option>
                                                    <?php echo $oMateriais->listarCategorias(); ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label" >Escolha o número em estoque:<span class="required" aria-required="true">*</span></label>
                                                <input id="touchspin_6" name="arrDadosForm[int_qtd_estoque]" type="text" value="" required>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-12">
                                                <label style="text-align:left !important;" >Escolha as imagens:</label>
                                                <input type="file" name="arquivo[]" multiple="multiple" required> 
                                            </div>
                                            <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">                                                               
                                                  
                                                    <p style="color: red">
                                                        <b>Atenção</b>: Apenas imagens com limites de 10mb por unidade. <br> 
                                                        <b>Atenção</b>: Dimenções da imagem 667 x 500. <br>
                                                        <b>Atenção</b>: A Primeira imagem selecionada será a foto principal(tumblr). <br>
                                                        <b>Atenção</b>: Formatos permitidos: *.jpg / *.jpeg / *.gif / *.png
                                                    </p>
                                                    
                                                </div>
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
                    <button type="submit" class="btn btn-primary btn-circle" data-toggle="confirmation" data-original-title="Cadastrar?">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIM MODAL | id=cadastrar -->
