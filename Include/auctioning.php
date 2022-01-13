<table>
	<thead>
		<th>Spieler</th>
		<th>Geboten</th>
	</thead>
	<?php foreach (CONTENT['Team']['Auctions'] as $Auctions) : ?>
		<tr class="team-player" onclick="window.location='index.php?act=player&index=<?= $Auctions['player']; ?>'">
			<td><?= $Auctions['name']; ?></td>
			<td><?= $Auctions['amount'] . " Mio. €"; ?></td>
			<td class="auction-warning"><?php if ($Auctions['losing']) : ?>&#9888;<?php endif; ?></td>
		</tr>
	<?php endforeach; ?>
</table>