<?php
include_once "setConnections.php";
class Polls{
	private $title;
	private $connection;
	function __construct($title, $con) {
		$this->title = $title;
		$this->connection = $con;
	}
	public function inserir(){
		$prepare = $this->connection->prepare("INSERT INTO polls (titulo) VALUES (?)");
		$prepare->bindParam(1, $this->title);
		$res = $prepare->execute();
		if($res > 0){
			return true;

		}else{
			return false;
		}
	}
	public function trazer_title($id){
		$prepare = $this->connection->prepare("SELECT title FROM polls WHERE id = ?");
		$prepare ->bindParam(1, $id);
		$prepare->execute();
		$result = $prepare->fetch_all();
		return $result;
	}
	public function trazer_id($title){
		$prepare = $this->connection->prepare("SELECT id FROM polls WHERE titulo = ?");
		$prepare ->bindParams(1, $title);
		$prepare ->execute();
		$result = $prepare ->fetch_all();
		return $result;
	}
}