<?php
	include "../classes/autoload.php";
	include "../func/countFieldsPDO.php";

	$dataInicial = $_POST['dataInicio'];
	$dataFinal = $_POST['dataFinal'];

	// $explode1 = explode("/", $dataInicial);
	// $explode2 = explode("/", $dataFinal);
	// $dataInicio = $explode1[2]."-".$explode1[1]."-".$explode1[0];
	// $dataFim = $explode2[2]."-".$explode2[1]."-".$explode2[0];
	

	//handle the database connectivity 
	$dsn = 'mysql:host='.$endereco.';dbname='.$banco;
	$username = 'root';
	$password = '123';
	$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	 
	try {
	    $db = new PDO($dsn, $usuario, $senha, $options);
	} catch (PDOException $e) {
	    $error_message = $e->getMessage();
	    include 'errors/db_error_connect.php';
	    exit;
	}
	 
	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=pesquisa.txt");
	header("Pragma: no-cache");
	header("Expires: 0");
	 
	$query = "SELECT * FROM resultados WHERE referencia BETWEEN '$dataInicial' AND '$dataFinal'";
	try {
	       $statement = $db->prepare($query);
	       $statement->execute();
	       $results = $statement->fetchAll();
	       $statement->closeCursor();
	 
	       $content = '';
	       $title = '';
	       foreach ($results as $rs){
	           $perguntas = $rs['perguntas'];
	           $explodePerguntas = explode("|", $perguntas);
	           foreach($explodePerguntas as $k=>$v){
	           		$queryTitulo = $db->prepare("SELECT titulo FROM perguntas WHERE id = ?");
	           		$queryTitulo->bindParam(1, $v);
	           		$queryTitulo->execute();
	           		while($resultado = $queryTitulo->fetch(PDO::FETCH_ASSOC)){
	           			$titulo = $resultado['titulo'];
	           			$content .= stripcslashes($rs['id']).",";
	           			$content .= stripcslashes($rs['id_ticket']).",";
	           			$content .= stripcslashes($titulo).",";
	           			$explodeRespostas = explode("|", $rs['resposta']);
	           			$content .= stripcslashes($explodeRespostas[$k]).",";
	           			$content .= stripcslashes(ucfirst(utf8_encode($rs['comentario']))).",";
	           			$content .= stripcslashes(ucfirst(utf8_decode($rs['classificacao']))).",";
	           			$content .= stripcslashes($rs['referencia']).",";
	           			$content .= stripcslashes(date("d-m-Y", strtotime($rs['data'])))."\n";
	           		}

	           }
	        }
	 		$title .= "id,id_ticket,pergunta,resposta,comentario,classificao,referencia,data\n";
	        echo $title;
	        echo $content;
	 
	   } catch (PDOException $e) {
	       $error_message = $e->getMessage();
	       exit;
	 }

?>
