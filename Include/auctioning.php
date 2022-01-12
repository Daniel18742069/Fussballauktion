<table id="auctioning">
	<thead>
		<th>Spieler</th>
		<th>Geboten</th>
	</thead>
	<?php foreach (CONTENT['Team']['Auctions'] as $Auctions) : ?>
		<tr>
			<td><?= $Auctions['player']; ?></td>
			<td><?= $Auctions['amount'] . " Mio. €"; ?></td>
		</tr>
	<?php endforeach; ?>
</table>