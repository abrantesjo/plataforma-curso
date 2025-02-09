<?php 
ob_start();
putenv("TZ=America/Sao_Paulo");
header('Content-type: text/html; charset=utf-8');

ini_set('memory_limit', '256M');
@ini_set('display_errors', 'off');
error_reporting(E_ERROR | E_PARSE);

define('TITULO_SITE', 'Plataforma de Cursos Online');

require_once("functions.php");

?>