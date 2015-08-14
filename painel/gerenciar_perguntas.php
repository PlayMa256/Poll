<?php include_once "../classes/Connection.php";include_once "../classes/autoload.php";?>
<!DOCTYPE>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
	<link rel="stylesheet" href="../css/painel.css" />
	<title>Gerenciar Perguntas</title>
	<script type="text/javascript">
		$(function(){
			$('.chbox').change(function() {
     			 $.post("../func/change_status.php", {pergunta : $(this).val()}, function(data){
     			 	console.log(data);
     			 });
   			 })
		});

	</script>

</head>
<body>
	<?php include ("menu.php");?>
	<div class="content-fluid conteudo">

		<div class="row">
			<div class="col-md-12">
				<h3>Gerenciar Perguntas</h3>
				<table width="" class="table  table-bordered tabela">
					<tr>
						<th>Pergunta</th>
						<th colspan="2">A&ccedil;&atilde;o</th>
					</tr>
				<?php
						$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
						$resultados = $pdoVar->query("SELECT DISTINCT * FROM perguntas");
						while($result = $resultados->fetch(PDO::FETCH_ASSOC)){			
						?>
						<tr>
							<td><a href="editar.php?id_pergunta=<?php echo $result['id'];?>"><?php echo $result['titulo'];?></a></td>
							<td><a href="?acao=remover&id_pergunta=<?php echo $result['id'];?>"><span class="glyphicon glyphicon-trash"></span></a></td>
							<td>
								<input data-toggle="toggle" data-on="Ativo" data-off="Inativo" value="<?php echo $result['id']."|".$result['status'];?>" class="chbox" type="checkbox" <?php 
									if($result['status'] == 1){
										echo 'checked';
									}elseif($result['status'] == 0){
										echo '';
									}
								?>>
    						</td>
						</tr>
					<?php		
						}

						if(isset($_GET['acao']) && $_GET['acao'] == 'remover'){
							$pergunta_id = (isset($_GET['id_pergunta'])) ? $_GET['id_pergunta'] : null;

							$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
							$pergunta = new Pergunta("", "", $pdoVar);
							if($pergunta->remover($pergunta_id)){
								//echo '<script>alert("Apagado com sucesso");location.href="gerenciar_perguntas.php";</script>';
								//echo 'foi';
								$assets = new assets();
								$assets->alert_sucesso("Apagado com sucesso");
							}else{
								$assets->alert_warning("Erro ao apagar");
							}
						}
						if(isset($_GET['acao']) && $_GET['acao'] == 'status'){

						}
					?>

					
						
					</tr>
				</table>
			</div>	
		</div>
	</div>
</body>
</html>