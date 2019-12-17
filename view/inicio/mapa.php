<?php
    $oInicio->mapa();
?>

    <!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
    <h1 class="page-title">
        Mapa <small>Subtitulo ou descrição</small>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo RAIZ . "inicio/inicio"; ?>">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Mapa</span>
                <i class="fa fa-angle-right"></i>
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
            
            <div class="portlet light ">
                
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Mapa</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">

                    <div class="btn btn-group">
                        <select class="form-control"  id="filtro_grafico" name="filtro_grafico" aling="right" >
                            <option value="">Filtrar Gráfico</option>
                            <option value="Ativos">Gráfico Ativos</option>
                            <option value="Materias">Gráfico Disciplinas</option>
                        </select>
                    </div>
                    <div id="Ativos">  <div id="chartdiv"></div> </div>

                </div>                
            </div>
        </div>
    </div>

