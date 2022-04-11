<?php

$path = ltrim($_SERVER['REQUEST_URI'], '/');
$path = explode('?', $path)[0];
$path = explode('/', $path);
if(count($path) !== 3) {
    die('Wrong path '.$path);
}

$controller = $path[1];
$action = $path[2];

$file = 'controllers/'.$controller.'.php';
if(!file_exists($file)) {
    die('Controller '.$controller.' not found');
}
require_once($file);

$class = ucwords($controller);
$controller = new $class();
if(!method_exists($controller, $action)) {
    die('Action '.$action.' not found');
} 
$controller->$action();