<?php include_once "classes/autoload.php";error_reporting(0);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/app.css">
	<title>Pesquisa de satisfa&ccedil;&atilde;o</title>
</head>

<body>
<div class="content content-fluid">
	<div id="box">
		<div id="content">
			<form method="post" id="formulario">
				<div class="perguntas">
				<?php
					$data = date("Y-m-d");

					$ticket = (isset($_GET['ticket'])) ? $_GET['ticket'] : null;
					$pdoVarGlpi = new PDO("mysql:host=$endereco;dbname=$bancoGLPI", $usuario, $senha);
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
					$data_limite = file_get_contents("../arquivo.txt");
					$verifica_fechamento = $pdoVarGlpi->prepare("SELECT * from glpi_tickets WHERE id = $ticket and status = 6 and $data < strtotime(closedate. ' + $data_limite days')");
					$verifica_fechamento->execute();

					if($verifica_fechamento->rowCount() <= 0){
						$assets->warning("Ticket não é velho o suficiente");
						die();

					}


					$query = $pdoVarGlpi->prepare("SELECT * FROM glpi_tickets WHERE id = $ticket and status = 6");
					$query->execute();
					while($resultado = $query->fetch(PDO::FETCH_ASSOC)){

				?>
				<!-- Informacoes -->
					<div class="infos">
						<a href="http://localhost/glpi/front/ticket.form.php?id=<?php echo $ticket;?>"><h2 class="title-section">Chamado <?php echo $ticket;?></h2></a>
						<?php
							//$query = $pdoVarGlpi->prepare("SELECT name FROM ( glpi_users INNER JOIN glpi_tickets_users ON glpi_users.id = glpi_tickets_users = users_id) WHERE tickets_id = $ticket");
							$query = $pdoVarGlpi->prepare("SELECT name FROM glpi_users WHERE id IN (SELECT users_id FROM glpi_tickets_users WHERE tickets_id = $ticket AND type=2)");
							$number = $query->execute();
							$TecnicoResponsavel = array();
							while($res = $query->fetch(PDO::FETCH_ASSOC)){
								$TecnicoResponsavel[] = $res['name'];
							}
						?>
						<div class="sumario">
							<strong>T&eacute;cnico(s):  </strong> 
							<span>
							<?php 
							//pequenao hack para conseguir inserir , depois de todos os tecnicos sem sobrar uma no final.
							$var = implode(", ", array_values($TecnicoResponsavel)); echo $var;?>
							</span>
						</div>
						<div class="sumario">
							<strong>Assunto:   </strong>
							<span> <?php echo utf8_encode($resultado['name']); ?></span>
						</div>
						<div class="sumario">
							<strong>Data de Abertura:   </strong> 
							<span><?php echo date("d/m/Y", strtotime($resultado['date'])); ?></span>
						</div>
						<div class="sumario">
							<strong>Data de Vencimento:  </strong> 
							<span><?php echo date("d/m/Y", strtotime($resultado['due_date'])); ?></span>
						</div>
						<div class="sumario">
							<strong>Data de Solu&ccedil;&atilde;o:   </strong> 
							<span><?php echo date("d/m/Y", strtotime($resultado['solvedate'])); ?></span>
						</div>
					</div>
					<?php 
						}
					?>
					<!-- FIM Informacoes -->
					<!-- Avaliaçoes -->
					<div class="wrapper-avaliacoes">				
						<h2 class="title-section">Avalia&ccedil;&atilde;o</h2>
						<div class="explicacao">
							Pontue sua satisfa&ccedil;&atilde;o em rela&ccedil;&atilde;o aos itens abaixo. Na escala, 0 (Zero) significa que voc&ecirc; est&aacute; totalmente insatisfeito
							e 10 (Dez) significa que voc&ecirc; est&aacute; totalmente satisfeito.
						</div>
						<div class="wrapper-altern">
						<?php
							$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
							$pergunta = new Pergunta("", "", $pdoVar);
							$pergunta->montar_perguntas($ticket);
						?>
						</div>
						<div class="clearfix"></div>
					</div>
					<!-- FIM Avaliaçoes -->
					<!-- Comentarios -->
					<div class="wrapper-comentarios">
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
				<input type="submit" value="Enviar" id="btn-submit"/>
				</div>		<!-- FIM Comentarios -->
				</div> <!-- FIM perguntas -->
			</form>

			<?php if(isset($_POST['acao']) && $_POST['acao'] == 'enviar'){
			$comment = trim(strip_tags(addslashes(htmlspecialchars($_POST['comentario']))));
			$comment_type = $_POST['classificacao'];
			$Respostas = array();
			$query = $pergunta->connection->query("SELECT id FROM perguntas WHERE status = 1");
			$ativos = $query->rowCount();
			$naoPreenchidos = 0;
			while($resultado = $query->fetch(PDO::FETCH_ASSOC)){
				$preenchido = $_POST["perg".$resultado['id']];
				if(!isset($preenchido)){
					$naoPreenchidos++;
				}else{
					$Respostas[$resultado['id']] = $_POST["perg".$resultado['id']];
				}
			}

			$assets = new assets();
			if($naoPreenchidos >= $ativos){
				$assets->alert_danger("Todos os campos devem ser preenchidos");
			}else{

				$respostasDadas = implode("|", array_values($Respostas));
				$perguntasRespondidas = implode("|", array_keys($Respostas));

				$insert = $pergunta->connection->prepare("INSERT INTO resultados (id_ticket, resposta, perguntas, comentario, classificacao, data) VALUES (?, ?, ?, ?, ?, ?)");
				$insert->bindParam(1, $ticket);
				$insert->bindParam(2, $respostasDadas);
				$insert->bindParam(3, $perguntasRespondidas);
				$insert->bindParam(4, $comment);
				$insert->bindParam(5, $comment_type);
				$insert->bindParam(6, $data);
				if($insert->execute() > 0){
					$assets->sucesso("Pesquisa realizada com sucesso!");
					die();
				}else{
					$assets->error("Problema ao completar pesquisa");
				}
			}
			
		}
		?>
		</div>
</div>		
		<div class="modal fade" id="sobre">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Desenvolvido Por</h4>
		      </div>
		      <div class="modal-body">
		        <h3>Matheus Gon&ccedil;alves da Silva</h3>
		        <p>Formas de contato</p>
		        <ul>
		        	<li>matheus.g.silva@hotmail.com</li>
		        </ul>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<a href="" data-toggle="modal" data-target="#sobre">Matheus Silva</a>
</body>
</html>
