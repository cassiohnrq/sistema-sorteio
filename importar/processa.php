<?php
	session_start();
	if($_SESSION['usuarionome'] == null){
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

	include_once("../config/conexao.php");
		
	require '../vendor/autoload.php'; // PhpSpreadsheet

    use PhpOffice\PhpSpreadsheet\IOFactory;

if (!empty($_FILES['arquivo']['tmp_name'])) {
    $arquivoTmp = $_FILES['arquivo']['tmp_name'];
    $ext = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));

    $up_ok = 0;
    $primeira_linha = true;
    $batch = [];
    $batchSize = 500;

    // Hora e editor
    date_default_timezone_set("America/Sao_Paulo");
    $dataAgora = date("d/m/y - H:i");
    $editor = $_SESSION['usuarionome'];

    mysqli_begin_transaction($conn);

    try {
        if ($ext === "xml") {
            // -------- XML (Excel 2003 XML) --------
            $dom = new DOMDocument();
            $dom->load($arquivoTmp);
            $linhas = $dom->getElementsByTagName("Row");

            foreach ($linhas as $linha) {
                if ($primeira_linha) { $primeira_linha = false; continue; }

                $data_pag     = mysqli_real_escape_string($conn, $linha->getElementsByTagName("Data")->item(0)->nodeValue);
                $nome          = mysqli_real_escape_string($conn, $linha->getElementsByTagName("Data")->item(1)->nodeValue);
                $cpf        = mysqli_real_escape_string($conn, $linha->getElementsByTagName("Data")->item(2)->nodeValue);
                $id_contrato = mysqli_real_escape_string($conn, $linha->getElementsByTagName("Data")->item(3)->nodeValue);

                $batch[] = "('$data_pag','$nome','$cpf','$id_contrato','$editor','$dataAgora')";
                if (count($batch) >= $batchSize) {
                    $sql = "INSERT INTO cupons_sorteio (data_pag,nome,cpf,id_contrato,EDITOR,DATA) VALUES " . implode(",", $batch);
                    mysqli_query($conn, $sql);
                    $up_ok += mysqli_affected_rows($conn);
                    $batch = [];
                }
            }

        } elseif ($ext === "xls" || $ext === "xlsx") {
            // -------- XLS / XLSX --------
            $spreadsheet = IOFactory::load($arquivoTmp);
            $sheet = $spreadsheet->getActiveSheet();
            foreach ($sheet->getRowIterator() as $rowIndex => $row) {
                if ($rowIndex == 1) continue; // pula cabeçalho

                $cells = [];
                foreach ($row->getCellIterator() as $cell) {
                    $cells[] = $cell->getValue();
                }

                $data_pag     = mysqli_real_escape_string($conn, $cells[0] ?? "");
                $nome          = mysqli_real_escape_string($conn, $cells[1] ?? "");
                $cpf        = mysqli_real_escape_string($conn, $cells[2] ?? "");
                $id_contrato = mysqli_real_escape_string($conn, $cells[3] ?? "");

                $batch[] = "('$data_pag','$nome','$cpf','$id_contrato','$editor','$dataAgora')";
                if (count($batch) >= $batchSize) {
                    $sql = "INSERT INTO cupons_sorteio (data_pag,nome,cpf,id_contrato,EDITOR,DATA) VALUES " . implode(",", $batch);
                    mysqli_query($conn, $sql);
                    $up_ok += mysqli_affected_rows($conn);
                    $batch = [];
                }
            }

        } elseif ($ext === "csv") {
            // -------- CSV (detecta separador) --------
            $file = fopen($arquivoTmp, "r");

            // testa primeira linha
            $testLine = fgets($file);
            rewind($file);
            $delimiter = (strpos($testLine, ";") !== false) ? ";" : ",";

            $linhaNum = 0;
            while (($data = fgetcsv($file, 10000, $delimiter)) !== FALSE) {
                $linhaNum++;
                if ($linhaNum == 1) continue; // pula cabeçalho

                $data_pag     = mysqli_real_escape_string($conn, $data[0] ?? "");
                $nome          = mysqli_real_escape_string($conn, $data[1] ?? "");
                $cpf        = mysqli_real_escape_string($conn, $data[2] ?? "");
                $id_contrato = mysqli_real_escape_string($conn, $data[3] ?? "");

                $batch[] = "('$data_pag','$nome','$cpf','$id_contrato','$editor','$dataAgora')";
                if (count($batch) >= $batchSize) {
                    $sql = "INSERT INTO cupons_sorteio (data_pag,nome,cpf,id_contrato,EDITOR,DATA) VALUES " . implode(",", $batch);
                    mysqli_query($conn, $sql);
                    $up_ok += mysqli_affected_rows($conn);
                    $batch = [];
                }
            }
            fclose($file);

        } else {
            throw new Exception("Formato de arquivo não suportado.");
        }

        // Executa lote final
        if (!empty($batch)) {
            $sql = "INSERT INTO cupons_sorteio (data_pag,nome,cpf,id_contrato,EDITOR,DATA) VALUES " . implode(",", $batch);
            mysqli_query($conn, $sql);
            $up_ok += mysqli_affected_rows($conn);
        }

        mysqli_commit($conn);

        echo "<div style='margin-left:10%; margin-right:10%;'>
                <h1>Importação feita com sucesso.</h1>
                <p>Total de linhas importadas: <strong>$up_ok</strong></p>
              </div>";

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<div style='margin-left:10%;color:red;font-size:120%;margin-right:10%;'>
                Erro na importação: " . $e->getMessage() . "
              </div>";
    }
}
?>
				
<a href="importar.php" class="btn btn-info" role="button">Nova importação</a>
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