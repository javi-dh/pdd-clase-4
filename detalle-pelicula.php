<?php
	require_once 'connection.php';

	$id = $_GET['idMovie'];

	$movieStmt = $conn->prepare("
		SELECT *
		FROM movies
		WHERE id = :id;
	");

	$movieStmt->bindValue(':id', $id, PDO::PARAM_INT);

	$movieStmt->execute();

	$movieResult = $movieStmt->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<h1>Título: <?php echo $movieResult->title ?></h1>
		<p><b>Rating:</b> <?php echo $movieResult->rating ?></p>
		<p><b>Awards:</b> <?php echo $movieResult->awards ?></p>
		<p><b>Length:</b> <?php echo $movieResult->length ?></p>
		<a href="listado-peliculas.php">[volver]</a>
	</body>
</html>
