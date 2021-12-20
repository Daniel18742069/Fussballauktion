<?php

/**
 * @author Andreas Codalonga
 */
class Team
{
	private int $index;
	private string $name;
	private int $budget;
	private string $username;
	private string $password;

	private function __construct($index, $name, $budget, $username, $password)
	{
		$this->index = $index;
		$this->name = $name;
		$this->budget = $budget;
		$this->username = $username;
		$this->password = $password;
	}

	public function get_index(): int
	{
		return $this->index;
	}

	public function get_name(): string
	{
		return $this->name;
	}

	public function get_budget(): int
	{
		return $this->budget;
	}

	public function get_username(): string
	{
		return $this->username;
	}

	public function get_password(): string
	{
		return $this->password;
	}

	private function set_bodget(int $budget)
	{
		$this->budget = $budget;
	}

	public function get_all(): array
	{
		return [
			'index' => $this->index,
			'name' => $this->name,
			'budget' => $this->budget,
			'username' => $this->username,
			'password' => $this->password
		];
	}

	/**
	 * Returns all Teams
	 */
	public static function all(): array
	{
		$query = 'SELECT
		id AS `index`,
		`name`,
		`budget`,
		`username`,
		`password`
		FROM team;';

		$db = Database::open();
		$results = $db->query($query, true)->fetch_all(MYSQLI_ASSOC);
		$db->close();

		$Teams = [];

		foreach ($results as $result) {
			$Teams[$result['index']] = new Team(
				$result['index'],
				$result['name'],
				$result['budget'],
				$result['username'],
				$result['password']
			);
		}

		return $Teams;
	}

	/**
	 * Returns Team from index
	 */
	public static function get(int $index): Team|null
	{
		$query = 'SELECT
		id AS `index`,
		`name`,
		`budget`,
		`username`,
		`password`
		FROM team
		WHERE
		`id` = ' . $index . ';';

		$db = Database::open();
		$result = $db->query($query, true)->fetch_array(MYSQLI_ASSOC);
		$db->close();

		$Team = new Team(
			$result['index'],
			$result['name'],
			$result['budget'],
			$result['username'],
			$result['password']
		);

		return $Team;
	}

	/**
	 * Returns Integer on success or Boolean on failure
	 */
	public static function login(string $username, string $password): int|bool
	{
		$query = 'SELECT
		`id` AS `index`,
		`password`
		FROM team
		WHERE
		`username` = "' . $username . '";';

		$db = Database::open();
		$result = $db->query($query, true)->fetch_array(MYSQLI_ASSOC);
		$db->close();

		if ($result['password'] == $password) {
			return $result['index'];
		}

		return false;
	}

	/*
	For Register use:
	password_hash($password, CRYPT_BLOWFISH);
	*/

	public function auction(Player $player, Auction $auction)
	{
		$amount = $auction->get_amount();
		$invested = Auction::team($player->get_index(), $this->get_index());
		$this->set_bodget($amount - $invested - 1);
	}
}
