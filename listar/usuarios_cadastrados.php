<?php
	session_start();
	if($_SESSION['usuarioNome'] == null){
	header("Location: ../login.php");}
    if($_SESSION['usuarioNiveisAcessoId'] != "1"){
	echo 'Você não tem permissão para acessar essa pagina.';
	header("Location: ../config/sair.php");}

    require_once '../config/init.php';
	
	// abre a conexão
	$PDO = db_connect();
	
	// SQL para selecionar os registros
	$sql_msg = "SELECT id, nome, email, nivel_acesso_id FROM usuarios ORDER BY id ASC";
	
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
				<h1>Listar Usuários</h1>
			</div>
         <div class="col-md-10">
			<?php if(!empty($_SESSION['sucesso'])){ 
				unset($_SESSION['sucesso']);
				?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Usuário excluido com Sucesso
				</div>
			<?php } ?>
			<?php if(!empty($_SESSION['erro'])){ 
				unset($_SESSION['erro']);
				?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Usuário não foi excluido com Sucesso
				</div>
			<?php } ?>
			</div>
			<div class="col-md-10">
			<?php if(!empty($_SESSION['sucessoedituser'])){ 
				unset($_SESSION['sucessoedituser']);
				?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Usuário editado com Sucesso
				</div>
			<?php } ?>
			<?php if(!empty($_SESSION['erroedituser'])){ 
				unset($_SESSION['erroedituser']);
				?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Usuário não foi editado com Sucesso
				</div>
			<?php } ?>
			</div>
			<div class="row">
				<div class="col-md-10">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>E-mail</th>
								<th>Nível de acesso</th>
								<th>Editar</th>
								<th>Apagar</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								//Para obter os dados pode ser utilizado um while percorrendo assim cada linha retornada do banco de dados:
								while ($msg_contatos = $resultado_msg->fetch(PDO::FETCH_ASSOC)): 
								if($msg_contatos['nivel_acesso_id'] == '1'){
									$nivel_acesso_id = 'Administrador';
								} else if($msg_contatos['nivel_acesso_id'] == '2'){
									$nivel_acesso_id = 'Colaborador'; }?>
									<tr>
										<td><?php echo $msg_contatos['id']; ?></td>
										<td><?php echo $msg_contatos['nome']; ?></td>
										<td><?php echo $msg_contatos['email']; ?></td>
										<td><?php echo $nivel_acesso_id; ?></td>
										<td>
										<a href="../edit/editar_usuarios.php?id=<?php echo $msg_contatos['id']; ?>">
												<span class="glyphicon glyphicon-pencil text-warning" aria-hidden="true"></span>
											</a>
											</td>
											<td>
											<a href="../apagar/apagar_usuarios.php?id=<?php echo $msg_contatos['id']; ?>">
												<span class="pe-7s-close-circle " aria-hidden="true"></span>
											</a>
										</td>
										
									</tr>    
								<?php endwhile; ?>
						</tbody>
					</table>
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