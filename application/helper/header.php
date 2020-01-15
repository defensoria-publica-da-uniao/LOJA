<!-- BEGIN HEADER INNER -->
<div class="page-header-inner">
    
    <div class="page-logo">
            <img src="<?php echo IMG; ?>logo_dpu_branco.png" alt="Logo DPU" class="logo-default">
        <div class="menu-toggler sidebar-toggler">
        </div>
    </div>
    
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
    
    <div class="page-actions">
        <span style="font-size: 22px;"> Loja Virtual</span>
    </div>
    
    <div class="page-top">
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                
                <?php if (@$_SESSION['VALID'] and ( $modulo != 'login' )) { ?>
                
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="Perfil" class="img-circle" src="<?php echo IMG; ?>no-user-2.jpg">
                        <span class="username username-hide-on-mobile"> <?php  echo '<b>'. $_SESSION['LOGIN']['str_perfil'].'</b> '.$_SESSION['LOGIN']['str_nome']; ?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?php echo RAIZ . "materiais/minhasSolicitacoesMateriais"?>">
                                <i class="icon-book-open"></i> Materias Solicitados
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo RAIZ . "servico/minhasSolicitacoesServicos"?>">
                                <i class="icon-earphones-alt"></i> Serviços Solicitados
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo RAIZ . "usuario/editarUsuario"?>">
                                <i class="icon-settings"></i> Editar dados perfil
                            </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="<?php echo RAIZ . "inicio/manual"?>">
                                <i class="icon-book-open"></i> Manual do Sistema
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                    <a href="<?php echo CONTROLLER . 'login.php?acao=sair'; ?>" class="dropdown-toggle" >
                        <i class="icon-logout"></i>
                    </a>
                    <ul class="dropdown-menuss">
                    </ul>
                </li>
                
                <?php } else { ?>
                    
                <li class="dropdown dropdown-user">
                    <a href="<?php echo RAIZ . "login/inicio" ?>" class="dropdown-toggle" >
                        <i class="icon-login"></i> <span class="username username-hide-on-mobile"> Login &nbsp;&nbsp;&nbsp;</span>
                    </a>
                </li>

                <?php } ?>
                
            </ul>
        </div>
    </div>
</div>
<!-- END HEADER INNER -->