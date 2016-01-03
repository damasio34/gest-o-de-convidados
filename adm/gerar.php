<?php

	require '../database.php';

	$codigo = Database::geraSenha(5, true, true);

	if ($_GET['gerar'] == 's' && $_GET['id'] != null) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE convidados SET codigo = ? where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($codigo,$_GET['id']));
		Database::disconnect();
		header("Location: index.php");
	}
?>
