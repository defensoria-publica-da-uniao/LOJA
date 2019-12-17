
<div class="modal fade bs-modal-lg" id="editarCadastro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>EDITAR CADASTRO DO USUÁRIO</b></h4>
            </div>
            
            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'usuario.php' ?>">
                <div class="modal-body">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title" >Dados gerais</h3>
                        </div>
                        <div class="panel-body">

                            <div id="resultModal" class="fetched-data">
                                <input type="hidden" name="arrDadosForm[tabela]" value="gr_usuario" />
                                <input type="hidden" id="id" name="arrDadosForm[id]" />
                                <input type="hidden" id="campo_where" name="arrDadosForm[campo_where]" value="id_usuario" />
                                <input type="hidden" name="arrDadosForm[method]" value="alterar" />

                                <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                    <div class="form-group col-md-6">
                                        <label style="text-align:left !important;" >Nome:</label>
                                        <input class="form-control" type="text" name=""  value="" id="nome" type="text" placeholder="Nome" disabled> 
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label style="text-align:left !important;" >Login:</label>
                                        <input class="form-control" type="text" name=""  value="" id="login" type="text" placeholder="Login" disabled> 
                                    </div>
                                </div>
                                <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                    <div class="form-group col-md-12">
                                        <label style="text-align:left !important;" >Perfil:</label>
                                        <select name="arrDadosForm[id_perfil]" id="perfil" class="form-control">
                                            <option value=""> Selecione o perfil</option>
                                            <?php
                                                $result = $oUsuario->listarPerfil();
                                                while ($arPerfil = mssql_fetch_array($result)) {
                                                    echo "<option value='" . $arPerfil['id_perfil'] . "'>" . $arPerfil['str_perfil'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
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