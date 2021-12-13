<?php
session_start();
//require_once ...

define('REQUEST', $_REQUEST);
unset($_REQUEST);
$action = 'start';

if (isset(REQUEST['act'])) {
	if (!empty(REQUEST['act'])) {
		$action = REQUEST['act'];
	}
}

if (method_exists($Controller, $action)) {
	$Controller->run($action);
} else {
	$Controller->run('start');
}
