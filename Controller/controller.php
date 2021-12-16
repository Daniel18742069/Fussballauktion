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
		$Login = Team::login(REQUEST['user'], REQUEST['pass']);
		if ($Login) {
			$_SESSION['user'] = $Login;
		}

		header('Location: index.php?act=index');
	}

	private function logout()
	{
		session_destroy();

		header('Location: index.php?act=index');
	}

	private function search()
	{
		$Players = Player::search(REQUEST['name']);
		if ($Players) {
			foreach ($Players as $player) {
				$content['Players'][$player->get_index()] = $player->get_all();
			}
		} else {
			$content['Error'] = readfile('Error/404.txt');
		}
	}

	private function auction()
	{
		if (isset($_SESSION['user'])) {	//	if logged in
			$Team = Team::get($_SESSION('user'));
			//player
			//auction
		}
	}

	private function load_page(string $page)
	{
		require('template/' . $page . '.tmp.php');
	}
}
