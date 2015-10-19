<?php
class Pesquisa{
	public function verifica_fechamento($pdoVar, $id_ticket, $tempo){
		$PDO = $pdoVar;
		$query = $PDO->prepare("SELECT * from glpi_tickets WHERE id = $id_ticket and status = 6 AND DATEDIFF(CURDATE(), closedate) < $tempo");
		$query->execute();
		return($query->rowCount()>0) ? true : false ;

	}
	public function getCloseDate($pdoVar, $ticket){
		$dataFechamento = $pdoVar->prepare("SELECT solvedate FROM glpi_tickets WHERE id = ?");
		$dataFechamento->bindParam(1, $ticket);
		$dataFechamento->execute();
		$res = $dataFechamento->fetch(PDO::FETCH_ASSOC);
		$date = $res['solvedate'];
		
		return $date;
	}
	public function isFechado($pdoVar, $ticket){
		$isFechado = $pdoVar->prepare("SELECT * FROM glpi_tickets WHERE id = ? and status <> 6");
		$isFechado->bindParam(1, $ticket);
		$isFechado->execute();
		if($isFechado->rowCount() == 0){
			return true;
		}else{
			return false;
			
		}

	}
}
