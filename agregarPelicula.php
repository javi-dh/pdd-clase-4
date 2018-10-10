<?php
	require_once 'connection.php';

	//
	$genresStmt = $conn->prepare("SELECT id, name FROM genres");
	$genresStmt->execute();
	$allGenres = $genresStmt->fetchAll(PDO::FETCH_OBJ);

	if ($_POST) {
		$insertStmt = $conn->prepare("
			INSERT INTO movies (
				title,
				rating,
				awards,
				release_date,
				length,
				genre_id
			)
			VALUES (
				:title,
				:rating,
				:awards,
				:release_date,
				:length,
				:genre_id
			)
		");

		$title = trim($_POST['title']);
		$rating = trim($_POST['rating']);
		$awards = trim($_POST['awards']);
		$release_date = $_POST['year']. '-' . $_POST['month'] . '-' . $_POST['day'];
		$length = $_POST['length'];
		$genre_id = $_POST['genre_id'];

		$insertStmt->bindValue(':title', $title, PDO::PARAM_STR);
		$insertStmt->bindValue(':rating', $rating, PDO::PARAM_INT);
		$insertStmt->bindValue(':awards', $awards, PDO::PARAM_INT);
		$insertStmt->bindValue(':release_date', $release_date, PDO::PARAM_STR);
		$insertStmt->bindValue(':length', $length, PDO::PARAM_INT);
		$insertStmt->bindValue(':genre_id', $genre_id, PDO::PARAM_INT);

		$insertStmt->execute();

		header('location: listado-peliculas.php'); exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agregar Pelicula</title>
</head>
<body>
	<form method="post">
		<div>
			<label>Titulo</label>
			<input type="text" name="title" >
		</div>
		<div>
			<label>Rating</label>
			<input type="text" name="rating" >
		</div>
		<div>
			<label>Premios</label>
			<input type="text" name="awards" >
		</div>
		<div>
			<label>Duracion</label>
			<input type="text" name="length" >
		</div>
		<div>
			<label>Fecha de Estreno</label> <br>
			<i>Año: </i>
			<select name="year">
				<?php for ($i=2018; $i >= 1920; $i--) { ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
			<i>Mes: </i>
			<select name="month">
				<?php for ($i=1; $i < 13; $i++) { ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
			<i>Día: </i>
			<select name="day">
				<?php for ($i=1; $i < 32; $i++) { ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
		</div>
		<div>
			<label>Género:</label>
			<select name="genre_id">
				<?php foreach ($allGenres as $oneGenre): ?>
					<option value="<?= $oneGenre->id ?>"> <?= $oneGenre->name ?> </option>
				<?php endforeach; ?>
			</select>
		</div>
		<button type="submit">Guardar película</button>
	</form>
</body>

</html>
