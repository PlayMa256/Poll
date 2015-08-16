<?php
include_once "../classes/autoload.php";
$titulo = $_POST['titulo'];
$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
$query = $pdoVar->prepare("INSERT INTO perguntas (titulo) VALUES (?)");
$query->bindParam(1, $titulo);
if($query->execute() > 0){
	echo 1;
}else{
	echo 0;
}