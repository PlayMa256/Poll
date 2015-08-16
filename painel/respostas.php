<?php include_once "../classes/autoload.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../js/data_tables.js"></script>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../css/data_tables.css" />
		<link rel="stylesheet" href="../css/painel.css" />
	<script>
		$(document).ready(function() {
		    $('#minhatablea').DataTable();
		} );
	</script>
	<title></title>

</head>
<body>
		<?php include ("menu.php");?>
	<div class="content-fluid conteudo">
		<div class="row">
			<div class="col-md-12">
				<div id="conteudodentro">
					<h3>Consultar Resultados</h3>
					<table class="tabela" id="minhatablea">
					<thead>
						<th>Ticket</th>
						<th>A&ccedil;&atilde;o</th>
					</thead>
						<?php 
							$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
							$query = $pdoVar->query("SELECT id_ticket FROM resultados");
							while($resultado = $query->fetch(PDO::FETCH_ASSOC)){
								echo '<tr><td>'.$resultado['id_ticket'].'</td>
								<td><a href="ver_respostas.php?id_ticket='.$resultado['id_ticket'].'">Ver resposta</a></td>
								</tr>';
							}
						?>

					

					</table>	
				</div>
				
			</div>	
		</div>
	</div>
</body>
</html>