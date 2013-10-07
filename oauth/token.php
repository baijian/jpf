<?php
require 'server.php';

$server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();


