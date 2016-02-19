<?php

require_once ("../../NeoPHP2/autoload.php");
$app = new NeoPHP\web\WebApplication(realpath(".."));
$app->setName ("Federación Mendocina de Tenis");
$app->setRestfull (true);
$app->handleRequest();

?>