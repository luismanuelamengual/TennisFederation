<?php

require_once ("../../NeoPHP/autoload.php");
$app = new NeoPHP\web\WebApplication(realpath(".."));

//Agregado de rutas a controladores
$app->addRoute("/", "org\\fmt\\controller\\PublicSiteController");
$app->addRoute("/dashboard/", "org\\fmt\\controller\\DashboardController");
$app->addRoute("/session/", "org\\fmt\\controller\\SessionController");
$app->addRoute("/category/", "org\\fmt\\controller\\CategoriesController");
$app->addRoute("/club/", "org\\fmt\\controller\\ClubsController");
$app->addRoute("/user/", "org\\fmt\\controller\\UsersController");
$app->addRoute("/tournament/", "org\\fmt\\controller\\TournamentsController");

//Registrado de managers especiales
$app->registerManager("org\\fmt\\model\\Tournament", "org\\fmt\\manager\\TournamentsManager");

$app->handleRequest();