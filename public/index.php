<?php

require_once ("../../NeoPHP3/autoload.php");
$app = new NeoPHP\web\WebApplication(realpath(".."));
$app->setName ("Federación Mendocina de Tenis");
$app->handleRequest();

?>