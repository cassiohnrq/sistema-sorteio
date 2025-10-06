<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "senha";
	$dbname = "teste";
	
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	
	// Aqui está o segredo
    mysqli_set_charset($conn,"utf8"); 
	
	if(!$conn){
		die("Falha na conexao: " . mysqli_connect_error());
	}else{
		//echo "Conexao realizada com sucesso";
	}	
	
?>