<?php
	include_once "../classes/autoload.php";
	$pergunta  = $_POST['pergunta'];

	$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
	$getStatus = $pdoVar->prepare("SELECT status FROM perguntas WHERE id = ?");
	$getStatus->bindParam(1, $pergunta);
	

	// if($status == 1){
	// 	$query = $pdoVar->prepare("UPDATE perguntas SET status = 0 WHERE id = ?");
	// 	$query->bindParam(1, $id);
	// 	if($query->execute() > 0){
	// 		echo "0";
	// 	}else{
	// 		echo "1";
	// 	}
	// }else{
	// 	$query = $pdoVar->prepare("UPDATE perguntas SET status = 1 WHERE id = ?");
	// 	$query->bindParam(1, $id);
	// 	if($query->execute() > 0){
	// 		echo "1";
	// 	}else{
	// 		echo "0";
	// 	}
	// }