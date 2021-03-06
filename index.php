<?php
session_start();
require_once 'Config/config.php';
require_once 'Controller/controller.php';
require_once 'Model/database.php';
require_once 'Model/player.php';
require_once 'Model/team.php';
require_once 'Model/auction.php';

$Controller = new Controller();

define('REQUEST', $_REQUEST);
unset($_REQUEST);
$action = 'index';

if (isset(REQUEST['act'])) {
	if (!empty(REQUEST['act'])) {
		$action = REQUEST['act'];
	}
}

if (method_exists($Controller, $action)) {
	$Controller->run($action);
} else {
	$Controller->run('index');
}
