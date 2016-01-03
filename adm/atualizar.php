<?php 
	require '../database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( null==$id ) {
		header("Location: index.php");
	}
	if (!empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$emailError = null;
		$mobileError = null;
		// keep track post values
		$name = $_POST['nome'];
		$referencia = $_POST['referencia'];
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE convidados set nome = ?, referencia = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($nome,$referencia,$id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT nome, referencia, codigo FROM convidados where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['nome'];
		$email = $data['referencia'];
		$mobile = $data['codigo'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
		<div class="span10 offset1">
			<div class="row">
    			<h3>Ataliza convidados</h3>
    		</div>
			<form class="form-horizontal" action="atualizar.php?id=<?php echo $id?>" method="post">
			  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
			    <label class="control-label">Nome</label>
			    <div class="controls">
			      	<input name="nome" type="text"  placeholder="informe o nome" value="<?php echo !empty($name)?$name:'';?>">
			      	<?php if (!empty($nameError)): ?>
			      		<span class="help-inline"><?php echo $nameError;?></span>
			      	<?php endif; ?>
			    </div>
			  </div>
			  <div class="form-actions">
				  <button type="submit" class="btn btn-success">Update</button>
				  <a class="btn" href="index.php">Back</a>
				</div>
			</form>
		</div>
    </div> <!-- /container -->
  </body>
</html>