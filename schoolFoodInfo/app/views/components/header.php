<?php

require_once "app/views/components/Session.php";

$session = new Session();
$session->checkSession();

var_dump($_SESSION);
?>
