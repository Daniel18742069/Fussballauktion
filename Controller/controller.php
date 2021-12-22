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

			$this->content['Team'] = $Team->get_all();
		}

		$Players = Player::all();

		foreach ($Players as $Player) {
			$this->content['Players'][$Player->get_index()] = $Player->get_all();
		}
	}

	private function login()
	{
		$Login = Team::login(REQUEST['name'], REQUEST['pass']);

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

	private function player()
	{
		$Player = Player::get(REQUEST['index']);

		if ($Player) {
			$this->content['Player'] = $Player->get_all();
		} else {
			$this->content['Error'] = file_get_contents('Error/player-404.txt');
		}
	}

	private function search()
	{
		$Players = Player::search(REQUEST['name']);

		if ($Players) {
			foreach ($Players as $Player) {
				$this->content['Players'][$Player->get_index()] = $Player->get_all();
			}
		} else {
			$this->content['Error'] = file_get_contents('Error/search-404.txt');
		}
	}

	private function auction()
	{
		$Player = Player::get(REQUEST['player']);

		if (isset($_SESSION['user']) && $Player) {	//	if logged in & exists
			$Team = Team::get($_SESSION['user']);
			$Auction_last = Auction::player_and_team($Player->get_index(), $Team->get_index());
			$Auction = Auction::player($Player->get_index(), $Team->get_index());

			$invested = ($Auction_last)
				? $Auction_last->get_amount()
				: 0;

			$amount = ($Auction)
				? $Auction->get_amount() + 1
				: 1;

			$difference = $amount - $invested;

			if ($Team->get_budget() >= $difference) {
				$Auction->auction($Team->get_index(), $Player->get_index());

				$Team->auction($difference);
			}
		}

		header('Location: index.php?act=player&index=' . REQUEST['player']);
	}

	private function load_page(string $page)
	{
		require('Template/' . $page . '.tmp.php');
	}
}
