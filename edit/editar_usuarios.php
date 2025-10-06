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
require '../config/init.php';

// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

//Valida a variavel da URL
if (empty($id)){
	echo "ID para alteração não definido";
    exit;
}

$PDO = db_connect();
$sql_msg_contato = "SELECT id, nome, email, senha, nivel_acesso_id FROM usuarios WHERE id='$id'";
$result_msg_contato = $PDO->prepare($sql_msg_contato);
$result_msg_contato->bindParam(':id', $id, PDO::PARAM_INT);

$result_msg_contato->execute();

$resultado_msg_contato = $result_msg_contato->fetch(PDO::FETCH_ASSOC);

if(!is_array($resultado_msg_contato)){
	echo "Nunhum usuário encontrado";
    exit;	
}
?>
		<h1>Editar Usuarios</h1>
		<form action="../edit/editar_msg_contato.php" method="POST">
			<label for="nome">Nome: </label>
			<input class="form-control" type="text" name="nome" id="nome" value="<?php echo $resultado_msg_contato['nome']; ?>"> 
            <br><br>
			
			<label for="email">E-mail: </label>
			<input class="form-control" type="email" name="email" id="email" value="<?php echo $resultado_msg_contato['email']; ?>">
			<br><br>
			
		    <label for="senha">Senha: </label>
			<input class="form-control" type="password" name="senha" id="senha" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 ou mais caracteres" value="<?php echo $resultado_msg_contato['senha']; ?>">
			<label>A senha deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 ou mais caracteres.</label>
			<br><br>
			
			<label for="nivel_acesso_id">Nível de Acesso: </label>
			<select name="nivel_acesso_id" class="form-control" id="nivel_acesso_id">
   		    <option value="<?php echo $resultado_msg_contato['nivel_acesso_id']; ?>">Selecione o nível de acesso</option>
    		<option value="1">Administrador</option>
   			<option value="2">Colaborador</option>
  			</select>
			<br><br>
						
			<input type="hidden" name="id" value="<?php echo $resultado_msg_contato['id']; ?>">
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