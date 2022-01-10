<!DOCTYPE html>
<html class="html-index">

<head>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/index.css" media="screen" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/index.css" media="screen" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/index.css" media="screen" />
	<title>Fussballauktion</title>
</head>

<body class="body-index">
	<header class="header-index">
		<!--Website Logo-->
		<a href="index.php" class="logo"><img id="logo" src="Bilder/logo.png" alt="Football Maniacs!"></a>

		<!--Searchbar-->
		<?php include 'Include/searchbar.html'; ?>

		<!--Logout/Login-->
		<?php if (isset($_SESSION['user'])) : ?>

			<!--Logout-->
			<?php include 'Include/logout.html'; ?>

		<?php else : ?>

			<!--Login-->
			<?php include 'Include/login.html'; ?>
		<?php endif; ?>


		<!--Dark Mode-->
		<nav>
			<div class="mode-toggle"></div>
			<div class="container">
				<div class="dark-mode"></div>
			</div>

			<script>
				let modeToggle = document.querySelector('.mode-toggle');
				let darkMode = document.querySelector('.dark-mode');

				modeToggle.addEventListener('click', () => {
					darkMode.classList.toggle('active');
					modeToggle.classList.toggle('active');
				})
			</script>

		</nav>
	</header>

	<main>
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


	</main>

</body>

</html>