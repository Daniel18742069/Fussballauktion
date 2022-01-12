<!DOCTYPE html>
<html class="html-index">

<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
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
								<?= $Player['worth']; ?> Mio. €
							</div>
						</li>
					<?php endforeach; ?>
				</ul>

			</div>

		</table>

	</main>

	<div id="block">
	<?php if (isset(CONTENT['Team']['Auctions'])) :
		include 'Include/auctioning.php';
	endif; ?>
	</div>

	<footer>
		<ul>
			<li>
				<a class="facebook" href="https://downloadmoreram.com">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<i class="fa fa-facebook-square" aria-hidden="true"></i>
				</a>
			</li>
			<li>
				<a class="twitter" href="https://twitter.com/rickastley?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<i class="fa fa-twitter" aria-hidden="true"></i>
				</a>
			</li>
			<li>
				<a class="instagram" href="https://www.instagram.com/officialrickastley/?hl=de">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<i class="fa fa-instagram" aria-hidden="true"></i>
				</a>
			</li>
			<li>
				<a class="youtube" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<i class="fa fa-youtube" aria-hidden="true"></i>
				</a>
			</li>
		</ul>

		<p class="logged-in-as">Eingeloggt als <?= CONTENT['Team']['name']; ?></p>
		

	</footer>

</body>

</html>