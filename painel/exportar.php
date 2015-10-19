<!Doctype>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jmask.js"></script>
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<script type="text/javascript">
		$(document).ready(function(){
			$('.calendar').mask('9999-99');
		});
	</script>

	<title>Exportar Dados</title>
	<link rel="stylesheet" href="../css/painel.css" />

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
					<input type="text" name="dataInicio" style="width:100px;" class="calendar"/>
				</label>
				<label for="">
					<span>At&eacute;</span>
					<input type="text" name="dataFinal" style="width:100px;" class="calendar"/>
				</label>
				<br />
				<input type="submit" value="Exportar" class="btn btn-default"  />
			</form>

			</div>	
		</div>
		
		
	</div>
</body>
</html>
