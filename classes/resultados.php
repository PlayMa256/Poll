<?php
class resultados{
	private $id_pergunta;
	private $id_resposta;
	private $id_poll;
	private $resposta;
	private $pergunta;
    private $connection;
	function __construct($connection) {
		$this->connection = $connection;
	}

	public function get_resposta($ticket){
		$Poll->prepare("SELECT * FROM resultados WHERE id_poll = ? AND id_pergunta = ?");
		$Poll->bindParams(1, $poll);
		$Poll->bindParams(2, $pergunta);
		$Poll->execute();
		$result = $Poll->fetch_all();
		return $result;
	}
    public function verificar_existe($ticket){
        $db = $this->connection;
        $query = $db->prepare("SELECT * FROM resultados WHERE id_ticket = $ticket");
        $query->execute();
        $results = $query->rowCount();
        return $results;


    }
    /**
     * Gets the value of id_pergunta.
     *
     * @return mixed
     */
    public function getIdPergunta()
    {
        return $this->id_pergunta;
    }

    /**
     * Gets the value of id_resposta.
     *
     * @return mixed
     */
    public function getIdResposta()
    {
        return $this->id_resposta;
    }

    /**
     * Gets the value of id_poll.
     *
     * @return mixed
     */
    public function getIdPoll()
    {
        return $this->id_poll;
    }

    /**
     * Gets the value of resposta.
     *
     * @return mixed
     */
    public function getResposta()
    {
        return $this->resposta;
    }

    /**
     * Gets the value of pergunta.
     *
     * @return mixed
     */
    public function getPergunta()
    {
        return $this->pergunta;
    }

    /**
     * Sets the value of id_pergunta.
     *
     * @param mixed $id_pergunta the id pergunta
     *
     * @return self
     */
    private function _setIdPergunta($id_pergunta)
    {
        $this->id_pergunta = $id_pergunta;

        return $this;
    }

    /**
     * Sets the value of id_resposta.
     *
     * @param mixed $id_resposta the id resposta
     *
     * @return self
     */
    private function _setIdResposta($id_resposta)
    {
        $this->id_resposta = $id_resposta;

        return $this;
    }

    /**
     * Sets the value of id_poll.
     *
     * @param mixed $id_poll the id poll
     *
     * @return self
     */
    private function _setIdPoll($id_poll)
    {
        $this->id_poll = $id_poll;

        return $this;
    }

    /**
     * Sets the value of resposta.
     *
     * @param mixed $resposta the resposta
     *
     * @return self
     */
    private function _setResposta($resposta)
    {
        $this->resposta = $resposta;

        return $this;
    }

    /**
     * Sets the value of pergunta.
     *
     * @param mixed $pergunta the pergunta
     *
     * @return self
     */
    private function _setPergunta($pergunta)
    {
        $this->pergunta = $pergunta;

        return $this;
    }
}


?>