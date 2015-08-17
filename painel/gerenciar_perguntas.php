<?php include_once "../classes/Connection.php";include_once "../classes/autoload.php";?>
<!DOCTYPE>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script src="../js/jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/bootstrap.min.js"></script>
	<link href="../css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="../js/bootstrap-toggle.min.js"></script>
	<link rel="stylesheet" href="../css/painel.css" />
	<title>Gerenciar Perguntas</title>
	<script type="text/javascript">
		$(function(){
			$('.chbox').change(function() {
     			 $.post("../func/change_status.php", {pergunta : $(this).val()}, function(data){
     			 	//console.log(data);
     			 });
   			 });
			$(".env").click(function(){
				$.post("../func/insert_questions.php", {titulo: $("#title").val()}, function(data){
					if(data == 1){
						$('.modal-body').append("<div class=\"isa_success\">Cadastrado com sucesso</div>");
						setTimeout(function() {
							$('#myModal').modal('hide');
							location.reload();
						}, 3000);
					}else{
						$('#myModal').append("<div class=\"isa_error\">Erro ao cadastrar</div>");
					}

				});
			});
		});

	</script>

</head>
<body>
	<?php include ("menu.php");?>
	<div class="content-fluid conteudo">

		<div class="row">
			<div class="col-md-12">
				<div id="conteudodentro">
				<!-- Button trigger modal -->
				<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">Cadastrar Pergunta</h4>
					      </div>
					      <div class="modal-body">
		        			<span>T&iacute;tulo</span>
		        			<input type="text" name="titulo" id="title" />
		        			<button class="btn btn-default env">Cadastrar</button>
					      </div>
					    </div>
					  </div>
					</div>

					<h3>Gerenciar Perguntas</h3>

					<a href="#" class="glyphicon glyphicon-plus abrir" data-toggle="modal" data-target="#myModal"></a>
					
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
									<input data-toggle="toggle" data-on="Ativo" data-off="Inativo" value="<?php echo $result['id'];?>" class="chbox" type="checkbox" <?php 
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
									$assets = new assets();
									$assets->alert_sucesso("Apagado com sucesso");
									sleep(2000);
									echo '<script>location.reload();</script>';
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
	</div>
</body>
</html>