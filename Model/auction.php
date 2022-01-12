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
		return $this->player;
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
	public static function all(string $index = 'index'): array
	{
		$query = 'SELECT
			id AS `index`,
			`team`,
			`player`, 
			`amount`
			FROM auction
			ORDER BY `amount` DESC;';

		$db = Database::open();
		$results = $db->query($query, true)->fetch_all(MYSQLI_ASSOC);
		$db->close();

		$Auctions = [];

		foreach ($results as $result) {

			switch ($index) {

				case 'player':
					if (!isset($Auctions[$result['player']])) {
						$Auctions[$result['player']] = new Auction(
							$result['index'],
							$result['team'],
							$result['player'],
							$result['amount']
						);
					}
					break;

				default:
					$Auctions[$result['index']] = new Auction(
						$result['index'],
						$result['team'],
						$result['player'],
						$result['amount']
					);
					break;
			}
		}

		return $Auctions;
	}

	private function save()
	{
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

		$db = Database::open();
		$db->query($query, false);
		$db->close();
	}

	/**
	 * Returns Auction from index
	 */
	public static function get(int $index): mixed
	{
		$query = 'SELECT
		id AS `index`,
		`team`,
		`player`,
		`amount`
		FROM auction
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

			return $Auction;
		}

		return NULL;
	}

	public static function player(int $player, mixed $team = false): mixed
	{
		$query = 'SELECT
		id AS `index`,
		`team`,
		`player`,
		`amount`
		FROM auction
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
		} elseif ($team) {
			$Auction = new Auction(
				0,
				$team,
				$player,
				0
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
		FROM auction
		WHERE
		`team` = ' . $team . '
        GROUP BY `player` DESC;';

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
	 * Returns highest Bidding or NULL
	 */
	public static function player_and_team(int $player, int $team, bool $force_return = false): mixed
	{
		$query = 'SELECT
		id AS `index`,
		`team`,
		`player`,
		`amount`
		FROM auction
		WHERE
		`player` = ' . $player . '
		AND `team` = ' . $team . '
		ORDER BY `amount` DESC
		LIMIT 1;';

		$db = Database::open();
		$result = $db->query($query, true)->fetch_array(MYSQLI_ASSOC);
		$db->close();

		$Auction = NULL;

		if ($result) {
			$Auction = new Auction(
				$result['index'],
				$result['team'],
				$result['player'],
				$result['amount']
			);
		} elseif ($force_return) {
			$Auction = new Auction(
				0,
				$team,
				$player,
				0
			);
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
