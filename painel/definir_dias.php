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
		    $('#minhatablea').DataTable({
		    	"oLanguage": {
      				"sSearch": "Pesquisar: "
    			}
		    });
		} );
	</script>
	<title></title>

</head>
<body>
	<?php include ("menu.php");?>
	<div class="content conteudo">
		<div class="row">
			<div class="col-md-12">
				<?php
					$arquivo2 = "arquivo.txt";
					$dados = file_get_contents($arquivo2);

					echo "<h1>Tempo Definido: $dados</h1>";

				?>
				<form method="post">
					<legend>Definir numero de dias</legend>
					<label>
						<span>N&uacute;mero de dias</span>
						<input type="text" name="dias" />
					</label>
					<input type="submit" value="Enviar" />
					<input type="hidden" name="acao" value="enviar" />
				</form>					
				<?php if(isset($_POST['acao']) && $_POST['acao'] == 'enviar'){
					$arquivo = "arquivo.txt";
					$string = trim($_POST['dias']);
					if(file_put_contents($arquivo, $string)){
						$assert = new assets();
						$assert->sucesso("Arquivo editado");
						echo '<script>location.href="definir_dias.php";</script>';
					}


				}


				?>
			</div>
		</div>
	</div>
</body>
</html>
