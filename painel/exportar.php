<!Doctype>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<script src="../js/jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/bootstrap.min.js"></script>
	<link href="../css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="../js/bootstrap-toggle.min.js"></script>
	<link rel="stylesheet" href="../css/painel.css" />
	<title>Exportar Dados</title>
</head>
<body>
		<?php include ("menu.php");?>
	<div class="content-fluid conteudo">
		<div class="row">
			<div class="col-md-12">
			<form method="post" action="gera-csv.php">
			<legend>Per&iacute;odo</legend>
				<label for="">
					<span>De</span>
					<input type="text" name="dataInicio" style="width:100px;" />
				</label>
				<label for="">
					<span>At&eacute;</span>
					<input type="text" name="dataFinal" style="width:100px;" />
				</label>
				<br />
				<input type="submit" value="Exportar" class="btn btn-default"  />
			</form>

			</div>	
		</div>
		
		
	</div>
</body>
</html>
