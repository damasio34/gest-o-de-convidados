<?php
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();

	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['perfil'])) {
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: ../index.php"); exit;
	}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
    		<div class="row">
    			<h3>Convidados</h3>
    		</div>
			<div class="row">
				<p>
					<a href="adicionar_convidado.php" class="btn btn-success">Adicionar convidado</a>
				</p>
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>ID</th>
		                  <th>Nome</th>
		                  <th>Código</th>
		                  <th>Gerênciar</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include '../database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT id, nome, codigo FROM convidados ORDER BY id DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['id'] . '</td>';
							   	echo '<td>'. $row['nome'] . '</td>';
							   	echo '<td>'. $row['codigo'] . '</td>';
							   	echo '<td width=350>';
							   	echo '<a class="btn btn-success" href="gerar.php?id='.$row['id'].'&gerar=s">Gerar código</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn" href="atualizar.php?id='.$row['id'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="apagar.php?id='.$row['id'].'">Delete</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>