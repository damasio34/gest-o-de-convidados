<?php 
	
	require '../database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$emailError = null;
		$mobileError = null;
		
		// keep track post values
		$nome = $_POST['nome'];
		$codigo = Database::geraSenha(5, true, true);
		$referencia = NULL;//$_POST['referencia'];
		
		// validate input
		$valid = true;
		if (empty($nome)) {
			$nameError = 'Please enter nome';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO convidados (nome,codigo,referencia) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($nome,$codigo,$referencia));
			Database::disconnect();
			header("Location: index.php");
		}
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
		<div class="span10 offset1">
			<div class="row">
    			<h3>Cadastro de convidados</h3>
    		</div>
			<form class="form-horizontal" action="adicionar_convidado.php" method="post">
			  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
			    <label class="control-label">Nome</label>
			    <div class="controls">
			      	<input name="nome" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
			      	<?php if (!empty($nameError)): ?>
			      		<span class="help-inline"><?php echo $nameError;?></span>
			      	<?php endif; ?>
			    </div>
			  </div>
			  <!--
			  <div class="control-group <?php /*echo !empty($emailError)?'error':'';*/?>">
			    <label class="control-label">Referência</label>
			    <div class="controls">
			      	<input name="email" type="text" placeholder="Email Address" value="<?php /*echo !empty($email)?$email:'';*/?>">
			      	<?php /*if (!empty($emailError)): */?>
			      		<span class="help-inline"><?/*php echo $emailError;*/?></span>
			      	<?php /*endif;*/?>
			    </div>
			  </div>
			  -->
			  <div class="form-actions">
				  <button type="submit" class="btn btn-success">Adicionar</button>
				  <a class="btn" href="index.php">Voltar</a>
				</div>
			</form>
		</div>
    </div> <!-- /container -->
  </body>
</html>