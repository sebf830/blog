<?php

namespace App;

use App\Config\Routes;

session_start();

require "config/env.php";
require "functional/functions.php";


if(ENVIRONMENT == 'dev'){
	ini_set('display_errors', 1);
}else{
	ini_set('display_errors', 0);
}

function myAutoloader($class)
{
	$class = str_ireplace('App\\',  '', $class);
	$class = str_ireplace('\\', '/', $class); // 
	$class .= '.php';

	if (file_exists($class)) {
		include $class;
	} else {
		displayError(500);
	}
}

spl_autoload_register('App\myAutoloader');


$routes = Routes::getRoutes();

$uri = $_SERVER['REQUEST_URI'];


$uri = explode('/', $_SERVER['REQUEST_URI']); 
$uri = str_replace('', 'home', $uri);


if (empty($routes[$uri[1]])) {
	displayError(404);
}

if (empty($routes[$uri[1]]['controller'])) {
	displayError(500);
}
if (empty($routes[$uri[1]]['action'])) {
	displayError(500);
}

$controller =  'App\\Controllers\\' . ucfirst(strtolower($routes[$uri[1]]['controller']). 'Controller');
$action = strtolower($routes[$uri[1]]['action']);
$role = $routes[$uri[1]]['role'];

// if (isset($_SESSION['role'])) {
// 	if (!in_array($_SESSION['role'], $role) && !in_array('public', $role)) {
// 		displayError(403);
// 	}
// }else{
// 	if(!in_array('public', $role)){
// 		displayError(403);
// 	}
// }

$objectController = new $controller();

if (method_exists($objectController, $action)) {

	$objectController->$action(end($uri));
}else{
	displayError(500);
}



