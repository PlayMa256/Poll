<?php include_once "classes/autoload.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

	<link rel="stylesheet" href="css/app.css">
	<title>Pesquisa de satisfa&ccedil;&atilde;o</title>
</head>

<body>
	<div id="box">
		<div id="content">
			<form method="post">
				<div class="perguntas">
				<?php
					$ticket = (isset($_GET['ticket'])) ? $_GET['ticket'] : null;

					//procurar pra ver se ja tem um ticket respondido;
					try{$pdoVarGlpi = new PDO("mysql:host=$endereco;dbname=$bancoGLPI", $usuario, $senha);}catch(PDOException $e)
					{echo $e;}
					$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
					$resultados = new resultados($pdoVar);
					$assets = new assets();
					$retorno = ($resultados->verificar_existe($ticket) >= 1) ? true : false;
					if($retorno){
						$assets->warning("Pesquisa j&aacute; preenchida");
						die();
					}
					if($ticket == null){
						echo '<div class="isa_error">Nenhuma pesquisa encontrada</div>';
						die();
					}
					$query = $pdoVarGlpi->prepare("SELECT * FROM glpi_tickets WHERE id = $ticket");
					$query->execute();
					while($resultado = $query->fetch(PDO::FETCH_ASSOC)){

				?>
					<h2 class="title-section">Chamado <?php echo $ticket;?></h2>
					<div class="infos">
						<?php
							$query = $pdoVarGlpi->prepare("SELECT name FROM glpi_users WHERE id = (SELECT DISTINCT users_id FROM glpi_tickets_users WHERE tickets_id = $ticket)");
							$query->execute();
							while($res = $query->fetch(PDO::FETCH_ASSOC)){
							$TecnicoResponsavel = $res['name'];
						?>
						<span><strong>T&eacute;cnico(s): </strong> <?php echo $TecnicoResponsavel;?></span>
						<?php }?>
						<span><strong>Assunto:  </strong> <?php echo utf8_encode($resultado['name']); ?></span>
						<span><strong>Data de Abertura:  </strong> <?php echo date("d/m/Y", strtotime($resultado['date'])); ?></span>
						<span><strong>Data de Vencimento: </strong> <?php echo date("d/m/Y", strtotime($resultado['closedate'])); ?></span>
						<span><strong>Data de Solu&ccedil;&atilde;o:  </strong> <?php echo date("d/m/Y", strtotime($resultado['solvedate'])); ?></span>
					</div>
					<?php 
						}
					?>
					<h2 class="title-section">Avalia&ccedil;&atilde;o</h2>
					<div class="explicacao">
						Pontue sua satisfa&ccedil;&atilde;o em rela&ccedil;&atilde;o aos itens abaixo. Na escala, 0 (Zero) significa que voc&ecirc; est&aacute; totalmente insatisfeito
						e 10 (Dez) significa que voc&ecirc; est&aacute; totalmente satisfeito.
					</div>
					<?php
						$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
						$pergunta = new Pergunta("", "", $pdoVar);
						$pergunta->montar_perguntas($ticket);
					?>
					<h2 class="title-section">Coment&aacute;rios</h2>
					<div class="classificacao">
						<textarea name="comentario" id="" cols="30" rows="10"></textarea><br/>
						<div id="class">
							<span>Classifica&ccedil;&atilde;o do coment&aacute;rio</span>
							<select name="classificacao" id="">
								<option value="" selected="selected">Selecione um tipo</option>
								<option value="elogio">Elogio</option>
								<option value="sugestao">Sugest&atilde;o</option>
								<option value="reclamacao">Reclama&ccedil;&atilde;o</option>
							</select>	
						</div>
					</div>
				<input type="hidden" name="acao" value="enviar" />
				<input type="hidden" name="ticket" value="<?php echo $ticket;?>" />
				<input type="submit" value="Enviar" id="btn-submit" />
				</div>
			</form>
		<?php if(isset($_POST['acao']) && $_POST['acao'] == 'enviar'){
			$comment = trim(strip_tags(addslashes(htmlspecialchars($_POST['comentario']))));
			$comment_type = $_POST['classificacao'];
			$Respostas = array();
			$query = $pergunta->connection->query("SELECT id FROM perguntas WHERE status = 1");
			while($resultado = $query->fetch(PDO::FETCH_ASSOC)){

				$Respostas[$resultado['id']] = $_POST["perg".$resultado['id']];

			}

			$respostasDadas = implode("|", array_values($Respostas));
			$perguntasRespondidas = implode("|", array_keys($Respostas));

			$data = date("Y-m-d");
			$insert = $pergunta->connection->prepare("INSERT INTO resultados (id_ticket, resposta, perguntas, comentario, classificacao, data) VALUES (?, ?, ?, ?, ?, ?)");
			$insert->bindParam(1, $ticket);
			$insert->bindParam(2, $respostasDadas);
			$insert->bindParam(3, $perguntasRespondidas);
			$insert->bindParam(4, $comment);
			$insert->bindParam(5, $comment_type);
			$insert->bindParam(6, $data);

			$assets = new assets();
			if($insert->execute() > 0){
				$assets->sucesso("Pesquisa realizada com sucesso!");
				die();
			}else{
				$assets->error("Problema ao completar pesquisa");
			}

			
		}
		?>
		</div>

</body>
</html>