<!DOCTYPE html>
<html>

<body>
	<header>

		<!--Searchbar-->
		<form action="index.php" method="get">
			<input name="act" type="hidden" value="search" />
			<input id="searchbar" name="name" type="text" placeholder="Spieler Suchen" />
			<input name="submit" type="submit" />
		</form>
	</header>

	<main>
		<!--Errormessage-->
		<?php if (isset(CONTENT['Error'])) : ?>
			<p id="error_message">
				<?= CONTENT['Error']; ?>
			</p>

		<!--Search Output-->
		<?php else : ?>
			<h1>Spieler:</h1>
			<table>
				<thead>
					<th>Name</th>
					<th>Position</th>
					<th>Team</th>
				</thead>
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