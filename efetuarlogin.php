<?php 
	require 'database.php';
	$id = null;
	if (!empty($_GET['usuario']) && !empty($_GET['senha'])) {
		$usuario = $_REQUEST['usuario'];
		$senha = $_REQUEST['senha'];
	}

	if ( null==$usuario || null==$senha) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT id, nivel FROM usuarios where usuario = ? and senha = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($usuario, $senha));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
		$perfil = array("id" => $data['id'], "usuario" => $usuario, "senha" => $senha, "nivel" => $data['nivel']);
		session_start(); // Inicia a sessão
		$_SESSION['perfil'] = $perfil;
		//echo $_SESSION['perfil']["usuario"];
		header("Location: adm/index.php");
	}
?>