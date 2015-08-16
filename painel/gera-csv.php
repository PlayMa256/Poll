<?php
	include "../classes/autoload.php";
	include "../func/countFieldsPDO.php";

	$dataInicial = $_POST['dataInicio'];
	$dataFinal = $_POST['dataFinal'];

	$explode1 = explode("/", $dataInicial);
	$explode2 = explode("/", $dataFinal);
	$dataInicio = $explode1[2]."-".$explode1[1]."-".$explode1[0];
	$dataFim = $explode2[2]."-".$explode2[1]."-".$explode2[0];
	

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
	header("Content-Disposition: attachment; filename=products-data.csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	 
	$query = "SELECT * FROM resultados WHERE data BETWEEN '$dataInicio' AND '$dataFim'";
	try {
	       $statement = $db->prepare($query);
	       $statement->execute();
	       $results = $statement->fetchAll();
	       $statement->closeCursor();
	 
	       $content = '';
	       $title = '';
	       foreach ($results as $rs){
	           $content .= stripslashes($rs["id"]). ',';
	           $content .= stripslashes($rs["id_ticket"]). ',';
	           $content .= stripslashes($rs["comentario"]). ',';
	           $content .= stripslashes($rs["classificacao"]). ',';
	           $content .= stripslashes($rs["data"]). ',';
	           $content .= stripslashes($rs["perguntas"]). ',';
	           $content .= stripslashes($rs["resposta"]). ',';
	           $content .= "\n";
	        }
	 
	        $title .= "id,id_ticket,comentario,classificacao,data,perguntas,res"."\n";
	        echo $title;
	        echo $content;
	 
	   } catch (PDOException $e) {
	       $error_message = $e->getMessage();
	       global $app_path;
	       include 'errors/db_error.php';
	       exit;
	 }

?>