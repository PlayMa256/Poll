<?php
include_once "../classes/Connection.php";
include_once "../classes/perguntas.php";

$pergunta_id = (isset($_GET['id_pergunta'])) ? $_GET['id_pergunta'] : null;

$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
$pergunta = new Pergunta("", "", $pdoVar);
if($pergunta->remover($pergunta_id)){
	echo '<script>alert("Apagado com sucesso");location.href="gerenciar_perguntas.php";</script>';
	//echo 'foi';
}else{
	echo '<script>alert("Problema ao apagar");location.href="gerenciar_perguntas.php";</script>';
	//echo 'nao foi';
}
