<?php
try {
	$pdo = new PDO("mysql:dbname=projeto_rating;host=localhost", "root", "root");
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}
//lista os filmes
$sql = "SELECT * FROM filmes";
$sql = $pdo->query($sql);
if($sql->rowCount() > 0) {
	foreach($sql->fetchAll() as $filme):
	?>
	<fieldset>
		<strong><?php echo $filme['titulo']; ?></strong><br/>
		<!--cada estrela é um valor que vai de 1 a 5 -->
		<a href="votar.php?id=<?php echo $filme['id']; ?>&voto=1"><img src="star.png" height="20" /></a>
		<a href="votar.php?id=<?php echo $filme['id']; ?>&voto=2"><img src="star.png" height="20" /></a>
		<a href="votar.php?id=<?php echo $filme['id']; ?>&voto=3"><img src="star.png" height="20" /></a>
		<a href="votar.php?id=<?php echo $filme['id']; ?>&voto=4"><img src="star.png" height="20" /></a>
		<a href="votar.php?id=<?php echo $filme['id']; ?>&voto=5"><img src="star.png" height="20" /></a>

		<!-- exibe a media-->
		( <?php echo $filme['media']; ?> )
	</fieldset>
	<?php
	endforeach;
} else {
	echo "Não há filmes cadastrados!";
}