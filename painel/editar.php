<?php include_once "../classes/autoload.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="../css/painel.css" />
	<title>Editar Pergunta</title>

</head>
<body>
		<?php include("menu.php");?>
	<div class="content-fluid conteudo">
		<div class="row">
			<div class="col-md-12">
			<form action="" method="post">
				<?php
					$perguntaid = (isset($_GET['id_pergunta'])) ? $_GET['id_pergunta'] : null;
					$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
					$query = $pdoVar->query("SELECT * FROM perguntas WHERE id = $perguntaid");
					while($resultado = $query->fetch(PDO::FETCH_ASSOC)){
						echo '<label for="">
								<span>Pergunta: </span>
									<input type="text" name="pergunta" value="'.$resultado['titulo'].'" />
								</label>';
						if($resultado['status'] == 0){
							echo '<label> <input type="radio" value="0" name="status" checked="checked" />Desativado</label>';
							echo '<label> <input type="radio" value="1" name="status" />Ativado</label>';
						}else{
							echo '<label> <input type="radio" value="0" name="status"/>Desativado</label>';
							echo '<label> <input type="radio" value="1" name="status"  checked="checked" />Ativado</label>';
						}
					}
				?>
				
				<div id="pergunta-extra"></div>
				<input type="submit" value="Cadastrar" />
				<input type="hidden" name="acao" value="enviar" />
			</form>
				<?php if(isset($_POST['acao']) && $_POST['acao'] == 'enviar'){
				
				$Perg = new Pergunta($_POST['pergunta'], $_POST['status'], $pdoVar);
				$inserção = $Perg->insere();
				$asset = new assets();
				if($inserção){
					$asset->sucesso("Pergunta editada com sucesso");
				}else{
					$asset->error("Erro ao editar pergunta");
				}

			}
			?>
		</div>
	</div>
</body>
</html>