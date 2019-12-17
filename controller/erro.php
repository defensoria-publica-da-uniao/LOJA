<?php
require_once 'controller.php';
class Erro extends controller{
    
   function inicio(){
       // return '<p align="center">Desculpe, página não encontrada.</p>';
    ?>
       
    
<?php
   }
   function acessoNegado($mensagem,$pagina){
        return "<script language=javascript> alert('" . $mensagem . "');</script>;
              <script language=javascript>self.location.href='$pagina';</script>";
   }
    
}

$oErro = new Erro();
$classe = 'Erro';
$oBjeto = $oErro;
@include_once '../application/request.php';

?>