<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/index.css" media="screen" />
  <title>Sign in</title>
</head>

<body>
	<header>
		<!--Website Logo-->
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
			<?php include 'Include/login.html'; ?>
		<?php endif; ?>
	</header>

	<main>
		<h2>Spieler:</h2>
		<table>

			<thead>
				<th>Name</th>
				<th>Position</th>
				<th>Team</th>
				<th>Wert</th>
			</thead>

			<!--Display all Players-->
			<?php foreach (CONTENT['Players'] as $Player) : ?>

				<tr>
					<td>
						<a href=" index.php?act=player&index=<?= $Player['index']; ?>">
							<?= $Player['name']; ?>
						</a>
					</td>
					<td>
						<?= $Player['position']; ?>
					</td>
					<td>
						<?= $Player['team']; ?>
					</td>
					<td>
						<?= $Player['worth']; ?>
					</td>
				</tr>

			<?php endforeach; ?>
		</table>
	</main>
</body>

</html>