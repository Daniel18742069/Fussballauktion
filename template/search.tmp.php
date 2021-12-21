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
	</header>

	<main>
		<?php
		?>
		<!--Errormessage-->
		<?php if (isset(CONTENT['Error'])) : ?>

			<p id="error_message">
				<?= CONTENT['Error']; ?>
			</p>

		<?php else : ?>

			<h1>Spieler:</h1>
			<table>

				<thead>
					<th>Name</th>
					<th>Position</th>
					<th>Team</th>
				</thead>

				<!--Search Output-->
				<?php foreach (CONTENT['Players'] as $Player) : ?>

					<tr>
						<td>
							<a href="index.php?act=player&index=<?= $Player['index']; ?>">
								<?= $Player['name']; ?>
							</a>
						</td>
						<td>
							<?= $Player['position']; ?>
						</td>
						<td>
							<?= $Player['team']; ?>
						</td>
					</tr>

				<?php endforeach; ?>
			</table>

		<?php endif; ?>
	</main>
</body>

</html>