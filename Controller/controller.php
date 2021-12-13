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

	public function index() {
		
	}

	private function load_page(string $page)
	{
		require('template/' . $page . '.tmp.php');
	}
}
