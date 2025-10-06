<?php
	session_start();
	if($_SESSION['usuarioNome'] == null){
	header("Location: ../login.php");}
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
  

         <h1>Importar .CSV</h1>
		
		<form method="POST" action="../importar/processa.php" enctype="multipart/form-data">
			<label>Arquivo.csv</label>
			<input type="file" name="arquivo"><br><br>
			<input type="submit" value="Enviar" class="btn btn-info btn-fill">
		</form>
		 <h3>Observações</h3>
            <ol>
  <li>Baixe o arquivo modelo.csv - <a href="modelo.csv" download>Download</a>;</li>
  <li>Não altere o nome das colunas;</li>
  <li>Preencha as colunas com as informações a serem acrescentadas;</li>
  <li>A importação adiciona novas linhas, para editar use a função de editar em cupons cadastrados;</li>
  <li>Ao final da importação sera informado se ela foi bem sucedida e quantas linhas foram importadas, sem contar o cabeçalho;</li>
  <li>Em caso de duvidas contactar a comunicação;</li>
  <li>Não importe dados repetidos!</li>
</ol>  

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