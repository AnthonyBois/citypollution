<?php

use Formation\Response;
use Formation\Controller\Admin\AdminController;
use Formation\Entity\City;
use Formation\Entity\Api;

require __DIR__ . "/../vendor/autoload.php";

$url = "http://localhost/formation-php-avance/web/server.php";
$param = ["message=hello", "subject=zev"];
$ctx = stream_context_create(
	[
		"http" => [
			"method"  => "POST",
			"header"  => "Accept: application/json" . "\r\n"
					   . "Content-Type: application/x-www-form-urlencoded" . "\r\n"
					   . "Accept-Language: fr" . "\r\n"
					   . "My-super-header: hello-world" . "\r\n",
			"content" => http_build_query($param)
		]
	]


);
$body = file_get_contents($url, false, $ctx);

$entityManager = require __DIR__ . "/../app/conf/bootstrap.php";


try
{
	$url = filter_input(INPUT_SERVER, "REDIRECT_URL");
	$route =
	[
		"/formation-php-avance/web/admin" =>
		[
			"controller" => "\Formation\Controller\Admin\AdminController",
			"action" => "admin"
		],
		"/formation-php-avance/web/" =>
		[
			"controller" => "\Formation\Controller\IndexController",
			"action" => "index"
		],
		"/formation-php-avance/web/.{1,64}" =>
		[
			"controller" => "\Formation\Controller\IndexController",
			"action" => "city"
		]
	];

	foreach ($route as $key => $value)
	{
		$regex = "/^" . str_replace("/", "\/", $key) . "$/";
		if (preg_match($regex, $url))
		{
			$response = (new $value["controller"])->{$value["action"]}();
			break;
		}
	}

	//var_dump(new AdminController);

	if(!isset($response))
	{
		$response=new Response;
		$response->setBody('{ "message":"hello" }');
		$response->addHeader("Content-Type", "application/json");
	}

	header($response->getVersion());
	foreach ($response->getHeader() as $key => $value)
	{
		header($key . ": " . $value);
	}
	echo $response;

}

catch (Throwable $e)
{
	header("HTTP/1.1 500 Internal Server Error");
	die("<h2>ERROR : " . $e);
}
