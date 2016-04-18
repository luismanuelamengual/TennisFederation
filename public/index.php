<?php

require_once ("../../NeoPHP/autoload.php");
$app = new NeoPHP\web\WebApplication(realpath(".."));
$app->handleRequest();

?>