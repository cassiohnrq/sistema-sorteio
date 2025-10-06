<?php
	session_start();
if($_SESSION['usuarioNome'] == null){
	header("Location: ../login.php");}
if($_SESSION['usuarioNiveisAcessoId'] != "1"){
	echo 'Você não tem permissão para acessar essa pagina.';
	header("Location: ../config/sair.php");}
?>
<?php
include "../config/conexao.php";

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $paragrafo = $conn->real_escape_string($_POST['paragrafo']);

    // Pega os valores antigos para não perder se não enviar imagem nova
    $sqlOld = "SELECT * FROM configuracoes ORDER BY id DESC LIMIT 1";
    $resOld = $conn->query($sqlOld);
    $old = $resOld->fetch_assoc();

    // Upload da imagem mobile
    $bg_mobile = $old['bg_mobile']; // mantém antigo
    if (!empty($_FILES['bg_mobile']['name'])) {
        $nomeMobile = time() . "_mobile_" . basename($_FILES["bg_mobile"]["name"]);
        $caminhoMobile = "../uploads/" . $nomeMobile;

        if (move_uploaded_file($_FILES["bg_mobile"]["tmp_name"], $caminhoMobile)) {
            $bg_mobile = $caminhoMobile;
        } else {
            $msg .= "Erro no upload da imagem Mobile. Código: " . $_FILES["bg_mobile"]["error"] . "<br>";
        }
    }

    // Upload da imagem PC
    $bg_pc = $old['bg_pc']; // mantém antigo
    if (!empty($_FILES['bg_pc']['name'])) {
        $nomePc = time() . "_pc_" . basename($_FILES["bg_pc"]["name"]);
        $caminhoPc = "../uploads/" . $nomePc;

        if (move_uploaded_file($_FILES["bg_pc"]["tmp_name"], $caminhoPc)) {
            $bg_pc = $caminhoPc;
        } else {
            $msg .= "Erro no upload da imagem PC. Código: " . $_FILES["bg_pc"]["error"] . "<br>";
        }
    }

    // Upload da logo
    $logo = $old['logo']; // mantém antigo
    if (!empty($_FILES['logo']['name'])) {
        $nomeLogo = time() . "_logo_" . basename($_FILES["logo"]["name"]);
        $caminhoLogo = "../uploads/" . $nomeLogo;

        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $caminhoLogo)) {
            $logo = $caminhoLogo;
        } else {
            $msg .= "Erro no upload da logo. Código: " . $_FILES["logo"]["error"] . "<br>";
        }
    }

    // Inserindo no banco
    $sql = "INSERT INTO configuracoes (titulo, paragrafo, bg_mobile, bg_pc, logo)
            VALUES ('$titulo', '$paragrafo', '$bg_mobile', '$bg_pc', '$logo')";

    if ($conn->query($sql)) {
        $msg .= "Configurações salvas com sucesso!";
    } else {
        $msg .= "Erro: " . $conn->error;
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
        body { font-family: Arial, sans-serif; padding: 20px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px 20px; background: green; color: white; border: none; cursor: pointer; }
        .msg { margin-top: 15px; color: blue; }
    </style>
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
				
            <h2>Painel de Administração</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Título</label>
        <input type="text" name="titulo" required>

        <label>Lista de Premios</label>
        <textarea name="paragrafo" rows="10" required></textarea>
		
        <label>Plano de Fundo Mobile (Imagem 1080x1920px) <a href="../imagens/guia.jpg" download>Download</a></label>
        <input type="file" name="bg_mobile" accept="image/*">

        <label>Plano de Fundo PC (Imagem1920x1080px)</label>
        <input type="file" name="bg_pc" accept="image/*">
		
		<label>Logo (imagem)</label>
		<input type="file" name="logo" accept="image/*">

        <button type="submit" class="btn btn-info btn-fill pull-left">Salvar Configurações</button>
    </form>
		<br><br>
    <?php if ($msg) { ?>
        <p class="msg"><?= $msg ?></p>
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