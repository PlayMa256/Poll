<?php
	include_once "../classes/autoload.php";
	$pergunta  = $_POST['pergunta'];

	$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
	$getStatus = $pdoVar->prepare("SELECT status FROM perguntas WHERE id = ?");
	$getStatus->bindParam(1, $pergunta);
	$getStatus->execute();
	while($resStatus = $getStatus->fetch(PDO::FETCH_ASSOC)){
		$status = $resStatus['status'];
		$newStats = 0;
		if($status == 0){
			$newStats = 1;
		}elseif ($status == 1) {
			$newStats = 0;
		}
		$toggleStatus = $pdoVar->prepare("UPDATE perguntas SET status = ? WHERE id = ?");
		$toggleStatus->bindParam(1, $newStats);
		$toggleStatus->bindParam(2, $pergunta);
		$toggleStatus->execute();
	}