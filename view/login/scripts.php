<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title> Loja Virtual </title>
<meta name="description" content="Descrição do Sistema"/>
<meta name="author" content="Coordenação de Sistemas - STI"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="<?php echo CSS; ?>global-mandatory/font-awesome.css" rel="stylesheet" type="text/css" />            <!-- Icones -->
    <link href="<?php echo CSS; ?>global-mandatory/simple-line-icons.css" rel="stylesheet" type="text/css" />       <!-- Icones -->
    <link href="<?php echo CSS; ?>global-mandatory/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo CSS; ?>global-mandatory/bootstrap-switch.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo CSS; ?>page-level-plugins/datatables.min.css" rel="stylesheet" type="text/css" />        <!-- Tabelas -->
    <link href="<?php echo CSS; ?>page-level-plugins/datatables.bootstrap.css" rel="stylesheet" type="text/css" />  <!-- Tabelas -->
    <link href="<?php echo CSS; ?>page-level-plugins/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />   <!-- Perfil de Usuário - Editar dados -->
    <link href="<?php echo CSS; ?>page-level-plugins/bootstrap-select.css" rel="stylesheet" type="text/css" />      <!-- Formulário - Select com campo de pesquisa -->
    <link href="<?php echo CSS; ?>page-level-plugins/jquery.fancybox.css" rel="stylesheet" type="text/css" />       <!-- Amplicar a imagem - Materiais Carrinho -->
    <link href="<?php echo CSS; ?>page-level-plugins/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />   <!-- Quantidade Formulário botões de '+' e '-' - Materiais Carrinho -->
    <link href="<?php echo CSS; ?>page-level-plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" /><!-- Data Picker -->
    <link href="<?php echo CSS; ?>page-level-plugins/bootstrap-daterangepicker/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" /><!-- Data Picker -->
    <link href="<?php echo CSS; ?>page-level-plugins/bootstrap-daterangepicker/bootstrap-timepicker.css" rel="stylesheet" type="text/css" /><!-- Data Picker -->
    <link href="<?php echo CSS; ?>page-level-plugins/bootstrap-daterangepicker/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" /><!-- Data Picker -->
    <link href="<?php echo CSS; ?>page-level-plugins/bootstrap-daterangepicker/clockface.css" rel="stylesheet" type="text/css" /><!-- Data Picker -->
    <link href="<?php echo CSS; ?>page-level-plugins/cubeportfolio.css" rel="stylesheet" type="text/css" />         <!-- Galeria de Fotos - Portfólio -->
    <link href="<?php echo CSS; ?>page-level-plugins/select2.css" rel="stylesheet" type="text/css" />               <!-- Formulário - Serviços -->
    <link href="<?php echo CSS; ?>page-level-plugins/select2-bootstrap.css" rel="stylesheet" type="text/css" />     <!-- Formulário - Serviços -->
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo CSS; ?>theme-global/components-rounded.css" rel="stylesheet" id="style_components" type="text/css" />    <!-- components.css: Border-radius: 0px  -->
    <link href="<?php echo CSS; ?>theme-global/plugins.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo CSS; ?>page-level-styles/error.css" rel="stylesheet" type="text/css" />                  <!-- Página de Erro -->
    <link href="<?php echo CSS; ?>page-level-styles/profile.css" rel="stylesheet" type="text/css" />                <!-- Perfil de Usuário - Editar dados -->
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?php echo CSS; ?>theme-layout/layout.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo CSS; ?>theme-layout/grey.css" rel="stylesheet" type="text/css" id="style_color" />       <!-- Cores do template: blue.css, light.css, grey.css, dark.css  -->
    <link href="<?php echo CSS; ?>theme-layout/customizar.css" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES --> 

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
    <script src="<?php echo JS; ?>page-level-plugins/jquery.validate.js" type="text/javascript"></script>               <!-- Pag. login | Jquery - [Editar, Pesquisar Estagiário...] -->
    <script src="<?php echo JS; ?>page-level-plugins/datatable.js" type="text/javascript"></script>                     <!-- Tabelas -->
    <script src="<?php echo JS; ?>page-level-plugins/datatables.js" type="text/javascript"></script>                    <!-- Tabelas -->
    <script src="<?php echo JS; ?>page-level-plugins/datatables.bootstrap.js" type="text/javascript"></script>          <!-- Tabelas -->
    <script src="<?php echo JS; ?>page-level-plugins/bootstrap-confirmation.js" type="text/javascript"></script>        <!-- Botão de Confirmação -->
    <script src="<?php echo JS; ?>page-level-plugins/jquery.pulsate.js" type="text/javascript"></script>                <!-- Pulsante -->
    <!-- OBS: Pulsante-> Em cada página que queira chamar deve colocar o código ( UIGeneral.init(); ) dentro do ( $(document).ready(function () ) -->
    <script src="<?php echo JS; ?>page-level-plugins/bootstrap-select.js" type="text/javascript"></script>              <!-- Formulário - Select com campo de pesquisa -->
    <script src="<?php echo JS; ?>page-level-plugins/jquery.fancybox.pack.js" type="text/javascript"></script>          <!-- Amplicar a imagem - Materiais Carrinho -->
    <script src="<?php echo JS; ?>page-level-plugins/bootstrap.touchspin.js" type="text/javascript"></script>           <!-- Quantidade Formulário botões de '+' e '-' - Materiais Carrinho -->
    <script src="<?php echo JS; ?>page-level-plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script><!-- Data Picker -->
    <script src="<?php echo JS; ?>page-level-plugins/bootstrap-daterangepicker/bootstrap-datepicker.js" type="text/javascript"></script><!-- Data Picker -->
    <script src="<?php echo JS; ?>page-level-plugins/bootstrap-daterangepicker/bootstrap-timepicker.js" type="text/javascript"></script><!-- Data Picker -->
    <script src="<?php echo JS; ?>page-level-plugins/bootstrap-daterangepicker/bootstrap-datetimepicker.js" type="text/javascript"></script><!-- Data Picker -->
    <script src="<?php echo JS; ?>page-level-plugins/select2.full.js" type="text/javascript"></script>                  <!-- Formulário - Serviços -->
    <script src="<?php echo JS; ?>page-level-plugins/jquery.validate.js" type="text/javascript"></script>               <!-- Formulário - Serviços -->
    <script src="<?php echo JS; ?>page-level-plugins/additional-methods.js" type="text/javascript"></script>            <!-- Formulário - Serviços -->
    <script src="<?php echo JS; ?>page-level-plugins/jquery.bootstrap.wizard.js" type="text/javascript"></script>       <!-- Formulário - Serviços -->
    <script src="<?php echo JS; ?>page-level-plugins/bootstrap-fileinput.js" type="text/javascript"></script>           <!-- Upload de Imagens - Serviços --> 
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo JS; ?>theme-global/app.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS --> 

<!-- BEGIN PAGE LEVEL SCRIPTS --> 
    <script src="<?php echo JS; ?>page-level-scripts/table-datatables-responsive.js" type="text/javascript"></script>   <!-- Tabelas -->
    <script src="<?php echo JS; ?>page-level-scripts/ui-confirmations.js" type="text/javascript"></script>              <!-- Botão de Confirmação -->
    <script src="<?php echo JS; ?>page-level-scripts/ui-general.js" type="text/javascript"></script>                    <!-- Pulsante -->
    <!-- OBS: Pulsante-> Em cada página que queira chamar deve colocar o código ( UIGeneral.init(); ) dentro do ( $(document).ready(function () ) -->
    <script src="<?php echo JS; ?>page-level-scripts/components-bootstrap-select.js" type="text/javascript"></script>   <!-- Formulário - Select com campo de pesquisa -->
    <script src="<?php echo JS; ?>page-level-scripts/components-bootstrap-touchspin.js" type="text/javascript"></script><!-- Quantidade Formulário botões de '+' e '-' - Materiais Carrinho -->
    <script src="<?php echo JS; ?>page-level-scripts/components-date-time-pickers.js" type="text/javascript"></script>  <!-- Data Picker -->
    <script src="<?php echo JS; ?>page-level-scripts/form-wizard.js" type="text/javascript"></script>                   <!-- Formulário - Serviços -->
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="<?php echo JS; ?>theme-layout/layout.js" type="text/javascript"></script>
    <script src="<?php echo JS; ?>theme-layout/demo.js" type="text/javascript"></script>
    <script src="<?php echo JS; ?>theme-layout/quick-sidebar.js" type="text/javascript"></script>
    <script src="<?php echo JS; ?>theme-layout/quick-nav.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->




<!-- OUTROS JS e CSS | FORA DO AMBIENTE METRONIC -->
    <!-- GRAFICOS -->
    <link href="<?php echo PUBLICO; ?>graficos/estilografico.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo PUBLICO; ?>graficos/ammap.js "></script>
    <script src="<?php echo PUBLICO; ?>graficos/pie.js "></script>
    <script src="<?php echo PUBLICO; ?>graficos/brazilLow.js "></script>
    <!-- FIM GRAFICOS -->
<!-- FIM OUTROS JS e CSS | FORA DO AMBIENTE METRONIC -->

    <script>
    /**     
     * Função para aplicar máscara em campos de texto     
     * Copyright (c) 2008, Dirceu Bimonti Ivo - http://www.bimonti.net     
     * All rights reserved.     
     * @constructor     
     */

    /* Version 0.27 */

    /**     
     * Função Principal     
     * @param w - O elemento que será aplicado (normalmente this).     
     * @param e - O evento para capturar a tecla e cancelar o backspace.     
     * @param m - A máscara a ser aplicada.     
     * @param r - Se a máscara deve ser aplicada da direita para a esquerda. Veja Exemplos.     
     * @param a -     
     * @returns null     
     */

    function maskIt(w, e, m, r, a) {
    // Cancela se o evento for Backspace
        if (!e)
            var e = window.event
        if (e.keyCode)
            code = e.keyCode;
        else if (e.which)
            code = e.which;

    // Variáveis da função
        var txt = (!r) ? w.value.replace(/[^\d]+/gi, '') : w.value.replace(/[^\d]+/gi, '').reverse();
        var mask = (!r) ? m : m.reverse();
        var pre = (a) ? a.pre : "";
        var pos = (a) ? a.pos : "";
        var ret = "";

        if (code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g, '').length)
            return false;

    // Loop na máscara para aplicar os caracteres
        for (var x = 0, y = 0, z = mask.length; x < z && y < txt.length; ) {
            if (mask.charAt(x) != '#') {
                ret += mask.charAt(x);
                x++;
            } else {
                ret += txt.charAt(y);
                y++;
                x++;
            }
        }

    // Retorno da função
        ret = (!r) ? ret : ret.reverse()
        w.value = pre + ret + pos;
    }

    // Novo método para o objeto 'String'
    String.prototype.reverse = function () {
        return this.split('').reverse().join('');
    };
</script>