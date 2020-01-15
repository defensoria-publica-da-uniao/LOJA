<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 

        <title> Loja Virtual </title>
        <meta name="description" content="Descrição do Sistema"/>
        <meta name="author" content="Coordenação de Sistemas - STI"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?php echo CSS; ?>global-mandatory/font-awesome.css" rel="stylesheet" type="text/css" />                <!-- Icones -->
        <link href="<?php echo CSS; ?>global-mandatory/simple-line-icons.css" rel="stylesheet" type="text/css" />           <!-- Icones -->
        <link href="<?php echo CSS; ?>global-mandatory/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CSS; ?>global-mandatory/bootstrap-switch.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
        
    <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo CSS; ?>page-level-plugins/select2.css" rel="stylesheet" type="text/css" />               <!-- Pag. login -->
        <link href="<?php echo CSS; ?>page-level-plugins/select2-bootstrap.css" rel="stylesheet" type="text/css" />     <!-- Pag. login -->
    <!-- END PAGE LEVEL PLUGINS -->
    
    <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo CSS; ?>theme-global/components-rounded.css" rel="stylesheet" id="style_components" type="text/css" />    <!-- components.css: Border-radius: 0px  -->
        <link href="<?php echo CSS; ?>theme-global/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
        
    <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo CSS; ?>page-level-styles/login-4.css" rel="stylesheet" type="text/css" />                 <!-- Pag. login -->
    <!-- END PAGE LEVEL STYLES -->
    
        <link rel="shortcut icon" href="<?php echo CSS; ?>img/favicon.ico" />
        
        

    <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo JS; ?>core-plugins/jquery.js" type="text/javascript"></script>
        <script src="<?php echo JS; ?>core-plugins/bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo JS; ?>core-plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo JS; ?>core-plugins/jquery.slimscroll.js" type="text/javascript"></script>
        <script src="<?php echo JS; ?>core-plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo JS; ?>core-plugins/bootstrap-switch.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo JS; ?>page-level-plugins/jquery.validate.js" type="text/javascript"></script>       <!-- Pag. login -->
        <script src="<?php echo JS; ?>page-level-plugins/additional-methods.js" type="text/javascript"></script>    <!-- Pag. login -->
        <script src="<?php echo JS; ?>page-level-plugins/select2.full.js" type="text/javascript"></script>          <!-- Pag. login -->
        <script src="<?php echo JS; ?>page-level-plugins/jquery.backstretch.js" type="text/javascript"></script>    <!-- Pag. login -->
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo JS; ?>theme-global/app.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -- >
        <script src="<?php echo JS; ?>page-level-scripts/login-4.js" type="text/javascript"></script>               <!-- Pag. login -->
        <?php require_once 'public/js/page-level-scripts/login-4.php'; // VERSÃO ANTIGA ?>
    <!-- END PAGE LEVEL SCRIPTS -->

    </head>

    <body class="login">
        
        <!-- LOGO -->
        <div class="clearfix visible-md-block visible-lg-block">
            <div class="logo">
                <center>
                    <table>
                        <tr>
                          <td>
                            <img src="<?php echo IMG; ?>logo/logo-branco.png" height="100" alt="Defensoria Pública da União" >
                          </td>
                          <td>
                            <font size="5" color="#FFFFFF">Loja Virtual</font>
                          </td>
                        </tr>
                    </table>
                </center>
            </div>
        </div>
        <div class="clearfix visible-xs-block visible-sm-block">
            <p align="center">
                <img src="<?php echo IMG; ?>logo/logo-branco.png" height="100" alt=""> 
                <br/><br/>
                <font size="4" color="#FFFFFF">Loja Virtual</font>
            </p>
        </div>
        <!-- FIM LOGO -->
        
        <div class="content">
            
            <form class="login-form" role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'login.php' ?>">
                <input type="hidden" name="arrDadosForm[method]" value="acessar">
                
                <h3 class="form-title" align="center">Acesso ao Sistema</h3>
                
                <?php require HELPER . "mensagem.php"; ?>
                
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Nome do Usuário</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="user" autocomplete="on" placeholder="Nome do Usuário" name="arrDadosForm[str_login]" id="usuario" required/> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Senha</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Senha" name="arrDadosForm[str_senha]" id="senha" required/> 
                    </div>
                </div>
                <div class="form-actions">
                    <label class="rememberme mt-checkbox mt-checkbox-outline">
                    </label>
                    <button type="submit" class="btn green pull-right"> Acessar </button>
                </div>
                
                <div class="create-account">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <a href="<?php echo RAIZ.'materiais/materiais';?>" class="btn green pull-right"> Materias e Serviços </a></p>
                        </div>
                    </div>
                    <center>
                    <p>Informações do Sistema procure a Assessoria de Comunicação - ASCOM</p>
                    <p>+55 (61) 3318-9999 | ascom@dpu.def.br<p/>
                    </center> 
                </div>
            </form> 
            
        </div>
        <div class="copyright"> 
            <script language=javascript type="text/javascript">
                now = new Date
                document.write (now.getFullYear() )
            </script> &copy; Coordenação de Sistemas - CSIS | Defensoria Pública da União
        </div>
        
    </body>
    
</html>