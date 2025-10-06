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
<?php
require '../config/init.php';

// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

//Valida a variavel da URL
if (empty($id)){
	echo "ID para alteração não definido";
    exit;
}

$PDO = db_connect();
$sql_msg_evento = "SELECT * FROM cupons_sorteio WHERE id='$id'";
$result_msg_evento = $PDO->prepare($sql_msg_evento);
$result_msg_evento->bindParam(':id', $id, PDO::PARAM_INT);

$result_msg_evento->execute();

$resultado_msg_evento = $result_msg_evento->fetch(PDO::FETCH_ASSOC);
				
//DATA E HORA
date_default_timezone_set("America/Sao_paulo");
$DATA = date("d/m/y - H:i",time());

if(!is_array($resultado_msg_evento)){
	echo "Nunhum cupom encontrado";
    exit;	
}
?>
		<h1>Editar Cupons</h1>
		<form action="../edit/editar_msg_cupom.php" method="POST">
			<label for="data">Data do pagamento: </label>
			<input class="form-control" type="text" name="data_pag" id="data_pag" value="<?php echo $resultado_msg_evento['data_pag']; ?>"> 
            <br><br>
			
			<label for="nome">Nome: </label>
			<input class="form-control" type="text" name="nome" id="nome" value="<?php echo $resultado_msg_evento['nome']; ?>">
			<br><br>
			
			<label for="cpf">CPF/CNPJ: </label>
			<input class="form-control" type="text" name="cpf" id="cpf" value="<?php echo $resultado_msg_evento['cpf']; ?>">
			<br><br>
			
			<label for="id_contrato">ID do contrato: </label>
			<input class="form-control" type="text" name="id_contrato" id="id_contrato" value="<?php echo $resultado_msg_evento['id_contrato']; ?>">
			<br><br>
			
			
			<input type="hidden" name="id" value="<?php echo $resultado_msg_evento['id']; ?>">
			<input type="hidden" name="EDITOR" value="<?php echo $_SESSION['usuarioNome']; ?>">
            <input type="hidden" name="DATA" value="<?php echo $DATA; ?>">
            <input type="submit" value="Alterar" class="btn btn-info btn-fill pull-right">
			
		</form>
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