<?php

/**
 * Streamlines MySQL-Database connection.
 * 
 * $db = Database::open();
 * $result = $db->query($query, true);
 * $db->close();
 * 
 * @author Andreas Codalonga
 */
class Database
{
	private static $instance = NULL;
	private string $host = 'localhost';
	private string $user = 'root';
	private string $password = '';
	private string $database = 'phpmyadmin';
	private mixed $connection = NULL;

	/**
	 * Prohibited! Use open().
	 */
	private function __construct()
	{
		$this->host = DB_HOST;
		$this->user = DB_USER;
		$this->password = DB_PASS;
		$this->database = DB_NAME;

		$this->connection = mysqli_connect(
			$this->host,
			$this->user,
			$this->password,
			$this->database
		);
	}

	/**
	 * Creates new instance of Database or returns existing.
	 * 
	 * Make sure to close the connection again! -> close()
	 * 
	 * @return $instance Class
	 */
	public static function open(): Database
	{
		if (!isset(self::$instance)) {
			self::$instance = new static();
		}

		return self::$instance;
	}

	/** 
	 * Runs SQL query and returns result.
	 * 
	 * @param string $query
	 * @param string $return default|false: return NULL
	 * @return mixed
	 */
	public function query(string $query, bool $return = false): mixed
	{
		try {
			if ($return) {
				return mysqli_query($this->connection, $query);
			}

			mysqli_query($this->connection, $query);
			return NULL;
		} catch (Error $error) {
			var_dump($error);
			return NULL;
		}
	}

	/**
	 * Closes instance of Database and Connection.
	 * 
	 * @return void
	 */
	public function close(): void
	{
		mysqli_close($this->connection);
		self::$instance = NULL;
	}
}
