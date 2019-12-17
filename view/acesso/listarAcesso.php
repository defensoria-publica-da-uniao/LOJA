<?php 
    $result = $oAcesso->listaDados('gr_perfil', null, 'str_perfil'); 
    $ar = mssql_fetch_row($result);
    
    $resultPermissao = $oAcesso->listaPermissoes(); 
    $cont = 0;
    $arPer = array();
    while ($arPermissao = mssql_fetch_array($resultPermissao)){
        $arPer['perfil'][] = $arPermissao['id_perfil']; 
        $arPer['view'][] = $arPermissao['id_view'];
        $idElement = $arPermissao['id_perfil'].$arPermissao['id_view'];
        // no javascript foram mesclados id_perfil e id_view para manipulação dos checkbox.
        $arPer['idPerfilIdView'][] = $idElement;
        $arPer[$idElement]['cadastrar'][] = $arPermissao['cadastrar'];
        $arPer[$idElement]['alterar'][] = $arPermissao['alterar'];
        $arPer[$idElement]['visualizar'][] = $arPermissao['visualizar'];
        $arPer[$idElement]['excluir'][] = $arPermissao['excluir'];
       
    }
     
?>
<script>
 $(document).ready( function(){});
 
 function  checkTodos(idP, element){
    
    if ( $('#V'+element).is(':checked') ){ 
      $('.acaoV'+element).prop("checked", true);
      $('#P'+idP).prop("checked", true);
    }else{
      $('.acaoV'+element).prop("checked", false);
      $('#P'+idP).prop("checked", false);
    }
 }
 
 /*verifica se tem alguma ação da view checada para marcar o checkbox da view*/
 function validCkView(ids, idP){
   var id = ids.id; 
   var aChk = $(".acaoV"+id);
   var cont = 0;
   for (var i=0; i<aChk.length; i++){ 
        if (aChk[i].checked == true){ 
            cont++;
        }  
    }
    if (cont == 0){ 
        $('#V'+id).prop("checked", false);
        $('#P'+idP).prop("checked", false);
    }else { 
        $('#V'+id).prop("checked", true);
        $('#P'+idP).prop("checked", true);
    }
}
</script>



    <!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
    <h1 class="page-title">
       Permissões de Acesso <small>Gerenciamento de permissões.</small>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-settings"></i>
                <span>Administrador</span>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <i class="icon-lock-open"></i>
                <a href="<?php echo RAIZ . "acesso/listarAcesso"; ?>">Permissões de Acesso</a>
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
            
            <div class="tab-pane" >
                <div class="portlet box blue-hoki" style="border-radius: 4px;">
                    <div class="portlet-title">
                        <div class="caption">
                            Selecione as Permissões por Perfil </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body form">
                        
                        <!-- FORM -->
                        <form role="form" class="horizontal-form" name="form_acesso" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'acesso.php' ?>">
                            <div class="form-body">
                                
                                <input type="hidden" name="arrDadosForm[tabela]" value="gr_acesso" />
                                <input type="hidden" name="arrDadosForm[method]" value="cadastrar" />
                        
                        
                                <!-- CONTEÚDO ACCORDION-->
                                <div class="panel-group accordion" >

                                    <?php 
                                        $i = 0;
                                        $resultP = $oAcesso->listaDados('gr_perfil', null, 'str_perfil');
                                        while ($arP = mssql_fetch_array($resultP)){ ?>
                                    <?php ((in_array($arP['id_perfil'], $arPer['perfil'])) ? $chkPerfil = 'checked' : $chkPerfil = null); ?>
                                    <input type="hidden" <?php echo $chkPerfil; ?> name="arrDadosForm[id_perfil][]" id="P<?php echo $arP['id_perfil']; ?>" value="<?php echo $arP['id_perfil']; ?>" />
                                    
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_<?php echo $i; ?>">
                                                    <i class="icon-shield"></i> - <?php echo $arP['str_perfil']; ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_2_<?php echo $i; ?>" class="panel-collapse collapse">
                                            <div class="panel-body">

                                                <div class="table-scrollable">
                                                <table class="table table-striped table-hover">
                                                    
                                                    <?php 
                                                        $t = 1;
                                                        $resultM = $oAcesso->listaDados('gr_modulo', null, 'str_modulo');
                                                        while ($arM = mssql_fetch_array($resultM)){
                                                    ?>
                                                    <thead>
                                                        <tr class="danger">
                                                            <th class="all" colspan="5"><i class="icon-grid"></i> - Módulo ( <span style="color:red;"><?php echo $arM['str_modulo']; ?></span> ) </th>
                                                        </tr>
                                                    </thead>
                                                        <?php 
                                                            $v = 1;
                                                            $resultV = $oAcesso->listaViewPorModulo($arM['id_modulo']);
                                                            while ($arV = mssql_fetch_array($resultV)){
                                                        ?>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <?php $idElement = $arP['id_perfil'].$arV['id_view']; ?>
                                                                <?php ((in_array($idElement, $arPer['idPerfilIdView'])) ? $chkView = 'checked' : $chkView = null); ?>
                                                                <input <?php echo $chkView; ?> type="checkbox" name="arrDadosForm[<?php echo $i; ?>][id_view][]" onclick="checkTodos(<?php echo $arP['id_perfil']; ?>, <?php echo $idElement; ?>)" id="V<?php echo $idElement; ?>" value="<?php echo $arV['id_view']; ?>" />
                                                                <?php echo 'Página, ' . $arV['str_view']; ?>
                                                            </td>
                                                            <?php @(($arPer[$idElement]['cadastrar'][0] == 1) ? $chkC = 'checked' : $chkC = null); ?>
                                                            <td>
                                                                <input <?php echo $chkC; ?> type="checkbox" name="arrDadosForm[<?php echo $i; ?>][cadastrar][<?php echo $arV['id_view']; ?>]" id="<?php echo $idElement; ?>" onclick="validCkView(this, <?php echo $arP['id_perfil']?>);" class="acaoV<?php echo $idElement; ?>" value="S"> Cadastrar
                                                            </td>
                                                            <?php @(($arPer[$idElement]['alterar'][0] == 1) ? $chkA = 'checked' : $chkA = null); ?>
                                                            <td>
                                                                <input <?php echo $chkA; ?>  type="checkbox" name="arrDadosForm[<?php echo $i; ?>][alterar][<?php echo $arV['id_view']; ?>]" id="<?php echo $idElement; ?>" onclick="validCkView(this, <?php echo $arP['id_perfil']?>);" class="acaoV<?php echo $idElement; ?>" value="S"> Alterar 
                                                            </td>
                                                            <?php @(($arPer[$idElement]['excluir'][0] == 1) ? $chkE = 'checked' : $chkE = null); ?>
                                                            <td>
                                                                <input <?php echo $chkE; ?>  type="checkbox" name="arrDadosForm[<?php echo $i; ?>][excluir][<?php echo $arV['id_view']; ?>]" id="<?php echo $idElement; ?>" onclick="validCkView(this, <?php echo $arP['id_perfil']?>);" class="acaoV<?php echo $idElement; ?>" value="S"> Excluir 
                                                            </td>
                                                            <?php @(($arPer[$idElement]['visualizar'][0] == 1) ? $chkV = 'checked' : $chkV = null); ?>
                                                            <td>
                                                                <input <?php echo $chkV; ?>  type="checkbox" name="arrDadosForm[<?php echo $i; ?>][visualizar][<?php echo $arV['id_view']; ?>]" id="<?php echo $idElement; ?>" onclick="validCkView(this, <?php echo $arP['id_perfil']?>);" class="acaoV<?php echo $idElement; ?>" value="S"> Visualizar 
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    
                                                        <?php $v++; } ?>
                                                    <?php $t++; } ?>
                                                    
                                                </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding-bottom: 7px;"></div>
                                    <?php $i++; } ?>

                                </div>
                            </div>
                        
                            <div class="form-actions right">
                                <button type="submit" class="btn blue-hoki btn-circle">
                                    <i class="fa fa-check"></i> Atualizar permissões do perfil  <?php echo $arP['str_perfil']; ?></button>
                            </div>
                            
                        </form>
                        <!-- FIM FORM -->
                       
                    </div>
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


            
            