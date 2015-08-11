<?php include '../config/config.php';include_once "../classes/poll.php";include_once "../classes/Connection.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title></title>

</head>

<body>
	<div id="box">
		<div id="content">
			<form action="" method="post">
				<label for="">
					<span>Nome: </span>
					<input type="text" name="nome" id="" />
				</label>
				<input type="hidden" name="acao" value="enviar" />
				<input type="submit" value="Cadastrar" />
			</form>
			<?php if(isset($_POST['acao']) && $_POST['acao'] == 'enviar'){
				$titulo = $_POST['nome'];
				$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
				$poll = Polls($titulo, $pdoVar);
				$inserir = $poll->inserir();
				if($inserir){
					echo '<div class="isa_success">Pesquisa cadastrada com sucesso</div>';
				}else{
					echo '<div class="isa_error">Erro ao cadastrar pesquisa</div>';
				}
			}
			?>
		</div>
	</div>
	
</body>
</html>