<table id="auctioning">
	<thead>
		<th>Spieler</th>
		<th>Investiert</th>
	</thead>
	<?php foreach (CONTENT['Team']['Auctions'] as $Auctions) : ?>
		<tr>
			<td><?= $Auctions['player']; ?></td>
			<td><?= $Auctions['amount']; ?></td>
		</tr>
	<?php endforeach; ?>
</table>