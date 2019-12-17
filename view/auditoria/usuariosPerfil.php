    <!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
    <h1 class="page-title">
        Usuários e Perfil <small>Ações realizadas por usuários na área administrativa do <b>Controle de Usuários</b> e <b>Perfil</b></small>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-settings"></i>
                <span>Administrador</span>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Auditoria</span>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <i class="icon-eye"></i>
                <a href="<?php echo RAIZ . "auditoria/usuariosPerfil"; ?>">Usuários e Perfil</a>
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
            
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">Registros</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body"> 

                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                        <thead>
                            <tr>
                                <!-- class:[ all ]-> "Coluna visivél quando for TELEFONE e DESKTOP -->
                                <!-- class:[ min-phone-l ]-> "Coluna visivél quando for TELEFONE -->
                                <!-- class:[ min-tablet ]-> "Coluna visivél quando for TABLET -->
                                <!-- class:[ desktop ]-> "Coluna visivél quando for DESKTOP -->
                                <th class="text-center all">Data e Hora</th>
                                <th class="text-center min-phone-l">Usuário</th>
                                <th class="text-center min-tablet">Ação Realizada</th>
                            </tr>
                        </thead>
                        <tbody>
       
                            <tr>
                                <td class="text-center">$data_hora</td>
                                <td class="text-center">str_usr_criador</td>
                                <td class="text-center">str_descricao</td>
                            </tr>
                            <tr>
                                <td class="text-center">$data_hora</td>
                                <td class="text-center">str_usr_criador</td>
                                <td class="text-center">str_descricao</td>
                            </tr>
                            <tr>
                                <td class="text-center">$data_hora</td>
                                <td class="text-center">str_usr_criador</td>
                                <td class="text-center">str_descricao</td>
                            </tr>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
            
        </div>
    </div>

