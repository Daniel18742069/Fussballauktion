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
		$this->team = $team;
		$this->player = $player;
		$this->amount = $amount;
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
		return $this->amount;
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

	private function save()
	{
		if ($this::get($this->index)) {
			$query = 'UPDATE
			`auction` SET
			`player` = ' . $this->player . ',
			`team` = ' . $this->team . ',
			`amount` = ' . $this->amount . '
			WHERE
			`id` = ' . $this->index . ';';
		} else {
			$query = 'INSERT INTO
			`auction`(
				`player`,
				`team`,
				`amount`
			) VALUES (
				' . $this->player . ',
				' . $this->team . ',
				' . $this->amount . '
			);';
		}

		$db = Database::open();
		$db->query($query, false);
		$db->close();
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

		if ($result) {
			$Auction = new Auction(
				$result['index'],
				$result['team'],
				$result['player'],
				$result['amount']
			);
		} else {
			return NULL;
		}

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

		if ($result) {
			$Auction = new Auction(
				$result['index'],
				$result['team'],
				$result['player'],
				$result['amount']
			);
		} else {
			return NULL;
		}

		return $Auction;
	}

	public static function team(int $team): array
	{
		$query = 'SELECT
		id AS `index`,
		`team`,
		`player`,
		`amount`
		FROM auctions
		WHERE
		`team` = ' . $team . '
		ORDER BY `player` DESC
		LIMIT 1;';

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
	 * Returns highest Bidding or 0
	 */
	public static function player_and_team(int $player, int $team): Auction|null
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

		if ($result) {
			$Auction = new Auction(
				$result['index'],
				$result['team'],
				$result['player'],
				$result['amount']
			);
		} else {
			return NULL;
		}

		return $Auction;
	}

	public static function find_or_create(int $player, int $team)
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

		if ($result) {
			$Auction = new Auction(
				$result['index'],
				$result['team'],
				$result['player'],
				$result['amount']
			);
		} else {
			$Auction = new Auction(
				0,
				$team,
				$player,
				0
			);
			$Auction->save();
		}

		return $Auction;
	}

	public function auction(int $team, int $player): void
	{
		$this->team = $team;
		$this->player = $player;
		$this->amount++;
		$this->save();
	}
}
