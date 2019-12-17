<?php

@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

/* * *********** CONSTANTES BANCO ********** */
define('B_HOST', '172.28.97.213:1437');
define('B_USUARIO', 'usr_teste');
define('B_SENHA', '123456');
define('B_BANCO', 'Teste_DB');

/* * ******* CONSTANTES CAMADA - VISAO E REDIRECIONAMENTO ******* */
$PROTOCOLO = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') == true) ? 'https' : 'http';
define('PROTOCOLO', $PROTOCOLO);
define('DIR', '/php56/desenvolvimento/loja-ascom-2/');

define('SERVER', $_SERVER['SERVER_NAME']);
define('RAIZ', PROTOCOLO . '://' . SERVER . DIR);

define('CSS', RAIZ . 'public/css/');
define('JS', RAIZ . 'public/js/');
define('IMG', RAIZ . 'public/img/');
define('PUBLICO', RAIZ . 'public/');
define('APPLICATION', RAIZ . 'application/');

define('HELPER', 'application/helper/');
define('CONTROLLER', RAIZ . 'controller/');

$_SESSION['PATH'] = $_SERVER['DOCUMENT_ROOT'] . str_replace(':84', '', DIR);


//Oracle SCDP
define('O_host', '10.0.2.108');
define('O_port', '1521');
define('O_user', 'SCDP');
define('O_password', 'password');
define('O_sid', 'rhdb');
define('O_service_name', 'rhdb.dpu.gov.br');


$oracle_user = O_user;
$oracle_senha = O_password;

putenv("NLS_LANG=AMERICAN_AMERICA.WE8ISO8859P9");
$oracle_bd = '(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = ' . O_host . ')(PORT = ' . O_port . '))(CONNECT_DATA = (SERVER = DEDICATED)(SID = ' . O_sid . ')(SERVICE_NAME = ' . O_service_name . ')))';
//$oracle_conexao = OCILogon($oracle_user, $oracle_senha, $oracle_bd);
$oracle_conexao = oci_connect($oracle_user, $oracle_senha, $oracle_bd);
define('O_conexao', $oracle_conexao);

?>