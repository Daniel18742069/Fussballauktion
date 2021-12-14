<?php

/**
 * @author Andreas Codalonga
 */
class User
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

	public function get_index()
	{
		return $this->index;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function get_position()
	{
		return $this->first_name;
	}

	public function get_team()
	{
		return $this->last_name;
	}

	public function get_all()
	{
		return [
			'index' => $this->index,
			'name' => $this->name,
			'position' => $this->position,
			'team' => $this->team
		];
	}

	/**
	 * Returns all Users
	 */
	public static function all()
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
			$Players[$result['index']] = new User(
				$result['index'],
				$result['name'],
				$result['position'],
				$result['team']
			);
		}

		return $Players;
	}

	/**
	 * Returns User from index
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

		$Player = new User(
			$result['index'],
			$result['name'],
			$result['position'],
			$result['team']
		);

		return $Player;
	}
}
