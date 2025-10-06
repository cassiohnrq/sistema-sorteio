<?php
include "config/conexao.php";

// pega os dados da tabela
$sql = "SELECT * FROM configuracoes ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$config = $result->fetch_assoc();

// Corrige caminhos que começam com ../uploads/
function corrigirCaminho($caminho) {
    return str_replace("../", "", $caminho);
}

$bg_mobile = corrigirCaminho($config['bg_mobile']);
$bg_pc     = corrigirCaminho($config['bg_pc']);
$logo      = isset($config['logo']) ? corrigirCaminho($config['logo']) : "";

$consultaHtml = "";

// Processa a consulta se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cpf']) && $_GET['cpf'] != "") {
    $cpf = $conn->real_escape_string($_GET['cpf']); 
    $sqlConsulta = "SELECT * FROM cupons_sorteio WHERE cpf = '$cpf'";
    $res = $conn->query($sqlConsulta);

    if ($res->num_rows == 0) {
        $consultaHtml = "<div id='dvContainer' style='position:relative;margin: 20px auto;color:white;font-size:120%;max-width: 600px;'>
            NÃO FOI LOCALIZADO NENHUM CUPOM<br>
            PARA ESTE CPF ou CNPJ,<br>
            CONFIRME SE O NÚMERO ESTA CORRETO E <br>TENTE NOVAMENTE.
            <br>
            <a href='index.php' style='display:inline-block;margin-top:10px;padding:10px 20px;background:#3b82f6;color:white;text-decoration:none;border-radius:6px;'>NOVA CONSULTA</a>
        </div>";
    } else {
        $total = $res->num_rows;
        $cupon = ($total == 1) ? "cupom" : "cupons";
        $nome = $res->fetch_object()->nome;

        $consultaHtml = "
        <div id='dvContainer' style='position:relative;margin: 20px auto;color:white;font-size:120%;max-width: 600px;'>
            <div style='background:rgba(0,0,0,0.4);padding:15px;border-radius:10px;'>
                $cupon concorrendo:<br><br>
                CPF/CNPJ: $cpf <br>
                NOME: $nome <br>
                Você tem: <strong>$total $cupon</strong> <br>
            </div>
            <a href='index.php' style='display:inline-block;margin-top:10px;padding:10px 20px;background:#3b82f6;color:white;text-decoration:none;border-radius:6px;'>NOVA CONSULTA</a>
        </div>";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta name="description" content="">
    <meta name="author" content="Cassio Henrique">
    <link rel="icon" href="imagens/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $config['titulo'] ?></title>	
	<link href="assets/css/home.css" rel="stylesheet">
	<script src="assets/js/formatacpf.js"></script>
	<style>  
		body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-image: url("<?= $bg_pc ?>");
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
        }
        @media (max-width: 768px) {
            body {
                background-image: url("<?= $bg_mobile ?>");
            }
        }
	</style>
</head>

        

<body>

    <div class="container">
		<?php if ($logo): ?>
            <img src="<?= $logo ?>" alt="Logo" class="logo">
        <?php endif; ?>
        <h1><?= $config['titulo'] ?></h1>
        <pre><?= $config['paragrafo'] ?></pre>

        <!-- Formulário de pesquisa -->
		<form method="GET" onsubmit="return validateForm()" name="cpfForm">
            <input type="text" name="cpf" id="cpf" placeholder="CPF ou CNPJ" pattern="[0-9.-]+$" size="18" maxlength="18" onkeypress="mascaraMutuario(this,cpfCnpj)" onblur="clearTimeout()" required> <br><br><br>
            <button type="submit">Consultar cupons</button>
			<a href='https://alternativaprovedor.com.br'><button type="submit">Página inicial</button></a>

        <!-- Resultado da consulta -->
        <?= $consultaHtml ?>
		</form>
    </div>
	
    <footer>
          &copy; <script>document.write(new Date().getFullYear())</script> Alternativa. Todos os direitos reservados.<br>
								Criado por: <a href="https://wa.me/5575999061165" target="_blank">Cassio Henrique</a>
    </footer>
</body>
</html>
