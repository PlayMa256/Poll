<?php include_once "../classes/autoload.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script src="../js/jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/bootstrap.min.js"></script>
	<link href="../css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="../js/bootstrap-toggle.min.js"></script>
	<link rel="stylesheet" href="../css/painel.css" />
	
	<link rel="stylesheet" href="../css/painel.css" />
	<title>Editar Pergunta</title>
</head>
<body>
		<?php include("menu.php");?>
	<div class="content-fluid conteudo">
		<div class="row">
			<div class="col-md-12">
				<form action="" method="post">
				<legend>Editar Pergunta</legend>
					<?php
					
						$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
								$pergunta = new Pergunta("", "", $pdoVar);
								$assets = new assets();
									if(!$pergunta->verificaPergEmResultados($pergunta_id)){
										$assets->alert_warning("Pergunta vinculada a resposta, n&atilde;o pode ser alterada");
										exit();
									}
																
						$perguntaid = (isset($_GET['id_pergunta'])) ? $_GET['id_pergunta'] : null;
						$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
						$query = $pdoVar->query("SELECT * FROM perguntas WHERE id = $perguntaid");
						while($resultado = $query->fetch(PDO::FETCH_ASSOC)){
							echo '<label for="">
									<span>Pergunta</span>
										<input type="text" class="titulo" name="pergunta" value="'.$resultado['titulo'].'" />
									</label>';
							echo '<br/>';
							$statusChecked = ($resultado['status'] == 1) ? "checked" : "";
							echo '<br />';
						}
								
					?>
					<input type="submit" class="btn btn-default"value="Cadastrar" />
					<input type="hidden" name="acao" value="enviar" />
				</form>
				<?php if(isset($_POST['acao']) && $_POST['acao'] == 'enviar'){
				$titulo = $_POST['pergunta'];
				$update = $pdoVar->prepare("UPDATE perguntas SET titulo = ? WHERE id = ?");
				$update->bindParam(1, $titulo);
				$update->bindParam(2, $perguntaid);
				$result = $update->execute();
				$asset = new assets();
				if($result > 0){
					$asset->sucesso("Pergunta editada com sucesso");
					sleep(3);
					echo '<script>location.href="gerenciar_perguntas.php";</script>';

				}else{
					$asset->error("Erro ao editar pergunta");
				}

			}
			?>
		</div>
	</div>
</body>
</html>
