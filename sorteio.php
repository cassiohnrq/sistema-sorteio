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
	<link href="assets/css/sorteio.css" rel="stylesheet">
	<script src="assets/js/confete.js"></script>
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
        }</style>
	
</head>

        

<body>

    <div class="container">
		<?php if ($logo): ?>
            <img src="<?= $logo ?>" alt="Logo" class="logo">
        <?php endif; ?>
        <h1><?= $config['titulo'] ?></h1>

        <p id="contador">10</p>
        <button id="iniciarBtn" onclick="iniciarContagem()">Sortear</button>

        
    </div>

 <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <h2><?php
if (!isset($_GET)) { $_GET = &$HTTP_GET_VARS;}
if (!isset($_POST)) { $_POST = &$HTTP_POST_VARS;}
if (!isset($_SESSION)) { $_SESSION = &$HTTP_SESSION_VARS;}
if (!isset($_SERVER)) { $_SERVER = &$HTTP_SERVER_VARS; }
if (!isset($_ENV)) { $_ENV = &$HTTP_ENV_VARS;}
if (!isset($_COOKIE)) { $_COOKIE = &$HTTP_COOKIE_VARS;}
if (!isset($_FILES)) { $_FILES = &$HTTP_POST_FILES;}
if (!isset($_REQUEST)) { $_REQUEST = &$_GET&$_POST&$_COOKIE&$_FILES;}
	
// Agora o script irÃ¡ funcionar como se o
// register globals estive setado como on
	
if (isset($_GET)) { extract($_GET); }
if (isset($_POST)) { extract($_POST); }
if (isset($_SESSION)) { extract($_SESSION); }
if (isset($_SERVER)) { extract($_SERVER); }
if (isset($_ENV)) { extract($_ENV); }
if (isset($_COOKIE)) { extract($_COOKIE); }
if (isset($_FILES)) { extract($_FILES); }
	
//Open a new connection to the MySQL server, server, user, senha, db
$mysqli = new mysqli('localhost','root','senha','teste');
	
//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
	
// Change character set to utf8
mysqli_set_charset($mysqli,"utf8");
	
	
//consulta
//$sql = "SELECT id, nome, cpf from 20anos where cpf = '$cpf'";
	
//chained PHP functions
$id_contrato = $mysqli->query("SELECT * FROM cupons_sorteio ORDER BY RAND () LIMIT 1")->fetch_object()->id_contrato;	
$nome = $mysqli->query("SELECT * FROM cupons_sorteio where id_contrato = '$id_contrato'")->fetch_object()->nome; 

	
//Selecionando só o 1º nome
$primeiroNome = explode(" ", $nome);
	// Imprimindo
	echo" <div id=\"dvContainer\">
 <div style='margin-left:10%; margin-right:10%; align:center; color:#ffffff;'> Alternativa Provedor <br>
O ganhador do <strong>sorteio</strong> foi...<br><br><br>
Contrato:<strong>  $id_contrato </strong> <br>
Nome: <strong> $primeiroNome[0]</strong> <br><br>
</div>
<div style='font-size:0.7em; margin-left:10%; margin-right:10%; align:center; color:#ffffff;'>
<br>Para conferir se o seu contrato foi o selecionado, entre no APP Alternativa Provedor<br>
ou por nossa central de atendimento no<br> 0800 075 1415
<br>
</div>
<br>
</div>";

// close connection 
$mysqli->close();
		
?></h2>

            <button onclick="reiniciarComRecarregamento()">Fazer novo sorteio</button>
        </div>
    </div>

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
