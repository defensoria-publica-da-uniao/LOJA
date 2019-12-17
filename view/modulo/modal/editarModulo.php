
<div class="modal fade bs-modal-lg " id="editarCadastro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="page-title" align="center">
                    <span class="caption-subject font-dark bold uppercase">
                        <div class="m-heading-1 border-blue m-bordered">
                            <h4><b>Editar cadastro de módulo</b>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            </h4>
                        </div>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div id="resultModal" class="fetched-data_dpu">
                    
                    <!-- CONTEUDO -->
                    <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'modulo.php' ?>">
                        <input type="hidden" name="arrDadosForm[tabela]" value="modulo" />
                        <input type="hidden" id="id" name="arrDadosForm[id]" />
                        <input type="hidden" name="arrDadosForm[method]" value="alterar" />

                        <h3 class="form-title">Cadastro de usuário</h3>

                        <div align="center" class="form-group">
                            <label class="control-label visible-ie8 visible-ie9">Módulo</label>
                            <div class="input-icon">
                               <input type="text" name="arrDadosForm[str_modulo]"  value="" id="modulo" class="form-control" placeholder="Módulo"> 
                            </div>
                        </div>


                        
                        <br />
                        <div  class="form-actions" align="center">
                            <button type="submit" class="btn green pull-center"> Alterar cadastro </button>
                        </div>
                        <br />
                        <br />
                        
                    </form>
                    <!-- FIM CONTEUDO -->
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>