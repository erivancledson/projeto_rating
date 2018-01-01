<?php
try {
	$pdo = new PDO("mysql:dbname=projeto_rating;host=localhost", "root", "root");
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}
// se não tiver vazio o id e o voto ele entra
if(!empty($_GET['id']) && !empty($_GET['voto'])) {
	//guarda o id e o voto
	$id = intval($_GET['id']);
	$voto = intval($_GET['voto']);
     //verifica se o foto está entre 1 e 5
	if($voto >= 1 && $voto <= 5) {
        //salvando o voto
		$sql = $pdo->prepare("INSERT INTO votos SET id_filme = :id_filme, nota = :nota");
		$sql->bindValue(":id_filme", $id);
		$sql->bindValue(":nota", $voto);
		$sql->execute();
         //atualiza a media do filme
		//sub query para fazer o calculo da media
		$sql = "UPDATE filmes SET media = (select (SUM(nota)/COUNT(*)) from votos where votos.id_filme = filmes.id) WHERE id = :id";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		header("Location: index.php");
		exit;

	}
}