<?php  echo $oErro->inicio(); ?>


    <!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
    <h1 class="page-title">
        Erro <small>Página não encontrada.</small>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo RAIZ . "inicio/inicio"; ?>">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Página não encontrada</span>
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
        <div class="col-md-12 page-500">
            <div class=" number font-red"><i class="fa fa-exclamation-triangle"></i></div>
            <div class=" details">
                <h3 class="font-red">Opa! Algo deu errado.</h3>
                <p> Não conseguimos encontrar a página que você está procurando.
                </p>
                <p>
                    <a href="<?php echo RAIZ . "inicio/home"; ?>" class="btn red btn-outline"> Retorne ao início </a>
                    <br>
                </p>
            </div>
        </div>
    </div>

