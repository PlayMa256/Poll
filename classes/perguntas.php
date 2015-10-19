<?php
class Pergunta{
	private $id;
    private $status;
    private $title;
    // Add a new property for the PDO object
    public $connection;
    private $columns;

    // Pass it to the constructor
    public function __construct($titulo="", $status="", $con){
        // Set the property
        $this->connection = $con;
        $this->title = $titulo;
        $this->status = $status;
    }

    public function insere(){
        // Now use the connection property inside the class.
        $prepare = $this->connection->prepare("INSERT INTO perguntas (titulo, status) VALUES (?,?)");
        $prepare->bindParam(1, $this->title);
        $prepare->bindParam(2, $this->status);
        $query = $prepare->execute();
        if($query > 0){
        	return true;
        }else{
        	return false;
        }     
    }
    public function trazer_title($id){
		$prepare = $this->connection->prepare("SELECT titulo FROM perguntas WHERE id = ?");
		$prepare->bindParam(1, $id);
		$prepare->execute();
		$retorno = $prepare->fetch(PDO::FETCH_ASSOC);
		return $retorno['titulo'];

	}
    public function montar_perguntas($poll_id){
        $query = $this->connection->query("SELECT * FROM perguntas WHERE status = 1");
        $i=1;
        while($result = $query->fetch(PDO::FETCH_ASSOC)){
            
            echo '<div class="perg">';

            echo '<span>'.$i.') '.$result['titulo'].'*</span>';

            echo '<div class="envolucro">';
            for($k=0;$k<=10;$k++){
               echo '<label><input type="radio" class="perg perg'.$i.'" name="perg'.$result['id'].'" value="'.$k.'" id="">'.$k.'</label>';
            }
            echo '</div>';

            echo '</div>';
            $i++;
        }
    }
    public function desativa_pergunta($id_pergunta){
        $query = $this->connection->prepare("UPDATE perguntas SET status = 0 WHERE id = ?");
        $query->bindParam(1, $id_pergunta);
        if($query->execute() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function remover($id_pergunta){

        $query = $this->connection->prepare("DELETE FROM perguntas WHERE id = ?");
        $query->bindParam(1, $id_pergunta);
        if($query->execute() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function get_all_title(){
        $db = $this->connection;
        $query = $db->query("SELECT titulo FROM perguntas");
        $results = array();
        while($res = $query->fetch(PDO::FETCH_ASSOC)){
            array_push($results, $res['titulo']);
        }
        return $results;
    }
    public function get_status($id){
        $db = $this->connection;
        $query = $db->prepare("SELECT status FROM perguntas WHERE id = ?");
        $query->bindParam(1, $id);
        $query->execute();
        $results = $query->fetch(PDO::FETCH_ASSOC);
        return $results['status'];

    }
    public function verificaPergEmResultados($id_pergunta){
        $db= $this->connection;
        $query = $db->prepare("SELECT * FROM resultados WHERE perguntas LIKE '%$id_pergunta|%' or perguntas LIKE '%|$id_pergunta%' or perguntas LIKE '%$id_pergunta|%' ");
        $query->execute();
        if($query->rowCount() >= 1){
            return false;
        }else{
            return true;
        }
    }
    public function numberActiveQuestions(){
        $query = $this->connection->prepare("SELECT COUNT(id) as quantidade FROM perguntas WHERE status = 1");
        $query->execute();
        while($result = $query->fetch(PDO::FETCH_ASSOC)){
            return $result['quantidade'];
        }
    }
        
    /**
     * Gets the value of title.
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
}