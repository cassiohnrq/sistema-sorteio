<?php 
session_start();
if($_SESSION['usuarioNome'] == null){
	header("Location: ../login.php");}
if($_SESSION['usuarioNiveisAcessoId'] != "1"){
	echo 'Você não tem permissão para acessar essa pagina.';
	header("Location: ../config/sair.php");}
	$_SESSION['usuarioNome'];
require_once '../config/init.php';

//Recuperar o id da URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

//Validar o id
if(empty($id)){
	echo "ID não informado";
	exit;
}
//Remover o contato do banco de dados
$PDO = db_connect();
$sql_msg_contatos = "DELETE FROM usuarios WHERE id = :id ";
$delete_msg_contato = $PDO->prepare($sql_msg_contatos);
$delete_msg_contato->bindParam(':id', $id, PDO::PARAM_INT);

if($delete_msg_contato->execute()){
	$_SESSION['sucesso'] = "Sucesso";
	header('Location: ../listar/usuarios_cadastrados.php');
}else{
	$_SESSION['erro'] = "erro";
	header('Location: ../listar/usuarios_cadastrados.php');
}