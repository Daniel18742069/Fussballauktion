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
		if (isset($_SESSION['user'])) {
			$Team = Team::get($_SESSION['user']);
			$this->content['Team'] = $Team->get_all();

			$Players = Player::all();
			$Auctions = Auction::all('player');
			foreach ($Players as $Player) {

				$player = $Player->get_all();
				$player['worth'] = (isset($Auctions[$Player->get_index()]))
					? $Auctions[$Player->get_index()]->get_amount()
					: 0;

				$this->content['Players'][$Player->get_index()] = $player;
			}

			$Auctions_team = Auction::team($Team->get_index());
			foreach ($Auctions_team as $Auction_team) {
				$auction_team = $Auction_team->get_all();
				$auction_team['name'] = $Players[$auction_team['player']]->get_name();

				$auction_player = Auction::player($auction_team['player']);
				$auction_team['losing'] = ($auction_team['index'] == $auction_player->get_index())
					? false
					: true;

				$auctions_team[$Auction_team->get_index()] = $auction_team;
			}
			if (isset($auctions_team)) {
				$this->content['Team']['Auctions'] = $auctions_team;
			}
		} else {

			header('Location: index.php?act=login');
		}
	}

	private function login()
	{
		if (isset($_SESSION['user'])) {

			header('Location: index.php?act=index');
		} else {
			if (isset(REQUEST['name']) && isset(REQUEST['pass'])) {
				$Login = Team::login(REQUEST['name'], REQUEST['pass']);

				if ($Login) {
					$_SESSION['user'] = $Login;

					header('Location: index.php?act=index');
				}
			}
		}
	}

	private function logout()
	{
		if (isset($_SESSION['user'])) session_destroy();

		header('Location: index.php?act=login');
	}

	private function player()
	{
		if (isset($_SESSION['user'])) {
			$Team = Team::get($_SESSION['user']);
			$this->content['Team'] = $Team->get_all();

			$Player = Player::get(REQUEST['index']);

			if ($Player) {
				$player = $Player->get_all();
				$player['picture'] = $Player->picture();

				$this->content['Player'] = $player;

				$Auction_current = Auction::player($Player->get_index());

				if ($Auction_current) {
					$Team_current = Team::get($Auction_current->get_team());
					$auction_current = $Auction_current->get_all();
					$auction_current['team'] = $Team_current->get_name();

					$this->content['Auctions']['current'] = $auction_current;

					if (isset($_SESSION['user'])) {
						$Auction_user = Auction::player_and_team($Player->get_index(), $_SESSION['user'], true);
						if ($Auction_user) {
							$Team_user = Team::get($Auction_user->get_team());
							$auction_user = $Auction_user->get_all();
							$auction_user['team'] = $Team_user->get_name();

							$this->content['Auctions']['user'] = $auction_user;
						}
					}
				} else {
					$auction_current = [
						'team' => 'Keiner',
						'amount' => '0'
					];

					$this->content['Auctions']['current'] = $auction_current;
				}
			} else {
				$this->content['Error'] = file_get_contents('Error/player-404.txt');
			}

			$Players = Player::all();
			$Auctions_team = Auction::team($Team->get_index());
			foreach ($Auctions_team as $Auction_team) {
				$auction_team = $Auction_team->get_all();
				$auction_team['name'] = $Players[$auction_team['player']]->get_name();

				$auction_player = Auction::player($auction_team['player']);
				$auction_team['losing'] = ($auction_team['index'] == $auction_player->get_index())
					? false
					: true;

				$auctions_team[$Auction_team->get_index()] = $auction_team;
			}
			if (isset($auctions_team)) {
				$this->content['Team']['Auctions'] = $auctions_team;
			}
		} else {

			header('Location: index.php?act=login');
		}
	}

	private function search()
	{
		if (isset($_SESSION['user'])) {
			$Team = Team::get($_SESSION['user']);
			$this->content['Team'] = $Team->get_all();

			$Players = Player::search(REQUEST['name']);

			if ($Players) {
				$Auctions = Auction::all('player');
				foreach ($Players as $Player) {

					$player = $Player->get_all();
					$player['worth'] = (isset($Auctions[$Player->get_index()]))
						? $Auctions[$Player->get_index()]->get_amount()
						: 0;

					$this->content['Players'][$Player->get_index()] = $player;
				}
			} else {
				$this->content['Error'] = file_get_contents('Error/search-404.txt');
			}

			$Players = Player::all();
			$Auctions_team = Auction::team($Team->get_index());
			foreach ($Auctions_team as $Auction_team) {
				$auction_team = $Auction_team->get_all();
				$auction_team['name'] = $Players[$auction_team['player']]->get_name();

				$auction_player = Auction::player($auction_team['player']);
				$auction_team['losing'] = ($auction_team['index'] == $auction_player->get_index())
					? false
					: true;

				$auctions_team[$Auction_team->get_index()] = $auction_team;
			}
			if (isset($auctions_team)) {
				$this->content['Team']['Auctions'] = $auctions_team;
			}
		} else {

			header('Location: index.php?act=login');
		}
	}

	private function auction()
	{
		if (isset($_SESSION['user'])) {
			$Team = Team::get($_SESSION['user']);
			$this->content['Team'] = $Team->get_all();

			$Player = Player::get(REQUEST['player']);

			if ($Player) {
				$Team = Team::get($_SESSION['user']);
				$Auction_user = Auction::player_and_team($Player->get_index(), $Team->get_index());
				$Auction_current = Auction::player($Player->get_index(), $Team->get_index());

				$invested = ($Auction_user)
					? $Auction_user->get_amount()
					: 0;

				$amount = ($Auction_current)
					? $Auction_current->get_amount() + 1
					: 1;

				$difference = $amount - $invested;

				if ($Team->get_budget() >= $difference) {
					$Auction_current->auction($Team->get_index(), $Player->get_index());

					$Team->auction($difference);
				}
			}

			header('Location: index.php?act=player&index=' . REQUEST['player']);
		} else {

			header('Location: index.php?act=login');
		}
	}

	private function load_page(string $page)
	{
		require('Template/' . $page . '.tmp.php');
	}
}
