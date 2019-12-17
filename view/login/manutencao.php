<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 

        <title> FRAME - Menu Vertical </title>
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
        <script src="jquery.countdown.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -- >
        <script src="<?php echo JS; ?>page-level-scripts/login-4.js" type="text/javascript"></script>               <!-- Pag. login -->
        <?php require_once 'public/js/page-level-scripts/login-4.php'; // VERSÃO ANTIGA ?>
    <!-- END PAGE LEVEL SCRIPTS -->
        
    </head>

    <body class="login" >
        
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
                            <font size="5" color="#FFFFFF">Nome do sistema<br>Nome do sistema</font>
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
                <font size="4" color="#FFFFFF">Nome do sistema Nome do sistema</font>
            </p>
        </div>
        <!-- FIM LOGO -->
        
        <div class="content">
            
            <h3 class="form-title bold" align="center" >Desculpe!</h3>
            <p align="center">Sistema em Manutenção das <span class="bold" style="color:#FF0000;" >15:00</span> às <span class="bold" style="color:#FF0000;" >16:00</span>.
                <br>
                <span class="bold" style="color:#FF6E19;" id="countdown"></span>
            </p>
            
            <div class="thumbnail">
                <img src="<?php echo IMG . "manutencao.jpg"?>" alt="Descrição da imagem" style="width: 100%;">
            </div>

            <div class="create-account">
                <center>
                <p>Informações do Sistema procure o <b>SETOR</b></p>
                <p>+55 (61) 3318-9999 | email@dpu.def.br<p/>
                </center>
            </div>
            
        </div>
        <div class="copyright"> 
            <script language=javascript type="text/javascript">
                now = new Date
                document.write (now.getFullYear() )
            </script> &copy; Coordenação de Sistemas - CSIS | Defensoria Pública da União
        </div>
        
        <script language="javaScript">	
            var end = new Date("08/20/2019 1:30 PM");

            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            //var _day = _hour * 24;
            var timer;

            function showRemaining() {
            var now = new Date();
            var distance = end - now;
            if (distance < 0) {

            clearInterval(timer);
            document.getElementById("countdown").innerHTML = "Isso pode levar mais que o previsto!";

            return;
            }
            //var days = Math.floor(distance / _day);
            var hours = Math.floor(distance / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);

            //document.getElementById("countdown").innerHTML = days + " dias - ";
            document.getElementById("countdown").innerHTML = hours + ":";
            document.getElementById("countdown").innerHTML += minutes + ":";
            document.getElementById("countdown").innerHTML += seconds + "";
            }

            timer = setInterval(showRemaining, 1000);
        </script>
        
    </body>
    
</html>

