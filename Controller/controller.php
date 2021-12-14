<?php

/**
 * @author Andreas Codalonga
 */
class Controller
{
	private array $content = [];

	public function __construct()
	{
		$this->content = [];
	}

	public function run(string $action)
	{
		$this->$action();
		define('CONTENT', $this->content);
		$this->load_page($action);
	}

	private function index()
	{
		if (isset($_SESSION['user'])) {	//	if logged in
			$Team = Team::get($_SESSION['user']);
			$content['Team'] = $Team->get_all();
		}

		$Players = Player::all();
		foreach ($Players as $Player) {
			$content['Players'][$Player->get_index()] = $Player->get_all();
		}
	}

	private function login()
	{
		$login = Team::login(REQUEST['user'], REQUEST['pass']);
		if ($login) {
			$_SESSION['user'] = $login;
		}
	}

	private function load_page(string $page)
	{
		require('template/' . $page . '.tmp.php');
	}
}
