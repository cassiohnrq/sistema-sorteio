 <?php
	session_start();
	if($_SESSION['usuarioNome'] == null){
	header("Location: ../login.php");}
	echo $_SESSION['usuarioNome'];
	include_once('../config/conexao.php');
?>
<?php
// Defina o separador (pode vir de GET/POST ou usar padrão)
$separator = isset($_GET['sep']) && $_GET['sep'] === 'semicolon' ? ';' : ','; // padrão vírgula

// Nome do arquivo
$arquivo = 'Cupons.csv';

// Força download
header('Content-Type: text/csv; charset=UTF-8');
header("Content-Disposition: attachment; filename=\"$arquivo\"");
header('Cache-Control: max-age=0');

// Abre "arquivo" em memória
$output = fopen('php://output', 'w');

// Adiciona BOM UTF-8 para Excel
echo "\xEF\xBB\xBF";

// Cabeçalho
fputcsv($output, ['Data de pagamento', 'Nome', 'CPF/CNPJ', 'ID contrato', 'Usuário', 'Data e Hora'], $separator);

// Busca dados no banco
$result = mysqli_query($conn, "SELECT * FROM cupons_sorteio");

while($row = mysqli_fetch_assoc($result)){
    fputcsv($output, [
        $row['data_pag'],
        $row['nome'],
        $row['cpf'],
        $row['id_contrato'],
        $row['EDITOR'],
        $row['DATA']
    ], $separator);
}

// Fecha arquivo
fclose($output);
exit;
?>