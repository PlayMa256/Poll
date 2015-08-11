<?php
	include "../config/config.php";
	include "../func/lib.php";
	$dataInicial = $_POST['dataInicio'];
	$dataFinal = $_POST['dataFinal'];

	$explode1 = explode("/", $dataInicial);
	$explode2 = explode("/", $dataFinal);
	$dataInicio = $explode1[2]."/".$explode1[1]."/".$explode1[0];
	$dataFim = $explode2[2]."/".$explode2[1]."/".$explode2[0];

    $csv_export = '';

    $query = mysql_query("SELECT * FROM resultados WHERE data BETWEEN '$dataInicio' and '$dataFim'", $poll);

	exportMysqlToCsv($query);
?>