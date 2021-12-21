<!DOCTYPE html>
<html>

<body>
	<header>
		<!--Website Logo-->
		<h1>
			<a href="index.php">Football Maniacs!</a>
		</h1>

		<!--Searchbar-->
		<form action="index.php" method="get">
			<input name="act" type="hidden" value="search" />
			<input id="searchbar" name="name" type="text" placeholder="Spieler Suchen" />
			<input name="submit" type="submit" />
		</form>

		<!--Logout/Login-->
		<?php if (isset($_SESSION['user'])) : ?>

			<!--Logout-->
			<form action="index.php" method="post">
				<input name="act" type="hidden" value="logout" />
				<input name="submit" type="submit" value="Ausloggen" />
			</form>

		<?php else : ?>

			<!--Login-->
			<form action="index.php" method="post">
				<input name="act" type="hidden" value="login" />
				<input id="username" name="name" type="text" placeholder="benutzername" />
				<input id="password" name="pass" type="password" placeholder="passwort" />
				<input name="submit" type="submit" value="Einloggen" />
			</form>
		<?php endif; ?>
	</header>

	<main>
		<!--Errormessage-->
		<?php if (isset(CONTENT['Error'])) : ?>

			<p id="error_message">
				<?= CONTENT['Error']; ?>
			</p>

		<?php else : ?>

			<h2>Spieler:</h2>
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
				<input name="submit" type="submit" value="Bieten" />
			</form>

		<?php endif; ?>
	</main>
</body>

</html>