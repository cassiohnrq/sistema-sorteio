<?php
  
// constantes com as credenciais de acesso ao banco MySQL
define('CELKE_DB_HOST', 'localhost');
define('CELKE_DB_USER', 'root');
define('CELKE_DB_PASS', 'senha');
define('CELKE_DB_NAME', 'teste');

// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
 
date_default_timezone_set('America/Sao_Paulo');

// inclui o arquivo de funçõees
require_once 'functions.php';