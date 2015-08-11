<?php
	include_once "../classes/autoload.php";
	$pergunta = $_POST['pergunta'];
	$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
	$query = $pdoVar->query("SELECT status FROM perguntas WHERE id = '$pergunta'");
	while($resultado = $query->fetch(PDO::FETCH_ASSOC)){
		if($resultado['status'] == 0){
			echo 0;
		}else{
			echo 1;
		}
	}
