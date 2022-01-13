<table>
	<thead>
		<th>Spieler</th>
		<th>Geboten</th>
	</thead>
	<?php foreach (CONTENT['Team']['Auctions'] as $Auctions) : ?>
		<tr class="team-player" onclick="window.location='index.php?act=player&index=<?= $Auctions['player']; ?>'">
			<td><?= $Auctions['name']; ?></td>
			<td><?= $Auctions['amount'] . " Mio. €"; ?></td>
		</tr>
	<?php endforeach; ?>
</table>