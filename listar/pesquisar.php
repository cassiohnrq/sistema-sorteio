<?php 
	session_start();
	if($_SESSION['usuarioNome'] == null){
	header("Location: ../login.php");}
include_once("../config/conexao.php");
require_once '../config/init.php';
	
	// abre a conexão
	$PDO = db_connect();

	$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
if(!isset($_GET['pesquisar'])){
	header("Location: ../listar/cupons_cadastrados.php");
}else{
	$valor_pesquisar = $_GET['pesquisar'];
}

	//Selecionar todos os cursos da tabela
$sql_msg = "SELECT * FROM cupons_sorteio WHERE (nome LIKE '%$valor_pesquisar%') or (cpf LIKE '%$valor_pesquisar%')";
$resultado_curso = mysqli_query($conn, $sql_msg);

//Contar o total de cursos
$total_cursos = mysqli_num_rows($resultado_curso);

//Seta a quantidade de cursos por pagina
$quantidade_pg = 100;

//calcular o número de pagina necessárias para apresentar os cursos
$num_pagina = ceil($total_cursos/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os cursos a serem apresentado na página
$sql_msg = "SELECT * FROM cupons_sorteio WHERE (nome LIKE '%$valor_pesquisar%') or (cpf LIKE '%$valor_pesquisar%') limit $incio, $quantidade_pg";
$resultado_cursos = mysqli_query($conn, $sql_msg);
$total_cursos = mysqli_num_rows($resultado_cursos);
// seleciona os registros
	$resultado_msg = $PDO->prepare($sql_msg);
	$resultado_msg->execute();
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
        $("#btnPrint").live("click", function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=758px,width=1366px');
			printWindow.document.write('<html>');
            printWindow.document.write('<head><title><?php echo $valor_pesquisar?></title><style>');
            printWindow.document.write('table {border-collapse:collapse;}');
            printWindow.document.write('table td, table th{ border: 1px solid #73afb7; text-align:left;}');
            printWindow.document.write('</style></head>');
            printWindow.document.write('<body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
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
                <div class="container theme-showcase" role="main"> 
			<div class="page-header">
				<h1>Listar Cupons</h1>
			</div>
			<div class="col-md-10">
			<?php if(!empty($_SESSION['sucesso'])){ 
				unset($_SESSION['sucesso']);
				?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Cupom excluido com Sucesso
				</div>
			<?php } ?>
			<?php if(!empty($_SESSION['erro'])){ 
				unset($_SESSION['erro']);
				?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Cupom não foi excluido com Sucesso
				</div>
			<?php } ?>
			</div>
			<div class="col-md-10">
			<?php if(!empty($_SESSION['sucessoeditevento'])){ 
				unset($_SESSION['sucessoeditevento']);
				?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Cupom editado com Sucesso
				</div>
			<?php } ?>
			<?php if(!empty($_SESSION['erroeditevento'])){ 
				unset($_SESSION['erroeditevento']);
				?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Cupom não foi editado com Sucesso
				</div>
			<?php } ?>
			</div>
                     <div align="left" class="col-md-8">
                      <div align="center" class="col-md-2">
                      <a id="btnPrint" class="btn btn-info btn-fill pull-left">Imprimir</a>
					</div>
					</div>
                       <div align="right" class="col-md-10">
						<form class="form-inline" method="GET" action="../listar/pesquisar.php">
							<div class="form-group">
								<label for="exampleInputName2">Pesquisar</label>
								<input type="text" name="pesquisar" class="form-control" id="exampleInputName2" placeholder="Digitar...">
							</div>
							<button type="submit" class="btn btn-primary">Pesquisar</button>
						</form>
					</div>
			<div class="row">
				<div class="col-md-10" id="dvContainer">
					<table class="table">
						<thead>
							<tr>
								<th>Id</th>
								<th>Data de pagamento</th>
								<th>Nome</th>
								<th>CPF/CNPJ</th>
								<th>ID do Contrato</th>
								<th>Editor</th>
								<th>Data</th>
								<th>Editar</th>
								<th>Apagar</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								//Para obter os dados pode ser utilizado um while percorrendo assim cada linha retornada do banco de dados:
								while ($msg_contatos = $resultado_msg->fetch(PDO::FETCH_ASSOC)): ?>
									<tr>
									    <td><?php echo $msg_contatos['id']; ?></td>
										<td><?php echo $msg_contatos['data_pag']; ?></td>
										<td><?php echo $msg_contatos['nome']; ?></td>
										<td><?php echo $msg_contatos['cpf']; ?></td>
										<td><?php echo $msg_contatos['id_contrato']; ?></td>
										<td><?php echo $msg_contatos['EDITOR']; ?></td>
										<td><?php echo $msg_contatos['DATA']; ?></td>
										<td>
										<a href="../edit/editar_cupons.php?id=<?php echo $msg_contatos['id']; ?>">
												<span class="glyphicon glyphicon-pencil text-warning" aria-hidden="true"></span>
											</a>
											</td>
											<td>
											<a href="../apagar/apagar_cupons.php?id=<?php echo $msg_contatos['id']; ?>">
												<span class="pe-7s-close-circle" aria-hidden="true"></span>
											</a>
										</td>
										
									</tr>    
								<?php endwhile; ?>
						</tbody>
					</table>
					<?php
				//Verificar a pagina anterior e posterior
				$pagina_anterior = $pagina - 1;
				$pagina_posterior = $pagina + 1;
			?>
			<nav class="text-center">
				<ul class="pagination">
					<li>
						<?php
						if($pagina_anterior != 0){ ?>
							<a href="../listar/pesquisar.php?pagina=<?php echo $pagina_anterior; ?>&pesquisar=<?php echo $valor_pesquisar; ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&laquo;</span>
					<?php }  ?>
					</li>
					<?php 
					//Apresentar a paginacao
					for($i = 1; $i < $num_pagina + 1; $i++){ ?>
						<li><a href="../listar/pesquisar.php?pagina=<?php echo $i; ?>&pesquisar=<?php echo $valor_pesquisar; ?>"><?php echo $i; ?></a></li>
					<?php } ?>
					<li>
						<?php
						if($pagina_posterior <= $num_pagina){ ?>
							<a href="../listar/pesquisar.php?pagina=<?php echo $pagina_posterior; ?>&pesquisar=<?php echo $valor_pesquisar; ?>" aria-label="Previous">
								<span aria-hidden="true">&raquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&raquo;</span>
					<?php }  ?>
					</li>
				</ul>
			</nav>
				</div>
			</div>
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