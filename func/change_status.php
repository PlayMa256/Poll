<?php
	include_once "../classes/autoload.php";
	$pergunta_idAndStatus = $_POST['id_pergunta'];
	$explode = explode("|", $pergunta_idAndStatus);
	$id = $explode[0];
	$status = $explode[1];

	$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);

	if($status == 1){
		$query = $pdoVar->prepare("UPDATE perguntas SET status = 0 WHERE id = ?");
		$query->bindParam(1, $id);
		if($query->execute() > 0){
			echo "0";
		}else{
			echo "1";
		}
	}else{
		$query = $pdoVar->prepare("UPDATE perguntas SET status = 1 WHERE id = ?");
		$query->bindParam(1, $id);
		if($query->execute() > 0){
			echo "1";
		}else{
			echo "0";
		}
	}