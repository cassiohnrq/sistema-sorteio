<?php
	session_start();
if($_SESSION['usuarioNome'] == null){
	header("Location: ../login.php");}
if($_SESSION['usuarioNiveisAcessoId'] != "1"){
	echo 'Você não tem permissão para acessar essa pagina.';
	header("Location: ../config/sair.php");}
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
ob_start();
$btnCadEvento = filter_input(INPUT_POST, 'btnCadEvento', FILTER_SANITIZE_SPECIAL_CHARS);
if($btnCadEvento){
	include_once '../config/conexao.php';
	$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	//var_dump($dados);
	$dados['senha'] = md5($dados['senha']);
	
	$result_usuario = "INSERT INTO usuarios (nome, email, senha, nivel_acesso_id) VALUES (
					'" .$dados['nome']. "',
					'" .$dados['email']. "',
					'" .$dados['senha']. "',
					'" .$dados['nivel_acesso_id']. "'
					)";
	$resultado_usario = mysqli_query($conn, $result_usuario);
	if(mysqli_insert_id($conn)){
$_SESSION['sucessoadduser'] = "Sucessoadduser";
}else{
	$_SESSION['erroadduser'] = "erroadduser";
}
}
?>
		<h2>Cadastro</h2>
		<div class="col-md-10">
			<?php if(!empty($_SESSION['sucessoadduser'])){ 
				unset($_SESSION['sucessoadduser']);
				?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Usuário adicionado com Sucesso
				</div>
			<?php } ?>
			<?php if(!empty($_SESSION['erroadduser'])){ 
				unset($_SESSION['erroadduser']);
				?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Usuário não foi adicionado com Sucesso
				</div>
			<?php } ?>
			</div>
			<div class="col-md-10">
		<form method="POST" action="">
			<label>Nome</label>
			<input type="text" name="nome" placeholder="Digite o nome" class="form-control"><br><br>
			
			<label>E-mail</label>
			<input type="text" name="email" placeholder="Digite o e-mail" class="form-control"><br><br>
			
			<label>Senha</label>
			<input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 ou mais caracteres"  name="senha" placeholder="Digite a senha" class="form-control">
			<label>A senha deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 ou mais caracteres.</label>
			<br><br>
			
			<label>Nível de Acesso</label>
			<select name="nivel_acesso_id" class="form-control">
    		<option value="1">Administrador</option>
   			<option value="2">Colaborador</option>
  			</select>
			<br><br>
			
			<input type="submit" name="btnCadEvento" value="Cadastrar" class="btn btn-info btn-fill pull-right"><br><br>
			
		
		</form>
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