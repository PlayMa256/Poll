<?php include_once "../classes/Connection.php";include_once "../classes/autoload.php";?>
<!DOCTYPE>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../css/painel.css" />
	<title>Respostas</title>
	<style type="text/css">
		#content{
			width:800px;
		}
		.box2{
			width: 100%;
			background: #e0e0e0;
			padding: 3px;
			border-radius: 3px;
			box-shadow: inset 0 1px 3px rgba (0,0,0,.2);


		}
		.conteudodabox{
			display: block;
			height: 22px;
			background: #659cef;
			border-radius: 3px;
			transition: width 500ms ease-in-out;

		}
	</style>
</head>
<body>
<?php include ("menu.php");?>
	<div class="content-fluid conteudo">

		<div class="row">
			<div class="col-md-12">
				<h3>Repostas do ticket <?php echo $_GET['id_ticket']; ?></h3>
				<table class="table table-bordered tabela ">
				
						<?php
							$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
							$query = $pdoVar->prepare("SELECT * FROM resultados WHERE id_ticket = ?");
							$query->bindParam(1, $_GET['id_ticket']);
							$query->execute();
							while($resultado = $query->fetch(PDO::FETCH_ASSOC)){
								$perguntas = $resultado['perguntas'];
								$perguntaExplode = explode("|", $perguntas);
								echo "<tr>";
								foreach($perguntaExplode as $p){
									$pergunta = new Pergunta("", "", $pdoVar);
									$titulo = $pergunta->trazer_title($p);


									echo "<th>$titulo</th>";
								}
								echo "</tr>";
								$resultados = $resultado['resposta'];
								$respostaExplode = explode("|", $resultados);
								echo "<tr>";
								foreach($respostaExplode as $r){
									echo "<td>$r</td>";
								}
								echo "</tr>";

							}

							
						?>
				

				</table>
			</div>
		</div>
	</div>
</body>
