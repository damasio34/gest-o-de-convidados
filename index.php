<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
		<div class="span10 offset1">
			<div class="row">
    			<h3>Login</h3>
    		</div>
			<form class="form-horizontal" action="efetuarlogin.php" method="post">
			  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
			    <label class="control-label">Usuário</label>
			    <div class="controls">
			      	<input name="usuario" type="text"  placeholder="Informe o usuario" value="<?php echo !empty($usuario)?$usuario:'';?>">
			      	<?php if (!empty($usuarioError)): ?>
			      		<span class="help-inline"><?php echo $usuarioError;?></span>
			      	<?php endif; ?>
			    </div>
			  </div>
			  <div class="control-group <?php echo !empty($senhaError)?'error':'';?>">
			    <label class="control-label">Senha</label>
			    <div class="controls">
			      	<input name="senha" type="password" placeholder="informe a senha" value="<?php echo !empty($senha)?$senha:'';?>">
			      		<span class="help-inline"><?php echo $emailError;?></span>
			    </div>
			  </div>
			  <div class="form-actions">
				  <button type="submit" class="btn btn-success">Entrar</button>
				</div>
			</form>
		</div>
    </div> <!-- /container -->
  </body>
</html>