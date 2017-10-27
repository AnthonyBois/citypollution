<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
require_once __DIR__ . "/../../vendor/autoload.php";

$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'formation',
    'enum'	   => 'string',
];

return $entityManager = EntityManager::create(
	$dbParams, 
	//Setup::createXMLMetadataConfiguration([__DIR__ . "/../../src/Entity"], false)
	Setup::createAnnotationMetadataConfiguration([__DIR__ . "/../../src/Entity"], false, null, null, false)
);




