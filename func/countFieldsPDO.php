<?php 
 
function contar($table, $conn){
	$query = $conn->prepare("SELECT count(*) FROM $table");
	$query->execute();
	$number = $query->fetchColumn();
	return $number;
}