<!DOCTYPE html>
<html class="html-player">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/index.css" media="screen" />
	<title>Fussballauktion</title>
</head>

<body class="body-player">
	<header>
		<!--Website Logo-->
		<a href="index.php" class="logo"><img src="Bilder/header.png" alt="Football Maniacs!"></a>

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

	<main class="main-player">
		<!--Errormessage-->
		<?php if (isset(CONTENT['Error'])) : ?>

			<p id="error_message">
				<?= CONTENT['Error']; ?>
			</p>

		<?php else : ?>

			<div class="player-image">
				<img style="-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" src="<?= CONTENT['Player']['picture']; ?>">
			</div>

			<table>

				<thead>
					<th>Name</th>
					<th>Position</th>
					<th>Team</th>
				</thead>

				<!--Display Player-->
				<tr>
					<td>
						<?= CONTENT['Player']['name']; ?>
					</td>
					<td>
						<?= CONTENT['Player']['position']; ?>
					</td>
					<td>
						<?= CONTENT['Player']['team']; ?>
					</td>
				</tr>
			</table>

			<!--Auctioning-->
			<form action="index.php?act=auction" method="post">
				<input name="player" type="hidden" value="<?= CONTENT['Player']['index']; ?>">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<input class="btn-bieten" name="submit" type="submit" value="Bieten" />
			</form>


			<!--Auction Progress-->
			<?php if (isset(CONTENT['Auctions'])) : ?>
				<table>

					<thead>
						<th></th>
						<th>Team</th>
						<th>Wert</th>
					</thead>

					<tr>
						<td>Höchster Bieter:</td>
						<td>
							<?= CONTENT['Auctions']['current']['team']; ?>
						</td>
						<td>
							<?= CONTENT['Auctions']['current']['amount']; ?> Mio. €
						</td>
					</tr>

					<?php if (isset(CONTENT['Auctions']['user'])) : ?>

						<tr>
							<td>Ihr Gebot:</td>
							<td>
								<?= CONTENT['Auctions']['user']['team']; ?>
							</td>
							<td>
								<?= CONTENT['Auctions']['user']['amount']; ?> Mio. €
							</td>
						</tr>

					<?php endif; ?>

				</table>
			<?php endif; ?>

		<?php endif; ?>
	</main>
</body>

</html>