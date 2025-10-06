<?php  
/**
 * Conecta com o MySQL usando PDO
 */
function db_connect()
{
    $PDO = new PDO('mysql:host=' . CELKE_DB_HOST . ';dbname=' . CELKE_DB_NAME . ';charset=utf8', CELKE_DB_USER, CELKE_DB_PASS);
    $PDO->exec("set names utf8");
    return $PDO;
}
