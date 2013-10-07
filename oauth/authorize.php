<?php
require 'server.php';

$request = OAuth2\Request::createFromGlobals();

$response = new OAuth2\Response();

if (!$server->validateAuthorizeRequest($request, $response)) {
    $response->send();
    die;
}

if (empty($_POST)) {
    exit('<form method="post"><input type="submit" name="auth" value="yes">
        <input type="submit" name="auth" value="no"></form>');
}

$is_authorized = ($_POST['auth'] === 'yes');
$server->handleAuthorizeRequest($request, $response, $is_authorized);
if ($is_authorized) {
    $code = substr($response->getHttpHeader('Location'), 
        strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
    exit("suc : $code");
}
$response->send();
