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
    <div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-0.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="" class="simple-text">
                    Sistema Cupons
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="#">
                        <i class="pe-7s-user"></i>
                        <p><?php
	echo "Usuário: ". $_SESSION['usuarioNome'];
?></p>
                    </a>
                </li>
                   <li>
                    <a href="../cadastro/cadastrar_usuarios.php">
                        <i class="pe-7s-add-user"></i>
                        <p>Novo Usuário</p>
                    </a>
                </li>
                 <li>
                    <a href="../cadastro/cadastrar_cupons.php">
                        <i class="pe-7s-note2"></i>
                        <p>Novo Cupom</p>
                    </a>
                </li>
                <li>
                    <a href="../importar/importar.php">
                        <i class="pe-7s-server"></i>
                        <p>Importar</p>
                    </a>
                </li>
                <li>
                    <a href="../config/sair.php">
                        <i class="pe-7s-close-circle"></i>
                        <p>Sair</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
<?php
 
require_once '../config/init.php';

// pega os dados do formuário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null; 
$email = isset($_POST['email']) ? $_POST['email'] : null;  
$senha = isset($_POST['senha']) ? $_POST['senha'] : null;
$nivel_acesso_id = isset($_POST['nivel_acesso_id']) ? $_POST['nivel_acesso_id'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;

// validação para evitar dados vazios
if (empty($nome) || empty($email) || empty($senha) || empty($nivel_acesso_id))
{
    echo "Volte e preencha todos os campos";
    exit;
}

// insere no banco
$PDO = db_connect();	
$sql_msg_contatos = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, nivel_acesso_id = :nivel_acesso_id WHERE id = :id";
$insert_msg_contato = $PDO->prepare($sql_msg_contatos);
$insert_msg_contato->bindParam(':nome', $nome);
$insert_msg_contato->bindParam(':email', $email); 
$senha = md5($senha);
$insert_msg_contato->bindParam(':senha', $senha);
$insert_msg_contato->bindParam(':nivel_acesso_id', $nivel_acesso_id);
$insert_msg_contato->bindParam(':id', $id, PDO::PARAM_INT);
 
if ($insert_msg_contato->execute()){
    $_SESSION['sucessoedituser'] = "Sucessoedituser";
	header('Location: ../listar/usuarios_cadastrados.php');
}else{
	$_SESSION['erroedituser'] = "erroedituser";
	header('Location: ../listar/usuarios_cadastrados.php');
}
?>
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