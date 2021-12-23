<!DOCTYPE html>
<html>

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

			<!--Auction Progress-->
			<?php if (isset(CONTENT['Auctions'])) : ?>
				<table>

					<thead>
						<th></th>
						<th>Team</th>
						<th>Angebot</th>
					</thead>

					<tr>
						<td>Höchster Bieter:</td>
						<td>
							<?= CONTENT['Auctions']['current']['team']; ?>
						</td>
						<td>
							<?= CONTENT['Auctions']['current']['amount']; ?> Millionen
						</td>
					</tr>

					<?php if (isset(CONTENT['Auctions']['user'])) : ?>

						<tr>
							<td>Ihre Bietung:</td>
							<td>
								<?= CONTENT['Auctions']['user']['team']; ?>
							</td>
							<td>
								<?= CONTENT['Auctions']['user']['amount']; ?> Millionen
							</td>
						</tr>

					<?php endif; ?>

				</table>
			<?php endif; ?>

		<?php endif; ?>
	</main>
</body>

</html>