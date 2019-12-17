<?php
@session_start();
require_once $_SESSION['PATH'] . 'controller/controller.php';

class MCategorias extends controller {
    
     function listaCategoriaCompleto(){
       

       $this->sql = "listaCategoriaCompleto"; 
           
           return $this->query();
        
    }
}