<?php include_once "../classes/Connection.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title></title>

</head>

<body>
	<div id="box">
		<div id="content">
			<table width="100%">
				<?php
					$pdoVar = new PDO("mysql:host=$endereco;dbname=$banco", $usuario, $senha);
					$resultados = $pdoVar->query("SELECT DISTINCT id_ticket FROM resultados");
					while($result = $resultados->fetch(PDO::FETCH_ASSOC)){			
					?>
					<tr>
						<td><?php echo $result['id_ticket'];?></td>
						<td><a href="ver_respostas.php?id_ticket=<?php echo $result['id_ticket'];?>">Ver Resultados</a></td>
					</tr>
				<?php		
					}
				?>
				
					
				</tr>
			</table>
		</div>
	</div>		
</body>
</html>