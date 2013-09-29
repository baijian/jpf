<?php
require 'server.php';

$server->handleToeknRequest(OAuth2\Request::createFormGlobals())->send();


