<?php

/**
 * @author Andreas Codalonga
 */
class Auction
{
	private int $index;
	private string $team;
	private string $player;
	private int $amount;

	private function __construct($index, $team, $player, $amount)
	{
		$this->index = $index;
		$this->name = $team;
		$this->position = $player;
		$this->team = $amount;
	}

	public function get_index(): int
	{
		return $this->index;
	}

	public function get_team(): int
	{
		return $this->team;
	}

	public function get_player(): int
	{
		return $this->first_player;
	}

	public function get_amount(): int
	{
		return $this->last_name;
	}

	public function get_all(): array
	{
		return [
			'index' => $this->index,
			'team' => $this->team,
			'player' => $this->player,
			'amount' => $this->amount
		];
	}

	/**
	 * Returns all Auctions
	 */
	public static function all(): array
	{
		$query = 'SELECT
		id AS `index`,
		`team`,
		`player`,
		`amount`
		FROM auctions;';

		$db = Database::open();
		$results = $db->query($query, true)->fetch_all(MYSQLI_ASSOC);
		$db->close();

		$Auctions = [];

		foreach ($results as $result) {
			$Auctions[$result['index']] = new Auction(
				$result['index'],
				$result['team'],
				$result['player'],
				$result['amount']
			);
		}

		return $Auctions;
	}

	/**
	 * Returns Player from index
	 */
	public static function get(int $index): Auction|null
	{
		$query = 'SELECT
		id AS `index`,
		`team`,
		`player`,
		`amount`
		FROM auctions
		WHERE
		`id` = ' . $index . ';';

		$db = Database::open();
		$result = $db->query($query, true)->fetch_array(MYSQLI_ASSOC);
		$db->close();

		$Auction = new Auction(
			$result['index'],
			$result['team'],
			$result['player'],
			$result['amount']
		);

		return $Auction;
	}

	public static function player(int $player): Auction|null
	{
		$query = 'SELECT
		id AS `index`,
		`team`,
		`player`,
		`amount`
		FROM auctions
		WHERE
		`player` = ' . $player . '
		ORDER BY `amount` DESC
		LIMIT 1;';

		$db = Database::open();
		$result = $db->query($query, true)->fetch_array(MYSQLI_ASSOC);
		$db->close();

		$Auction = new Auction(
			$result['index'],
			$result['team'],
			$result['player'],
			$result['amount']
		);

		return $Auction;
	}

	public static function team(int $player, int $team): Auction|null
	{
		$query = 'SELECT
		id AS `index`,
		`team`,
		`player`,
		`amount`
		FROM auctions
		WHERE
		`player` = ' . $player . '
		AND `team` = ' . $team . '
		ORDER BY `amount` DESC
		LIMIT 1;';

		$db = Database::open();
		$result = $db->query($query, true)->fetch_array(MYSQLI_ASSOC);
		$db->close();

		$Auction = new Auction(
			$result['index'],
			$result['team'],
			$result['player'],
			$result['amount']
		);

		return $Auction;
	}

	public function auction(int $team): void
	{
		$query = 'INSERT
		INTO `auctions` (
		`team`,
		`player`,
		`amount`
		) VALUES (
		' . $this->player . ',
		' . $team . ',
		' . ++$this->amount . '
		);';

		$db = Database::open();
		$db->query($query, false)->fetch_array(MYSQLI_ASSOC);
		$db->close();
	}
}
