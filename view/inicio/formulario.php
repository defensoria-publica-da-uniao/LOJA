    <!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
    <h1 class="page-title">
        Formulário <small>Subtitulo ou descrição</small>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo RAIZ . "inicio/inicio"; ?>">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Formulário</span>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Diretório de navegação</span>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <a onclick="window.history.go(-1)" class="btn btn-fit-height grey-salt dropdown-toggle"><i class="fa fa-reply"></i> Voltar </a>
            </div>
        </div>
    </div>
    <!-- FIM TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            
            <!-- ALERTAS -->
            <?php require HELPER . "mensagem.php"; ?>
            <!-- FIM ALERTAS -->
            
            <div class="m-heading-1 border-green m-bordered">
                <p> Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    <br>Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                </p>
            </div>
            
            
            <div class="tab-pane" >
                <div class="portlet box blue-madison" style="border-radius: 4px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file-text-o"></i> - Formulário de Atualização de Dados </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="#" class="horizontal-form">
                            <div class="form-body">
                                <h3 class="form-section">Informação Pessoal</h3>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Nome Completo<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control" >
                                            <span class="help-block"> Dica de preenchimento </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group has-error">
                                            <label class="control-label">Apelido</label>
                                            <input type="text" class="form-control" >
                                            <span class="help-block"> This field has error. </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group has-error">
                                            <label class="control-label">Apelido</label>
                                            <input type="text" class="form-control" >
                                            <span class="help-block"> This field has error. </span>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Gênero<span class="required" aria-required="true">*</span></label>
                                            <select class="form-control">
                                                <option value="">Masculino</option>
                                                <option value="">Feminino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Data de Nascimento<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control" placeholder="dd/mm/yyyy"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Categoria</label>
                                            <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                                <option value="Category 1">Category 1</option>
                                                <option value="Category 2">Category 2</option>
                                                <option value="Category 3">Category 5</option>
                                                <option value="Category 4">Category 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Opção</label>
                                            <div class="radio-list" style="padding: 6px 18px;">
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked> Option 1 
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"> Option 2 
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="form-section">Endereço</h3>
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label>Endereço<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cidade</label>
                                            <input type="text" class="form-control"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>UF</label>
                                            <input type="text" class="form-control"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CEP</label>
                                            <input type="text" class="form-control"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       
                                    </div>
                                </div>
                                <h3 class="form-section">Outros</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Inline Radio</label>
                                            <div class="mt-radio-inline">
                                                <label class="mt-radio">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked> Option 1
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2"> Option 2
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio mt-radio-disabled">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios6" value="option3" disabled> Disabled
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Inline Checkboxes</label>
                                            <div class="mt-checkbox-inline">
                                                <label class="mt-checkbox">
                                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> Checkbox 1
                                                    <span></span>
                                                </label>
                                                <label class="mt-checkbox">
                                                    <input type="checkbox" id="inlineCheckbox2" value="option2"> Checkbox 2
                                                    <span></span>
                                                </label>
                                                <label class="mt-checkbox mt-checkbox-disabled">
                                                    <input type="checkbox" id="inlineCheckbox3" value="option3" disabled> Disabled
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Live Search(Countries)</label>
                                            <div class="col-md-4">
                                                <select class="bs-select form-control" data-live-search="true" data-size="5">
                                                    <option value="AF">Afghanistan</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="DZ">Algeria</option>
                                                    <option value="AS">American Samoa</option>
                                                    <option value="AD">Andorra</option>
                                                    <option value="AO">Angola</option>
                                                    <option value="AI">Anguilla</option>
                                                    <option value="AR">Argentina</option>
                                                    <option value="ZM">Zambia</option>
                                                    <option value="ZW">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <button type="button" class="btn default btn-circle">Cancelar</button>
                                <button type="submit" class="btn blue-madison btn-circle">
                                    <i class="fa fa-check"></i> Salvar</button>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>

            <div class="portlet light ">
                
                <div class="portlet-body">
                    <h4>Pulsate any page elements.</h4>
                    <div class="margin-top-10 margin-bottom-10 clearfix">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td> Repeating Pulsate </td>
                                <td>
                                    <div id="pulsate-regular" style="padding:5px;"> Repeating Pulsate </div>
                                </td>
                            </tr>
                            <tr>
                                <td> Repeating Pulsate </td>
                                <td>
                                    <div id="pulsate-success" style="padding:5px;"> Repeating Pulsate </div>
                                </td>
                            </tr>
                            <tr>
                                <td> Repeating Pulsate </td>
                                <td>
                                    <div id="pulsate-danger" style="padding:5px;"> Repeating Pulsate </div>
                                </td>
                            </tr>
                            <tr>
                                <td> Repeating Pulsate </td>
                                <td>
                                    <div id="pulsate-warning" style="padding:5px;"> Repeating Pulsate </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn green" id="pulsate-once">Pulsate Once</button>
                                </td>
                                <td>
                                    <div id="pulsate-once-target" style="padding:5px;"> Pulsate me </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn red" id="pulsate-crazy">Crazy Pulsate :)</button>
                                </td>
                                <td>
                                    <div id="pulsate-crazy-target" style="padding:5px;"> Pulsate me </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <span class="label label-danger"> NOTE! </span>
                    <span> Pulsate is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 9 and Internet Explorer 10 only. </span>
                </div>

            </div>
            
            
        </div>
    </div>

<script>
    $(document).ready(function () {
        // Pulsante da Mensagem de Sucesso ou Erro
        UIGeneral.init();
    });
</script>