<?php
    define('DESKTOP', 'visible-md visible-lg visible-sm hidden-xs');
    define('MOBILE', 'visible-xs hidden-sm hidden-md hidden-lg');
?>
<script>
    function sair(){ 
        $(document).ready(function() {
            $('.openForm').click(function(event) {
                event.preventDefault();
                $form = $('#transport');

                // Extrai os dados dos atributos customizados do link tirando o prefixo "data-"
                var data = extractData(this); 

                // Preenche os dados no form
                for(var attr in data) {
                    $form.find('input[name="' + attr + '"]').val(data[attr]);
                }

                // Atualiza o action do form com o href do link
                $form.attr('action', this.href);

                // Submete o form
                $form.submit();
            });
        });
        <form action="#" method="post" style="display:none" id="transport">
            <input type="hidden" name="method" />
            <input type="hidden" name="cliente" />
        </form>

</script>









<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->

        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-hover-submenu page-sidebar-menu-compact" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            
            <li class="nav-item start ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Home</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "inicio/home"; ?>" class="nav-link ">
                            <span class="title">Página Início</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "inicio/formulario"; ?>" class="nav-link ">
                            <span class="title">Formulário</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "inicio/mapa"; ?>" class="nav-link ">
                            <span class="title">Mapa</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="page_user_login_2.html" class="nav-link "> Página de Erro </a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item start">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-folder"></i>
                    <span class="title">Links 1</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-settings"></i> Item 1
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-user"></i> Arrow Toggle
                                    <span class="arrow nav-toggle"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="icon-power"></i> Sample Link 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="icon-paper-plane"></i> Sample Link 1</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-camera"></i> Sample Link 1</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-bar-chart"></i> Item 3 
                            <span class="badge badge-success">1</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item start">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-folder-alt"></i>
                    <span class="title">Produtos - Materiais</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start">
                        <a href="<?php echo RAIZ . "materiais/materiais"?>" class="nav-link ">
                            <i class="icon-basket-loaded"></i> 
                            <span class="title">Produtos e Serviços</span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="<?php echo RAIZ . "materiais/listarMateriais"?>" class="nav-link ">
                            <i class="icon-layers"></i>
                            <span class="title">Gerenciar Materias</span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="<?php echo RAIZ . "categorias/listarCategorias"?>" class="nav-link ">
                            <i class="icon-share"></i>
                            <span class="title">Gerenciar Categorias</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item start">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-folder-alt"></i>
                    <span class="title">Solicitações</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start">
                        <a href="<?php echo RAIZ . "materiais/solicitacaoMateriais"?>" class="nav-link ">
                            <i class="icon-book-open"></i> 
                            <span class="title">Materiais</span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="<?php echo RAIZ . "servico/solicitacaoServicos"?>" class="nav-link ">
                            <i class="icon-earphones-alt"></i>
                            <span class="title">Serviços</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item start ">
                <a href="<?php echo RAIZ . "materiais/carrinho"?>" class="nav-link nav-toggle">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                    <span class="title">Carrinho</span>
                    <span class="badge badge-danger"><?php echo $oController->checkCarrinho($_SESSION['LOGIN']['id_usuario']);?></span>
                </a>
            </li>
            
            <li class="nav-item start ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Administrador</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "usuario/listarUsuario"; ?>" class="nav-link ">
                            <i class="icon-users"></i>
                            <span class="title">Controle de Usuários</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "perfil/listarPerfil"; ?>" class="nav-link ">
                            <i class="icon-shield"></i>
                            <span class="title">Perfil de Usuário</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "modulo/listarModulo"; ?>" class="nav-link ">
                            <i class="icon-grid"></i>
                            <span class="title">Módulo do Sistema</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "view/listarView"; ?>" class="nav-link ">
                            <i class="icon-screen-desktop"></i>
                            <span class="title">Páginas do Sistema</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "acesso/listarAcesso"; ?>" class="nav-link ">
                            <i class="icon-lock-open"></i>
                            <span class="title">Permissões de Acesso</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            Auditoria
                            <span class="arrow"></span> 
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="<?php echo RAIZ . "auditoria/auditoria-adm"?>" class="nav-link">
                                    <i class="icon-eye"></i> Usuários e Perfil</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo RAIZ . "usuario/auditoria"?>" class="nav-link">
                                    <i class="icon-eye"></i> Histórico Geral</a> 
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            DPU
                            <span class="arrow"></span> 
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="<?php echo RAIZ . "unidade/listarUnidade"?>" class="nav-link">
                                    <i class="icon-size-actual"></i> Unidades</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo RAIZ . "secretaria/listarSecretaria"?>" class="nav-link">
                                    <i class="icon-size-fullscreen"></i> Secretarias</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item start ">
                <a href="<?php echo RAIZ . "inicio/manual"?>" class="nav-link nav-toggle">
                    <i class="icon-book-open"></i>
                    <span class="title">Manual do Sistema</span>
                    <span class="arrow"></span>
                </a>
            </li>
            
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
