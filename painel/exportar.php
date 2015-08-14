<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-2.1.4.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../css/painel.css" />
	<title>Exportar Dados</title>
</head>
<body>
		<?php include ("menu.php");?>
	<div class="content-fluid conteudo">
		<div class="row">
			<div class="col-md-12">
				
		<h1>Per&iacute;odo</h1>
			<form method="post" action="gera-csv.php">
				<label for="">
					<span>De:</span>
					<input type="text" name="dataInicio" />
				</label>
				<label for="">
					<span>At&eacute;:</span>
					<input type="text" name="dataFinal" />
				</label>
				<input type="submit" value="Exportar" class="btn btn-default" />
			</form>

			</div>	
		</div>
		
		
	</div>
</body>
</html>
