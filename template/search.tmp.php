<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
	<link rel="stylesheet" href="css/index.css" media="screen" />
	<title>Searchbar</title>
</head>

<body>
	<header>
		<!--Website Logo-->
		<img src="Bilder/header.png">
		<h1>
			<a href="index.php">Football Maniacs!</a>
		</h1>

		<!--Searchbar-->
		<?php include 'Include/searchbar.html'; ?>

		<!--Logout/Login-->
		<?php if (isset($_SESSION['user'])) : ?>

			<!--Logout-->
			<?php include 'Include/logout.html'; ?>

		<?php else : ?>

			<!--Login-->
			<?php include 'template/login.tmp.php'; ?>
		<?php endif; ?>
	</header>




	<main>
	<!--Errormessage-->
		<?php if (isset(CONTENT['Error'])) : ?>

			<p id="error_message">
				<?= CONTENT['Error']; ?>
			</p>

		<?php else : ?>
		<table>

			<div class="container">
				<ul class="responsive-table">
					<li class="table-header">
						<div class="col col-1">Name</div>
						<div class="col col-2">Position</div>
						<div class="col col-3">Team</div>
						<div class="col col-4">Wert</div>
					</li>

					<?php foreach (CONTENT['Players'] as $Player) : ?>

						<li class="table-row" onclick="window.location='index.php?act=player&index=<?= $Player['index']; ?>'">
							<div class="col col-1">
								<?= $Player['name']; ?>
								</a>
							</div>
							<div class="col col-2">
								<?= $Player['position']; ?>
							</div>
							<div class="col col-3">
								<?= $Player['team']; ?>
							</div>
							<div class="col col-4">
								<?= $Player['worth']; ?>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>

			</div>

		</table>
		<?php endif; ?>

	</main>
	



</body>

</html>