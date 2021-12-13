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
		$query = 'SELECT id AS "index",
		benutzername AS "name",
		vorname AS first_name,
		nachname AS last_name,
		passwort AS "password"
		FROM benutzer;';

		$db = Database::open();
		$results = $db->query($query, true)->fetch_all(MYSQLI_ASSOC);
		$db->close();

		$Users = [];

		foreach ($results as $result) {
			$Users[$result['index']] = new User(
				$result['index'],
				$result['name'],
				$result['first_name'],
				$result['last_name'],
				$result['password']
			);
		}

		return $Users;
	}

	/**
	 * Returns User from index
	 */
	public static function get(int $index)
	{
		$query = 'SELECT id AS "index",
		benutzername AS "name",
		vorname AS first_name,
		nachname AS last_name,
		passwort AS "password"
		FROM benutzer
		WHERE id = ' . $index . ';';

		$db = Database::open();
		$result = $db->query($query, true)->fetch_array(MYSQLI_ASSOC);
		$db->close();

		$User = new User(
			$result['index'],
			$result['name'],
			$result['first_name'],
			$result['last_name'],
			$result['password']
		);

		return $User;
	}
}
