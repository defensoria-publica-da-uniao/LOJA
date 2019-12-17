<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    if(isset($_POST['arrDadosForm'])){ //Formulario
        $arrDadosForm = $_POST['arrDadosForm'];
        $method = $arrDadosForm['method'];
        $arrDadosForm = $_POST['arrDadosForm'];  
    } else { //Ajax
        $arrDadosForm = $_POST;  
        $method = $_POST['method'];
    }    
    
    if(method_exists($classe, $method)) {      
        $oBjeto->$method($arrDadosForm);
    } else {
        echo 'Metodo não encontrado';
    }
}

if( $_SERVER['REQUEST_METHOD'] == 'GET'){ //Botao sair do sistema
    if( $_SERVER['REQUEST_METHOD'] == 'GET' && @$_GET['acao']=='sair'){
        $oLogin->sair();
    } 

}

?>