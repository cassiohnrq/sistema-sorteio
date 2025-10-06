<?php
	session_start();
	if($_SESSION['usuarioNome'] == null){
	header("Location: ../login.php");}
?>
<?php
// index.php
include "../config/conexao.php";

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['truncate'])) {
    $tabela = "cupons_sorteio"; // troque pelo nome da sua tabela
    $sql = "TRUNCATE TABLE $tabela";

    if ($conn->query($sql) === TRUE) {
        $mensagem = "Tabela <b>$tabela</b> foi esvaziada com sucesso!";
    } else {
        $mensagem = "Erro: " . $conn->error;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	 <meta name="author" content="Cassio Henrique">
    <link rel="icon" href="../imagens/logo.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Sistema Cupons</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
<style>
        
        .box {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            text-align: center;
            width: 350px;
        }
        
        .mensagem {
            margin-top: 15px;
            font-weight: bold;
            color: green;
        }
        button {
            margin-top: 20px;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            background: #e74c3c;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:disabled {
            background: #bbb;
            cursor: not-allowed;
        }
        label {
            display: block;
            margin-top: 15px;
            cursor: pointer;
        }
    </style>
    <script>
        function toggleBotao() {
            const check = document.getElementById("confirmar");
            const botao = document.getElementById("btnTruncate");
            botao.disabled = !check.checked;
        }
    </script>
</head>
<body>

<div class="wrapper">
                   <?php
           if($_SESSION['usuarioNiveisAcessoId'] == "1"){
         	include '../config/menu_administrador.inc';
           }else{
	        include '../config/menu_colaborador.inc';
           }?>  
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
  

         <div class="box">
        <h2>⚠️ Atenção</h2>
        <p>Essa ação vai <b>APAGAR TODOS OS DADOS</b> da tabela.</p>
        
        <form method="POST">
            <label>
                <input type="checkbox" id="confirmar" onclick="toggleBotao()">
                Confirmo que desejo APAGAR os dados da tabela
            </label>
            
            <button type="submit" name="truncate" id="btnTruncate" disabled>
                Limpar Tabela
            </button>
        </form>

        <?php if (!empty($mensagem)) { ?>
            <div class="mensagem"><?= $mensagem ?></div>
        <?php } ?>
    </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
 <?php include '../config/footer.inc'; ?>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="../assets/js/demo.js"></script>

</html>