<?php

/**
 * @author Andreas Codalonga
 */
class Player
{
	private int $index;
	private string $name;
	private string $position;
	private string $team;

	private function __construct($index, $name, $position, $team)
	{
		$this->index = $index;
		$this->name = $name;
		$this->position = $position;
		$this->team = $team;
	}

	public function get_index(): int
	{
		return $this->index;
	}

	public function get_name(): string
	{
		return $this->name;
	}

	public function get_position(): string
	{
		return $this->first_name;
	}

	public function get_team(): string
	{
		return $this->last_name;
	}

	public function get_all(): array
	{
		return [
			'index' => $this->index,
			'name' => $this->name,
			'position' => $this->position,
			'team' => $this->team
		];
	}

	/**
	 * Returns all Players
	 */
	public static function all(): array
	{
		$query = 'SELECT
		id AS `index`,
		`name`,
		`position`,
		`team`
		FROM player;';

		$db = Database::open();
		$results = $db->query($query, true)->fetch_all(MYSQLI_ASSOC);
		$db->close();

		$Players = [];

		foreach ($results as $result) {
			$Players[$result['index']] = new Player(
				$result['index'],
				$result['name'],
				$result['position'],
				$result['team']
			);
		}

		return $Players;
	}

	/**
	 * Returns Player from index
	 */
	public static function get(int $index)
	{
		$query = 'SELECT
		`id` AS `index`,
		`name`,
		`position`,
		`team`
		FROM player
		WHERE
		`id` = ' . $index . ';';

		$db = Database::open();
		$result = $db->query($query, true)->fetch_array(MYSQLI_ASSOC);
		$db->close();

		$Player = new Player(
			$result['index'],
			$result['name'],
			$result['position'],
			$result['team']
		);

		return $Player;
	}

	/**
	 * Finds Players containing $name.
	 * Returns Player array on success,
	 * false on failure.
	 */
	public static function search(string $name)
	{
		$query = 'SELECT
		`id` AS `index`,
		`name`,
		`position`,
		`team`
		FROM player
		WHERE
		`name` LIKE "' . $name . '%";';

		$db = Database::open();
		$results = $db->query($query, true)->fetch_all(MYSQLI_ASSOC);
		$db->close();

		if ($results) {
			$Players = [];

			foreach ($results as $result) {
				$Players[$result['index']] = new Player(
					$result['index'],
					$result['name'],
					$result['position'],
					$result['team']
				);
			}

			return $Players;
		}

		return false;
	}

	public function picture()
	{
		$file = file_get_contents('Bilder/playerImages.txt');
		$rows = explode(';', $file);
		foreach ($rows as $row) {
			$values = explode('|', $row);
			if (trim($values[0]) === $this->name) {
				return $values[1];
			}
		}

		return 'Bilder/default_pfp.png';
	}
}
