<?php
	require_once 'autoload.php';

	$allMoviesResult = $dbMovies->getAllMovies();
	$total = $dbMovies->totalRows($allMoviesResult);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Listado de películas</title>
	</head>
	<body>
		<h2>Listado de películas (total: <?= $total ?>)</h2>
		<a href="agregarPelicula.php">CREAR NUEVA PELÍCULA</a>
		<ul>
			<?php foreach ($allMoviesResult as $oneMovie): ?>
				<li>
					<b>Título:</b> <?php echo $oneMovie->title ?> /
					<b>Rating:</b> <?php echo $oneMovie->rating ?>
					<a
						href="detalle-pelicula.php?idMovie=<?php echo $oneMovie->id ?>"
					>
						[ver detalle]
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</body>
</html>
