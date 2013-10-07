<?php
$dsn = 'mysql:dbname=oauth;host=localhost';
$username = 'oauth';
$password = 'oauth';

ini_set('display_errors', 1);
error_reporting(E_ALL);

require('../vendor/autoload.php');
OAuth2\AutoLoader::register();

$storage = new OAuth2\Storage\Pdo(array('dsn'=>$dsn, 'username'=>$username, 
    'password' => $password));

$server = new OAuth2\Server($storage);

$server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

$server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));


