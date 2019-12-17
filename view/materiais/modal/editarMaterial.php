<!-- MODAL | id=editar -->
<div class="modal fade bs-modal-lg" id="editar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>Editar Material</b></h4>
            </div>

            <div class="modal-body">

                <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'materiais.php' ?>" enctype="multipart/form-data">
                    <input type="hidden" name="arrDadosForm[tabela]" value="tb_material" />
                    <input type="hidden" name="arrDadosForm[method]" value="alterar" />    
                    <input type="hidden" id="id" name="arrDadosForm[id]" />
                    <input type="hidden" name="arrDadosForm[campo_where]" value="id_material" />

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
                                                <input class="form-control spinner" maxlength="100" name="arrDadosForm[str_material]" type="text" id="material" required > 
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-12">
                                                <label style="text-align:left !important;" >Escolha a descrição do material:<span class="required" aria-required="true">*</span></label>
                                                <textarea  class="form-control spinner" rows="5" maxlength="1000" id="descricao" name="arrDadosForm[str_descricao]"></textarea>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-6">
                                                <label style="text-align:left !important;" >Escolha a categoria:<span class="required" aria-required="true">*</span></label>
                                                <select  class="form-control select2 id_categoria" name="arrDadosForm[id_categoria]" required="">

                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label" >Escolha o número em estoque:<span class="required" aria-required="true">*</span></label>
                                                <input id="touchspin_6_editar" name="arrDadosForm[int_qtd_estoque]" type="text"  value=""  required>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                            <div class="form-group col-md-12">
                                                <label style="text-align:left !important;" >Escolha as imagens:</label>
                                                <input type="file" name="arquivo[]" multiple="multiple"> 
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
                        <div class="modal-footer" style="background-color: #f5f5f5;" >
                            <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-circle" data-toggle="confirmation" data-original-title="Atualizar Dados?" >Atualizar Dados Gerias</button>
                        </div>
                    </div>
                </form>    

                <hr>

                <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'materiais.php' ?>">
                    <input type="hidden" name="arrDadosForm[method]" value="alteracoesImagens" />    

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title" >Imagens</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                <div class="col-md-12">
                                    <div class='mt-element-card mt-element-overlay'>
                                        <div class='row'>
                                            <div class="fetched-data3">
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="background-color: #f5f5f5;">
                            <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-circle"  data-toggle="confirmation" data-original-title="Fazer Alterações?">Alterar Imagens</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
<!-- FIM MODAL | id=cadastrar -->

<script>
    function desabilitar(obj) {
        var valor_id = obj;
        var total_imagens = document.getElementById('total_imagens').value;
        var i;
        
        for (i = 1; i <= total_imagens; i++) {
            //Imagem selecionada como principal
            if (i == valor_id) {
                 document.getElementById(obj).checked = false;
                document.getElementById(obj).disabled = true;
                var div ='div'+obj;
               document.getElementById(div).className = 'div1';
            }else{    
                //Imagem sem nada ou excluir
                 var div ='div'+i;
                 var classe_atual = document.getElementById(div).className;
                 
                 if(classe_atual=='div1' || classe_atual=='div2' ){
               document.getElementById(div).className = 'div2';
                document.getElementById(i).disabled = false;
                 }
            }
        }
    }
    function excluir(obj) {
        var valor_id = obj;
        var total_imagens = document.getElementById('total_imagens').value;
        var i;

        for (i = 1; i <= total_imagens; i++) {
            //Imagem selecionada para excluir

            if (i == valor_id) {

                var id_div ='div'+obj;
                var classe_atual = document.getElementById(id_div).className;
                
                if(classe_atual=='div3'){
                    document.getElementById(id_div).className = 'div2';
                }else{
               document.getElementById(id_div).className = 'div3';
                }
            }
        }
    }
</script>
