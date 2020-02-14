<?php
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/classes/Router.php");
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/classes/Renderer.php");
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/config/cfg.php");
	$router = new Router();

	//Exaple use
	$router->mapUrl("GET","/","/public/php/home.php",null,null);
	$router->mapUrl("GET","/css/*","/public/css/*",null,null);
	$router->mapUrl("GET","/api/*","/api/index.php",null,null);
	$router->mapUrl("GET","/img/*","/public/img/*",null,null);

	$renderer = new Renderer($router);
	$renderer->render();